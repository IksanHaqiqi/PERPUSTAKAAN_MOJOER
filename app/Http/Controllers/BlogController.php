<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
     public function index(){
        $layout = 'layout.landing';

        if (auth()->check()) {
            if (auth()->user()->role === 'admin') {
                $layout = 'layout.admin';
            } elseif (auth()->user()->role === 'user') {
                $layout = 'layout.user';
            }
        }
        return view('crud.index', compact('lemaris','layout'));
     }
}
