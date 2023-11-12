<?php

/**
 * Custom Helper class
 * @author Bobur Nuridinov <bobnuridinov@gmail.com> 
 */

namespace App\Olderper;

use Illuminate\Support\Facades\File;
use Image;

class Olderper {

    const DEFAULT_LANGUAGE = 'ru_';
    const SECONDARY_LANGUAGES = ['en_', 'ka_'];

    const INSTRUCTIONS_PATH = '/instructions';
    const PRODUCTS_PATH = '/img/products';
    const PRODUCTS_THUMBS_PATH = '/img/products/thumbs';
    const NEWS_PATH = '/img/news';
    const NEWS_THUMBS_PATH = '/img/news/thumbs';

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
     * Used to upload products instruction on create & edit
     * Default language instructions used as default value for secondary language instructions
     *
     * @param \Http\Request $request
     * @param \Eloquent\Model\Product $product
     * @return void
     */
    public static function uploadProductInstructions($request, $product)
    {
        $defaultLanguage = Helper::DEFAULT_LANGUAGE;
        $secondaryLanguages = Helper::SECONDARY_LANGUAGES;

        $instructionsPath = public_path(Helper::INSTRUCTIONS_PATH);
        $transliteratedName = $product->url;

        // store default languages instruction
        $instruction = $request->file($defaultLanguage . 'instruction');
        //On product update default languages instruction is nullabe
        if ($instruction) {
            $extension = '.' . $instruction->getClientOriginalExtension();
            $filename = $transliteratedName . '--' . str_replace('_', '', $defaultLanguage) . $extension;

            $instruction->move($instructionsPath, $filename);
            $product[$defaultLanguage . 'instruction'] = $filename;
        }

        // store secondary languages instructions
        foreach ($secondaryLanguages as $secLang) {
            $file = $request->file($secLang . 'instruction');
            if ($file) {
                $extension = '.' . $file->getClientOriginalExtension();
                $filename = $transliteratedName . '--' . str_replace('_', '', $secLang) . $extension;

                $file->move($instructionsPath, $filename);
                $product[$secLang . 'instruction'] = $filename;
                // else assign default languages instruction if file not uploaded and its create method
            } else if (!$file && !$product[$secLang . 'instruction']) {
                $product[$secLang . 'instruction'] = $product[$defaultLanguage . 'instruction'];
            }
        }
    }



