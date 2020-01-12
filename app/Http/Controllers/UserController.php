<?php

namespace App\Http\Controllers;

use App\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        $user = Auth::user();
        //print_r($user);
        return view('users.edit', compact('user'));
    }

    public function editSubmit(Request $request)
    {
        $user = Auth::user();

        if (Hash::check($request->passwordCheck, $user->password)) {
            if ($user->email != $request->email) { //só atualiza de o campo estiver preenchido e passar a validação
                request()->validate([
                    'email' => 'required|email|unique:users',
                ], [

                    'email.unique' => 'Este email já está a ser utilizado',
                ]);
                $user->email = $request->email;
            }
            if ($user->name != $request->name) {
                request()->validate([
                    'name' => 'required|unique:users',
                ], [
                    'name.unique' => 'Este nome já está a ser utilizado',
                ]);
                $user->name = $request->name;
            }
            if ($request->password != '') {
                request()->validate([
                    'password' => 'required|min:8|confirmed',
                ]);
                $user->password = bcrypt($request->password);
            }

            $user->save();

            session()->flash('notif', 'A sua conta foi atualizada com sucesso!');

            return redirect('/');
        }
        session()->flash('err', 'Palavra-passe não coincide com a do utilizador!');
        return back();

    }
}
