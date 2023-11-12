<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\NewsCategory;
use App\Models\ProductsCategory;
use App\Models\Symptom;

class NewsCategoryController extends Controller
{
    public function dashboardIndex(Request $request)
    {
        $categories =  NewsCategory::orderBy('ru_name', 'asc')->get();

        return view('dashboard.news.categories.index', compact('categories'));
    }

    public function dashboardCreate(Request $request)
    {
        return view('dashboard.news.categories.create');
    }

    public function dashboardSingle($id)
    {
        $category = NewsCategory::find($id);

        return view('dashboard.news.categories.single', compact('category'));
    }

    public function store(Request $request)
    {
        $exists = NewsCategory::where('ru_name', $request->ru_name)->first();
        if($exists) {
            return back()->withInput()->withErrors('Такой заголовок уже существует !');
        }

        $category = new NewsCategory();
        Helper::fillMultiLanguageFields($request, $category, ['name']);
        $category->highlight_in_filter = $request->highlight_in_filter;
        $category->save();

        return redirect()->route('dashboard.news.categories.index');
    }

    public function update(Request $request)
    {
        $category = NewsCategory::find($request->id);
        Helper::fillMultiLanguageFields($request, $category, ['name']);
        $category->highlight_in_filter = $request->highlight_in_filter;
        $category->save();

        return redirect($request->intended_url);
    }

    public function remove(Request $request)
    {
        $this->delete([$request->id]);

        return redirect()->route('dashboard.news.categories.index');
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
    private function delete($ids)
    {
        foreach($ids as $id) {
            $categories = NewsCategory::find($id);
            $categories->news()->detach();
            $categories->delete();
        }
    }
}
