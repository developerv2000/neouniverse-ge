<?php

/**
 * Custom Helper class
 * @author Bobur Nuridinov <bobnuridinov@gmail.com> 
 */

namespace App\Helpers;

use Image;

class Helper
{

    const DEFAULT_LANGUAGE = 'ru_';
    const SECONDARY_LANGUAGES = ['en_', 'ka_'];

    const INSTRUCTIONS_PATH = '/instructions';
    const PRODUCTS_PATH = '/img/products';
    const NEWS_PATH = '/img/news';
    const CAROUSEL_PATH = '/img/carousel';

    /**
     * Return transliterated lowercased string from russian or tajik into latin
     *
     * @param string $string
     * @return string
     */
    public static function transliterateIntoLatin($string)
    {
        $cyrilic = [
            'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п',
            'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я',
            'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П',
            'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', ' ',
            'ӣ', 'ӯ', 'ҳ', 'қ', 'ҷ', 'ғ', 'Ғ', 'Ӣ', 'Ӯ', 'Ҳ', 'Қ', 'Ҷ',
            '/', '\\', '|', '!', '?', '«', '»', '“', '”'
        ];

        $latin = [
            'a', 'b', 'v', 'g', 'd', 'e', 'io', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p',
            'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'shb', 'a', 'i', 'y', 'e', 'yu', 'ya',
            'a', 'b', 'v', 'g', 'd', 'e', 'io', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p',
            'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'shb', 'a', 'i', 'y', 'e', 'yu', 'ya', '-',
            'i', 'u', 'h', 'q', 'j', 'g', 'g', 'i', 'u', 'h', 'q', 'j',
            '', '', '', '', '', '', '', '', ''
        ];

        $transilation = str_replace($cyrilic, $latin, $string);

        return strtolower($transilation);
    }


    /**
     * Filling fields for the Default language are required! 
     * Unfilled fields of Secondary languages will automatically be filled with data from the Default language!
     * 
     * @param \Http\Request $request
     * @param \Eloquent\Model $item
     * @param array $fields
     * @return void
     */
    public static function fillMultiLanguageFields($request, $item, $fields)
    {
        $defaultLanguage = Helper::DEFAULT_LANGUAGE;
        $secondaryLanguages = Helper::SECONDARY_LANGUAGES;

        foreach ($fields as $field) {
            $item[$defaultLanguage . $field] = $request[$defaultLanguage . $field];

            foreach ($secondaryLanguages as $secLang) {
                $item[$secLang . $field] = $request[$secLang . $field] ? $request[$secLang . $field] : $request[$defaultLanguage . $field];
            }
        }

        return;
    }


    /**
     * Filling fields for the Default language are required! 
     * Unfilled fields of Secondary languages will automatically be filled with data from the Default language!
     *
     * @param \Http\Request $request
     * @param \Eloquent\Model\ $item
     * @param string $field Column name of Model
     * @param string $path
     * @param boolean $createThumb Creating thumbs for images
     * @param integer $thumbHeight Height of thumb in pixels. Use null for auto calc
     * @param integer $thumbWidth Width of thumb in pixels. Use null for auto calc
     * @return void
     */
    public static function uploadFiles($request, $item, $field, $path, $createThumb, $thumbWidth = 400, $thumbHeight = null)
    {
        $defaultLanguage = Helper::DEFAULT_LANGUAGE;
        $secondaryLanguages = Helper::SECONDARY_LANGUAGES;

        $path = public_path($path);
        $transliteratedName = $item->url;

        /*********************** Store image of Default language ***********************/
        // Any file input is nullable on item update
        $file = $request->file($defaultLanguage . $field);
        if ($file) {
            $extension = '.' . $file->getClientOriginalExtension();
            $filename = $transliteratedName . '--' . str_replace('_', '', $defaultLanguage) . $extension;

            $file->move($path, $filename);
            $item[$defaultLanguage . $field] = $filename;

            // make thumb from original and store it in thumbs folder
            if($createThumb) {
                $thumb = Image::make($path . '/' . $filename);
                if($thumbWidth && $thumbHeight) {
                    $thumb->fit($thumbWidth, $thumbHeight, function ($constraint) {
                        $constraint->upsize();
                    }, 'center');
                } else {
                    $thumb->resize($thumbWidth, $thumbHeight, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                }
                $thumb->save($path . '/thumbs//' . $filename);
            }
        }

        /*********************** Store image of Secondary languages ***********************/
        foreach ($secondaryLanguages as $secLang) {
            $file = $request->file($secLang . $field);
            if ($file) {
                $extension = '.' . $file->getClientOriginalExtension();
                $filename = $transliteratedName . '--' . str_replace('_', '', $secLang) . $extension;

                $file->move($path, $filename);
                $item[$secLang . $field] = $filename;

                // make thumb from original and store it
                if($createThumb) {
                    $thumb = Image::make($path . '/' . $filename);
                    if($thumbWidth && $thumbHeight) {
                        $thumb->fit($thumbWidth, $thumbHeight, function ($constraint) {
                            $constraint->upsize();
                        }, 'center');
                    } else {
                        $thumb->resize($thumbWidth, $thumbHeight, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }
                    $thumb->save($path . '/thumbs//' . $filename);
                }
            } else if (!$file && !$item[$secLang . $field]) {
                // else assign default languages image if file not uploaded and its create method
                $item[$secLang . $field] = $item[$defaultLanguage . $field];
            }
        }
    }

}
