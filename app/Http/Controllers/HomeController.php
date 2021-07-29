<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function get_home_page () {
        try {
            return view('backend.home');
        } catch (\Exception $exception) {
            return view('backend.error');
        }
    }
}
