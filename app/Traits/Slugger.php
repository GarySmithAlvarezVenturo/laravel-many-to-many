<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Slugger
{
    public static function slugger($string)
    {


        // genera lo slug base

        $baseSlug = Str::slug($string);
        $i = 1;
        $slug = $baseSlug;

        // finche lo slug generatoè presente nella tabella
        while (self::where('slug', $slug)->get()) {
            // genera un nuovo slug concatenando il contatore
            $slug = $baseSlug . '-' . $i;
            // incrementa il contatore
            $i++;
        }

        // ritornare lo slug trovato
        return $slug;
    }
}