<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function homepage()
    {
        return view('welcome');
        // $articles = Article::take(6)->orderBy('create_at', 'desc')->get();
        // return view('welcome', compact('articles'));
    }

    
}
