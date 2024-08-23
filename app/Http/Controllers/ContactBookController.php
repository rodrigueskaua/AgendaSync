<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
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

  public function create(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:contact_books,email',
      'phone' => 'nullable|string|unique:contact_books,phone',
      'address' => 'nullable|string',
    ], [
      'name.required' => 'O nome é obrigatório.',
      'name.max' => 'O nome deve ter no máximo 255 caracteres.',
      'email.email' => 'O e-mail deve ser um endereço válido.',
      'email.unique' => 'Já existe um contato cadastrado com esse e-mail.',
      'address.string' => 'O endereço deve ser um texto.',
    ]);

    if ($validator->fails()) {
      return Inertia::render('ContactCreate', [
        'errors' => $validator->errors(),
        'form' => $request->all()
      ]);
    }

    $contact = ContactBook::create([
      'name' => $request->name,
      'email' => $request->email,
      'phone' => $request->phone,
      'address' => $request->address,
    ]);

    return redirect()->route('contact.show', ['id' => $contact->id]);
  }
}