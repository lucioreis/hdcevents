<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
  //
  public function index()
  {
    $search = request('search');
    return view('products', ['search' => $search]);
  }
}
