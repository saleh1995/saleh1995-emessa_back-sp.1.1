<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $name = 'saleh';
        $age = 28;
        $tag = '<h1>hello</h1>';
        $bool = 123;

        $data = [
            'name' => $name,
            'age' => $age,
            'tag' => $tag,
            'bool' => $bool,
        ];

        return view('home', $data);


        // return view('home')->with('name', $name)->with('age', $age);

        // return view('home', compact('name', 'age'));

        
    }

}
