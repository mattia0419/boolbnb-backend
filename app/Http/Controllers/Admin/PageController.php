<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
  public function index(Apartment $apartment)
  {
    $user = Auth::user();

    $apartments = Apartment::where('user_id', '=', $user->id)->get();

    return view('admin.dashboard', compact('apartments', 'user'));
  }
}