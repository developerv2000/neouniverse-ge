<?php

namespace App\Http\Controllers;

use App\Models\Locale;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function switch(Request $request)
    {
        session(['appLocale' => $request->locale]);

        return redirect()->back();
    }

    public function dashboardIndex()
    {
        $locales = Locale::all();

        return view('dashboard.locale.index', compact('locales'));
    }

    public function updateSwitcher(Request $request)
    {
        $locales = Locale::all();
        
        foreach($locales as $locale) {
            $locale->visibility = false;
            if($request[$locale->value]) {
                $locale->visibility = true;
            }
            $locale->save();
        }

        return redirect()->back();
    }
}
