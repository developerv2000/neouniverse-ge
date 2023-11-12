<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

class TranslationController extends Controller
{
    public function dashboardIndex(Request $request)
    {
        $languages = collect([
            ['name' => 'Английский', 'tag' => 'en'],
            ['name' => 'Грузинский', 'tag' => 'ka']
        ]);

        return view('dashboard.translations.index', compact('languages'));
    }

    public function dashboardSingle($tag)
    {
        $content = file_get_contents(base_path('resources/lang/' . $tag . '.json'));

        return view('dashboard.translations.single', compact('content', 'tag'));
    }

    public function update(Request $request)
    {
        $file = base_path('resources/lang/' . $request->tag . '.json');
        file_put_contents($file, $request->content);

        return redirect($request->intended_url);
    }
}
