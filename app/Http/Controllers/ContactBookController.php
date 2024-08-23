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
      'phone.unique' => 'Já existe um contato cadastrado com esse telefone.',
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
  
  public function edit($id)
  {
    $contact = ContactBook::find($id);

    if (!$contact) {
        return redirect()->back();
    }

    return Inertia::render('ContactCreate', [
        'contact' => $contact
    ]);
  }
  
  public function update(Request $request)
  {
    $validator = Validator::make($request->all(), [
        'id' => 'required|exists:contact_books,id',
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:contact_books,email,' . $request->id,
        'phone' => 'nullable|string|unique:contact_books,phone,' . $request->id,
        'address' => 'nullable|string',
    ], [
        'name.required' => 'O nome é obrigatório.',
        'name.max' => 'O nome deve ter no máximo 255 caracteres.',
        'email.email' => 'O e-mail deve ser um endereço válido.',
        'email.unique' => 'Já existe um contato cadastrado com esse e-mail.',
        'phone.unique' => 'Já existe um contato cadastrado com esse telefone.',
        'address.string' => 'O endereço deve ser um texto.',
    ]);

    if ($validator->fails()) {
        return Inertia::render('ContactCreate', [
            'errors' => $validator->errors(),
        ]);
    }
    
    $contact = ContactBook::find($request->id);
    $contact->update($validator->validated());

    return redirect()->route('contact.show', ['id' => $contact->id]);
  }

}