<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactBook;
use Inertia\Inertia;

class ContactBookController extends Controller
{
  public function index()
  {
    return Inertia::render('Home');
  }
}
