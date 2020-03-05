<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HandlerApp extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function provider(){
        return view('admin_karrillo.provider');
    }
    public function search_provider(){
        return view('admin_karrillo.search_provider');
    }
}
