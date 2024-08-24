<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  public function index()
  {    
    $user = User::find(auth()->id());
    
    return Inertia::render('UserView', [
      'user' => $user,
    ]);
  }
  
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
      return Inertia::render('Register', [
        'errors' => $validator->errors(),
      ]);
    }

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    return redirect()->intended(route('login'));
  }
  
  public function edit()
  {
    $user = User::find(auth()->id());
    
    if (!$user) {
        return redirect()->back();
    }

    return Inertia::render('Register', [
        'user' => $user
    ]);
  }
  
  public function update(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users,email,' . $request->id,
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
    
    $user = User::find(auth()->id());

    if ($validator->fails()) {
      return Inertia::render('Register', [
          'user' => $user,
          'errors' => $validator->errors(),
      ]);
    }
    
    $user->update($validator->validated());

    return redirect()->route('user.index');
  }
  
  public function destroy(Request $request)
  {
    $user = User::find(auth()->id());

    if (!$user) {
        return redirect()->back();
    }

    try {
        $user->delete();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('contacts.index')->with('successMessage', 'Contato deletado com sucesso.');
        } catch (\Exception $e) {
        return redirect()->back()->withErrors([
            'delete_error' => 'Ocorreu um erro ao tentar deletar o contato.',
        ]);
    }
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
  
  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect(route('login'));
  }
  
  public function redirectGoogle()
  {
      return Socialite::driver('google')->redirect();
  }
  
  
  public function callbackGoogle()
  {
    try {
      $google_user = Socialite::driver('google')->user();
      $user = User::where('google_id', $google_user->getId())->first();

      if (!$user) {
          $new_user = User::create([
              'name' => $google_user->getName(),
              'google_id' => $google_user->getId(),
              'email' => $google_user->getEmail()
          ]);
          Auth::login($new_user);

          return redirect(route('home'));
      } else {
          Auth::login($user);
          return redirect(route('home'));
      }
    } catch (\Throwable $th) {
      $errors = [];
      $errors['email'] = ['Este e-mail já está em uso por outro método de autenticação. Tente o login padrão.'];

      if (!empty($errors)) {
        return Inertia::render('Login', [
            'errors' => $errors
        ]);
      }
  
      }
  }
}
