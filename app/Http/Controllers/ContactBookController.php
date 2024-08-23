<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\ContactBook;
use Inertia\Inertia;

class ContactBookController extends Controller
{
  public function index()
  {
    $contacts = ContactBook::all();
    
    return Inertia::render('Home', [
      'contacts' => $contacts,
    ]);
  }

  public function show($id)
  {
    try {
      $contact = ContactBook::findOrFail($id);

      return Inertia::render('ContactView', [
        'contact' => $contact,
      ]);
    } catch (ModelNotFoundException $e) {
      return redirect()->route('home');
    }
  }
}
