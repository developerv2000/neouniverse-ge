<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function dashboardIndex(Request $request)
    {
        //used in search
        $items = Option::orderBy('key')
            ->select('id', 'key as title')
            ->get();
        $singleRoute = 'dashboard.options.single';

        $itemsCount = Option::all()->count();

        // Generate default parameters for ordering/filtering request
        $orderBy = $request->orderBy ? $request->orderBy : 'key';
        $orderType = $request->orderType ? $request->orderType : 'asc';
        $activePage = $request->page ? $request->page : 1;

        $options = Option::orderBy($orderBy, $orderType)
            ->paginate(40, ['*'], 'page', $activePage)
            ->appends($request->except('page'));

        $reversedOrderType = $orderType == 'asc' ? 'desc' : 'asc';

        return view('dashboard.options.index', compact('itemsCount', 'items', 'singleRoute', 'options', 'orderType', 'activePage', 'orderBy', 'reversedOrderType'));
    }

    public function dashboardSingle($id)
    {
        $option = Option::find($id);

        return view('dashboard.options.single', compact('option'));
    }

    public function update(Request $request)
    {
        $option = Option::find($request->id);

        $multiLanguageFields = ['value'];
        Helper::fillMultiLanguageFields($request, $option, $multiLanguageFields);

        $option->save();

        return redirect($request->intended_url);
    }
}
