<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
 
class AuthController extends Controller
{
    public function register()
    {
        return view('register');
    }
 
    public function registerPost(Request $request)
    {
         // Walidacja danych wejściowych
         $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:80',
            'email' => 'required|email|unique:users|max:255',
            'password' => ['required', 'string', 'min:10', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
            'voivodeship' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withErrors($errors)->withInput();
        }

        $user = new User();
 
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->shoe_size = $request->shoe_size;
        $user->voivodeship = $request->voivodeship;
        $user->save();
 
        return redirect('/home')->with('success', 'Rejestracja przebiegła pomyślnie');
    }
 
    public function login()
    {
        return view('login');
    }
 
    public function loginPost(Request $request)
    {

        $credetials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
 
        if (Auth::attempt($credetials)) {
            return redirect('/home')->with('success', 'Pomyślnie Zalogowano');
        }
 
        return back()->with('error', 'Błąd: Nieprawidłowy email lub hasło');
    }
 
    public function logout()
    {

        Auth::logout();
 
        return redirect('/');
    }

    public function profile()
    {
        return view('profile');
    }
}