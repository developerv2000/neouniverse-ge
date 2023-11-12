<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Form;
use App\Models\ProductsCategory;
use App\Models\Symptom;
use Illuminate\Http\Request;

class ProductsRelationController extends Controller
{
    public function dashboardIndex(Request $request)
    {
        $model = $request->model;
        $modelFullName = 'App\Models\\' . $model;
        $items =  $modelFullName::orderBy('ru_name', 'asc')->get();
        $title = $this->getTitle($request->model);

        return view('dashboard.products.relations.index', compact('items', 'model', 'title'));
    }

    public function dashboardCreate(Request $request)
    {
        $model = $request->model;
        $title = $this->getTitle($model);

        return view('dashboard.products.relations.create', compact('title', 'model'));
    }

    public function dashboardSingle(Request $request, $id)
    {
        $model = $request->model;
        $modelFullName = 'App\Models\\' . $model;
        $title = $this->getTitle($request->model);
        $item = $modelFullName::find($id);

        return view('dashboard.products.relations.single', compact('model','item', 'title'));
    }

    public function store(Request $request)
    {
        $modelFullName = 'App\Models\\' . $request->model;
        $exists = $modelFullName::where('ru_name', $request->ru_name)->first();
        if($exists) {
            return back()->withInput()->withErrors('Такой заголовок уже существует !');
        }

        $item = new $modelFullName();
        Helper::fillMultiLanguageFields($request, $item, ['name']);
        $item->save();

        return redirect()->route('dashboard.products.relations.index', ['model' => $request->model]);
    }

    public function update(Request $request)
    {
        $modelFullName = 'App\Models\\' . $request->model;
        $item = $modelFullName::find($request->id);
        Helper::fillMultiLanguageFields($request, $item, ['name']);
        $item->save();

        return redirect($request->intended_url);
    }

    public function remove(Request $request)
    {
        $this->delete([$request->id], $request->model);

        return redirect(route('dashboard.products.relations.index') . '?model=' . $request->model);
    }

    public function removeMultiple(Request $request)
    {
        $this->delete($request->ids, $request->model);

        return redirect()->back();
    }

    /**
     * Delete selected items
     * @param array $ids
     * @return void
     */
    private function delete($ids, $model)
    {
        $modelFullName = 'App\Models\\' . $model;

        switch ($model) {
            case 'ProductsCategory':
            case 'Symptom':
                foreach($ids as $id) {
                    $item = $modelFullName::find($id);
                    $item->products()->detach();
                    $item->delete();
                }
                break;

            case 'Form':
                foreach($ids as $id) {
                    $item = $modelFullName::find($id);
                    foreach($item->products as $prod) {
                        $prod->form_id = 0;
                        $prod->save();
                    }
                    $item->delete();
                }
                break;
        }
    }

    private function getTitle($model)
    {
        switch($model) {
            case 'ProductsCategory':
                $title = 'Направления';
            break;

            case 'Symptom':
                $title = 'Симптомы';
            break;

            case 'Form':
                $title = 'Формы';
            break;
        }

        return $title;
    }
}