    public function uploadFiles($request, $item, $field, $path, $thumb, $thumbHeight = 400, $thumbWidth = 400)
    {
        $defaultLanguage = Helper::DEFAULT_LANGUAGE;
        $secondaryLanguages = Helper::SECONDARY_LANGUAGES;

        $path = public_path($path);
        $transliteratedName = $item->url;

        /*********************** Store image of default language ***********************/
        // Any file input is nullable on item update
        $file = $request->file($defaultLanguage . $field);
        if ($file) {
            $extension = '.' . $file->getClientOriginalExtension();
            $filename = $transliteratedName . '--' . str_replace('_', '', $defaultLanguage) . $extension;

            $file->move($path, $filename);
            $item[$defaultLanguage . $field] = $filename;

            // make thumb from original and store it in thumbs folder
            $thumb = Image::make($path . '/thumbs//' . $filename);
            $thumb->resize($thumbWidth, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $thumb->save($path . '/thumbs//' . $filename);
        }

        /*********************** Store image of secondary languages ***********************/
        foreach ($secondaryLanguages as $secLang) {
            $file = $request->file($secLang . 'image');
            if ($file) {
                $extension = '.' . $file->getClientOriginalExtension();
                $filename = $transliteratedName . '--' . str_replace('_', '', $secLang) . $extension;

                $file->move($productsPath, $filename);
                $product[$secLang . 'image'] = $filename;

                // make thumb from original and store it
                $thumb = Image::make($productsPath . '/' . $filename);
                $thumb->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $thumb->save($productsThumbPath . '/' . $filename);

                // else assign default languages image if file not uploaded and its create method
            } else if (!$file && !$product[$secLang . 'image']) {
                $product[$secLang . 'image'] = $product[$defaultLanguage . 'image'];
            }
        }
    }


    /**
     * Filling fields for the Default language are required! 
     * Unfilled fields of Secondary languages will automatically be filled with data from the Default language!
     * 
     * Used to upload products instruction on create & edit
     * Default language instructions used as default value for secondary language instructions
     *
     * @param \Http\Request $request
     * @param \Eloquent\Model\Product $product
     * @return void
     */
    public static function uploadProductImages($request, $product)
    {
        $defaultLanguage = Helper::DEFAULT_LANGUAGE;
        $secondaryLanguages = Helper::SECONDARY_LANGUAGES;

        $productsPath = public_path(Helper::PRODUCTS_PATH);
        $productsThumbPath = public_path(Helper::PRODUCTS_THUMBS_PATH);
        $transliteratedName = $product->url;

        // store default languages image
        $image = $request->file($defaultLanguage . 'image');
        //On product update default languages image is nullabe
        if ($image) {
            $extension = '.' . $image->getClientOriginalExtension();
            $filename = $transliteratedName . '--' . str_replace('_', '', $defaultLanguage) . $extension;

            $image->move($productsPath, $filename);
            $product[$defaultLanguage . 'image'] = $filename;

            // make thumb from original and store it
            $thumb = Image::make($productsPath . '/' . $filename);
            $thumb->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $thumb->save($productsThumbPath . '/' . $filename);
        }

        // store secondary languages image
        foreach ($secondaryLanguages as $secLang) {
            $file = $request->file($secLang . 'image');
            if ($file) {
                $extension = '.' . $file->getClientOriginalExtension();
                $filename = $transliteratedName . '--' . str_replace('_', '', $secLang) . $extension;

                $file->move($productsPath, $filename);
                $product[$secLang . 'image'] = $filename;

                // make thumb from original and store it
                $thumb = Image::make($productsPath . '/' . $filename);
                $thumb->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $thumb->save($productsThumbPath . '/' . $filename);

                // else assign default languages image if file not uploaded and its create method
            } else if (!$file && !$product[$secLang . 'image']) {
                $product[$secLang . 'image'] = $product[$defaultLanguage . 'image'];
            }
        }
    }


    /**
     * Filling fields for the Default language are required! 
     * Unfilled fields of Secondary languages will automatically be filled with data from the Default language!
     * 
     * Used to upload products instruction on create & edit
     * Default language instructions used as default value for secondary language instructions
     *
     * @param \Http\Request $request
     * @param \Eloquent\Model\Product $product
     * @return void
     */
    public static function uploadNewsImages($request, $news)
    {
        $defaultLanguage = Helper::DEFAULT_LANGUAGE;
        $secondaryLanguages = Helper::SECONDARY_LANGUAGES;

        $productsPath = public_path(Helper::PRODUCTS_PATH);
        $productsThumbPath = public_path(Helper::PRODUCTS_THUMBS_PATH);
        $transliteratedName = $product->url;

        // store default languages image
        $image = $request->file($defaultLanguage . 'image');
        //On product update default languages image is nullabe
        if ($image) {
            $extension = '.' . $image->getClientOriginalExtension();
            $filename = $transliteratedName . '--' . str_replace('_', '', $defaultLanguage) . $extension;

            $image->move($productsPath, $filename);
            $product[$defaultLanguage . 'image'] = $filename;

            // make thumb from original and store it
            $thumb = Image::make($productsPath . '/' . $filename);
            $thumb->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $thumb->save($productsThumbPath . '/' . $filename);
        }

        // store secondary languages image
        foreach ($secondaryLanguages as $secLang) {
            $file = $request->file($secLang . 'image');
            if ($file) {
                $extension = '.' . $file->getClientOriginalExtension();
                $filename = $transliteratedName . '--' . str_replace('_', '', $secLang) . $extension;

                $file->move($productsPath, $filename);
                $product[$secLang . 'image'] = $filename;

                // make thumb from original and store it
                $thumb = Image::make($productsPath . '/' . $filename);
                $thumb->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $thumb->save($productsThumbPath . '/' . $filename);

                // else assign default languages image if file not uploaded and its create method
            } else if (!$file && !$product[$secLang . 'image']) {
                $product[$secLang . 'image'] = $product[$defaultLanguage . 'image'];
            }
        }
    }    

}
