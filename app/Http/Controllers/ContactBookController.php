<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\ContactBook;
use Inertia\Inertia;
use Session;
use Illuminate\Support\Facades\Gate;

class ContactBookController extends Controller
{
  public function index()
  {    
    $successMessage = Session::get('successMessage');
    Session::forget('successMessage');
    
    $contacts = ContactBook::where('user_id', auth()->id())
    ->orderBy('name', 'asc')
    ->get();
    
    return Inertia::render('Home', [
      'contacts' => $contacts,
      'successMessage' => $successMessage,
    ]);
  }

  public function show($id)
  {
    try {
      $contact = ContactBook::findOrFail($id);

      if (Gate::denies('view-contact', $contact)) {
        abort(403, 'Você não tem permissão para visualizar este contato.');
      }
      
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
      'user_id' => auth()->id()
    ]);

    return redirect()->route('contact.show', ['id' => $contact->id]);
  }
  
  public function edit($id)
  {
    $contact = ContactBook::find($id);
    
    if (Gate::denies('update-contact', $contact)) {
      abort(403, 'Você não tem permissão para atualizar este contato.');
    }

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
    
    if (Gate::denies('delete-contact', $contact)) {
      abort(403, 'Você não tem permissão para deletar este contato.');
    }
    
    $contact->update($validator->validated());

    return redirect()->route('contact.show', ['id' => $contact->id]);
  }
  
  public function destroy($id)
  {
    $contact = ContactBook::find($id);

    if (!$contact) {
        return redirect()->back();
    }

    try {
        $contact->delete();

        Session::put('successMessage', 'Contato deletado com sucesso.');
        return redirect()->route('contacts.index')->with('successMessage', 'Contato deletado com sucesso.');
        } catch (\Exception $e) {
        return redirect()->back()->withErrors([
            'delete_error' => 'Ocorreu um erro ao tentar deletar o contato.',
        ]);
    }
  }
}