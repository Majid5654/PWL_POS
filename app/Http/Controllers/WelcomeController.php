<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){
        $breadcrumb = (object)[
            'title' => 'Welcome',
            'list' => ['Home','welcome']
        ];
        $activeMenu = 'dashboard';
        return view('welcome', compact('breadcrumb', 'activeMenu'));
        
    }
}
