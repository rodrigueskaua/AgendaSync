<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  public function create(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:8|confirmed',
    ], [
      'name.required' => 'O nome é obrigatório.',
      'name.string' => 'O nome deve ser um texto.',
      'name.max' => 'O nome deve ter no máximo 255 caracteres.',
      'email.required' => 'O email é obrigatório.',
      'email.email' => 'O email deve ser um endereço válido.',
      'email.unique' => 'Já existe uma conta cadastrada com esse email.',
      'password.required' => 'A senha é obrigatória.',
      'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
      'password.confirmed' => 'As senhas não conferem.',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'errors' => $validator->errors()->toArray(),
    ], 422);
    }

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    return Inertia::render('Sucess', [
      'message' => 'Usuário cadastrado com sucesso',
    ]);
  }
  
  public function login(Request $request)
  {
    $credentials = $request->only('email', 'password');    
    $user = User::where('email', $credentials['email'])->first();
    
    $errors = [];
    if (!$user) {
        $errors['email'] = ['Não existe um usuário cadastrado com esse e-mail.'];
    }

    if ($user && !Auth::attempt($credentials)) {
        $errors['password'] = ['Senha incorreta.'];
    }

    if (!empty($errors)) {
        return Inertia::render('Login', [
            'errors' => $errors
        ]);
    }

    $request->session()->regenerate();
    return redirect()->intended(route('home'));
  }
}
