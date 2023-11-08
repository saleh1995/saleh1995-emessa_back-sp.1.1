<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view('home');
    }



    public function store(){
        return 'store';
    }
    public function update(){
        return 'update';
    }
    public function delete(){
        return 'delete';
    }
}
