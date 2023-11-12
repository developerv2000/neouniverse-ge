<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Carousel;
use App\Models\Product;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    public function dashboardIndex(Request $request)
    {

        $carouselItems = Carousel::orderBy('ru_title')->paginate(30);

        return view('dashboard.carousel.index', compact('carouselItems'));
    }

    public function dashboardCreate()
    {
        $products = Product::select('id', 'ru_name')->orderBy('ru_name', 'asc')->get();

        return view('dashboard.carousel.create', compact('products'));
    }

    public function dashboardSingle($id)
    {
        $item = Carousel::find($id);
        $products = Product::select('id', 'ru_name')->orderBy('ru_name', 'asc')->get();

        return view('dashboard.carousel.single', compact('item','products'));
    }

    public function store(Request $request)
    {
        $item = new Carousel();
        $multiLanguageFields = ['title', 'description'];
        Helper::fillMultiLanguageFields($request, $item, $multiLanguageFields);

        $item->product_id = $request->product_id;
        $item->url = uniqid();
        Helper::uploadFiles($request, $item, 'image', Helper::CAROUSEL_PATH, false);

        $item->save();

        return redirect()->route('dashboard.carousel.index');
    }

    public function update(Request $request)
    {
        $item = Carousel::find($request->id);
        $multiLanguageFields = ['title', 'description'];
        Helper::fillMultiLanguageFields($request, $item, $multiLanguageFields);

        $item->product_id = $request->product_id;
        Helper::uploadFiles($request, $item, 'image', Helper::CAROUSEL_PATH, false);

        $item->save();

        return redirect($request->intended_url);
    }

    public function remove(Request $request)
    {
        $this->delete([$request->id]);

        return redirect()->route('dashboard.carousel.index');
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
            $item = Carousel::find($id);
            $item->delete();
        }
    }
}
