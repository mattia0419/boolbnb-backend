<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class PageController extends Controller
{
  public function index(Apartment $apartment)
  {
    $title = "Homepage";
    $apartments = Apartment::paginate(10);
    return view('guest.home', compact('title', 'apartments'));
  }
}