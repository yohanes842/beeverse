<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LangController extends Controller
{
    public function Lang($locale)
    {
        if (in_array($locale, ['en', 'in'])) {
            Session::put('applocale', $locale);
        }
        return redirect()->back();
    }
}
