<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        // filtering products because request may contain searching && filtering && orderring
        $news = $this->filter($request);
        $news->withPath(route('news.index'));

        $newsCount = News::all()->count();

        $locale = App::currentLocale();
        $categories = NewsCategory::orderBy($locale . '_name', 'asc')->get();
        $highlightedCategories = NewsCategory::where('highlight_in_filter', true)
            ->select($locale . '_name as name', 'id')
            ->orderBy('name', 'asc')
            ->get();

        return view('news.index', compact('news', 'newsCount', 'categories', 'request', 'highlightedCategories'));
    }

    public function single($url)
    {
        $new = News::where('url', $url)->first();
        $news_categories = $new->categories()->pluck('id')->toArray();

        $similar_news = News::whereHas('categories', function($q) use ($news_categories) {
            $q->whereIn('id', $news_categories); })
            ->where('id', '!=', $new->id)
            ->take(8)
            ->paginate(12);

        return view('news.single', compact('new', 'similar_news'));
    }

    public function ajaxGet(Request $request)
    {
        $news = $this->filter($request);
        $news->withPath(route('news.index'));

        return view('components.news.list', compact('news'));
    }

    private function filter(Request $request)
    {
        /**
         * Used for filtering news in news.index route and while filteing news by ajax
         * return filtered && ordered && paginated news list
         * @param \Illuminate\Http\Request $request
         * @return Illuminate\Database\Eloquent\Builder
         */
        $locale = App::currentLocale();
        $news = News::query();

        $keyword = $request->keyword;
        if($keyword) {
            $news = $news->where(function ($q) use($locale, $keyword) {
                $q->where($locale . '_title', 'like', '%' . $keyword . '%')
                ->orWhere($locale . '_body', 'like', '%' . $keyword . '%');
            });
        }

        $category_id = $request->category_id;
        if($category_id) {
            $news = $news->whereHas('categories', function ($q) use ($category_id) {
                $q->where('id', $category_id);
            });
        }

        $news = $news->latest()
                    ->select('id', $locale . '_title', $locale . '_body', $locale . '_image', 'url')
                    ->paginate(12)
                    ->appends($request->except(['page','_token']))
                    ->fragment('all_news');

        return $news;
    }

    public function dashboardIndex(Request $request)
    {
        //used in search
        $items = News::orderBy('ru_title')
            ->select('id', 'ru_title as title')
            ->get();
        $singleRoute = 'dashboard.news.single';

        $itemsCount = News::all()->count();

        // Generate default parameters for ordering/filtering request
        $orderBy = $request->orderBy ? $request->orderBy : 'ru_title';
        $orderType = $request->orderType ? $request->orderType : 'asc';
        $activePage = $request->page ? $request->page : 1;

        $news = News::orderBy($orderBy, $orderType)
            ->paginate(30, ['*'], 'page', $activePage)
            ->appends($request->except('page'));

        $reversedOrderType = $orderType == 'asc' ? 'desc' : 'asc';

        return view('dashboard.news.index', compact('itemsCount', 'items', 'singleRoute', 'news', 'orderType', 'activePage', 'orderBy', 'reversedOrderType'));
    }

    public function dashboardCreate()
    {
        $categories = NewsCategory::orderBy('ru_name', 'asc')->get();

        return view('dashboard.news.create', compact('categories'));
    }

    public function dashboardSingle($id)
    {
        $news = News::find($id);
        $categories = NewsCategory::orderBy('ru_name', 'asc')->get();

        return view('dashboard.news.single', compact('news','categories'));
    }

    public function store(Request $request)
    {
        $validation_rules = [
            Helper::DEFAULT_LANGUAGE . "title" => "unique:news"
        ];
        $validation_messages = [
            Helper::DEFAULT_LANGUAGE . "title.unique" => "Новость с таким заголовком уже существует !",
        ];
        Validator::make($request->all(), $validation_rules, $validation_messages)->validate();

        $news = new News();

        $multiLanguageFields = ['title', 'body'];
        Helper::fillMultiLanguageFields($request, $news, $multiLanguageFields);

        $news->url = Helper::transliterateIntoLatin($request->ru_title);

        Helper::uploadFiles($request, $news, 'image', Helper::NEWS_PATH, true, 400, 400);

        $news->save();
        $news->categories()->attach($request->categories);

        return redirect()->route('dashboard.news.index');
    }

    public function update(Request $request)
    {
        $news = News::find($request->id);
        $defaultLanguage = Helper::DEFAULT_LANGUAGE;

        // escape duplicate news title
        $validationErrors = [];
        if($request[$defaultLanguage . 'title'] != $news[$defaultLanguage . 'title']) {
            $duplicate = News::where($defaultLanguage . 'title', $request[$defaultLanguage . 'title'])->first();
            if ($duplicate) array_push($validationErrors, "Новость с таким заголовком уже существует!");
        }

        if(count($validationErrors) > 0) return back()->withInput()->withErrors($validationErrors);

        $multiLanguageFields = ['title', 'body'];
        Helper::fillMultiLanguageFields($request, $news, $multiLanguageFields);

        $news->url = Helper::transliterateIntoLatin($request->ru_title);
        Helper::uploadFiles($request, $news, 'image', Helper::NEWS_PATH, true, 400, 400);

        $news->save();

        $news->categories()->detach();
        $news->categories()->attach($request->categories);

        return redirect($request->intended_url);
    }

    public function remove(Request $request)
    {
        $this->delete([$request->id]);

        return redirect()->route('dashboard.news.index');
    }

    public function removeMultiple(Request $request)
    {
        $this->delete($request->ids);

        return redirect()->back();
    }

    /**
     * Delete selected items
     * @param array $ids
     * @return void
     */
    public function delete($ids)
    {
        foreach($ids as $id) {
            $news = News::find($id);
            $news->categories()->detach();
            $news->delete();
        }
    }

}
