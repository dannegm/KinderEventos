<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller {
    // Views
    public function viewIndex () {
        $users = User::orderBy('name', 'asc')->get();
        $data = array(
            'title' => 'Usuarios',
            'section' => 'users',
            'users' => $users
        );
        return view('panel.users.index', $data);
    }

    public function viewNew () {
        $data = array(
            'title' => 'Nuevo usuario',
            'section' => 'users'
        );
        return view('panel.users.new', $data);
    }

    public function viewEdit ($id) {
        $user = User::where('id', '=', $id)->take(1)->get();
        $data = array(
            'title' => "Editar usuario",
            'section' => 'users',
            'user' => $user[0]
        );
        return view('panel.users.edit', $data);
    }

    // Actions
    public function actionCreate (Request $request) {
        $rules = array(
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        );

        $messages = array (
            'name.required' => 'El nombre es necesario',
            'email.required' => 'El email es obligatorio',
            'email.email' => 'No colocaste un email válido',
            'password.required' => 'Es obligatorio colocar una contraseña'
        );

        //check validation
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return redirect()->route('users.new')
                ->withErrors($validator)
                ->withInput();
        } else {
            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->save();

            return redirect()->route('users.index');
        }
    }

    public function actionUpdate (Request $request, $id) {
        $rules = array(
            'name' => 'required',
            'email' => 'required|email',
        );
        $messages = array(
            'name.required' => 'El nombre es necesario',
            'email.required' => 'El email es obligatorio',
            'email.email' => 'No colocaste un email válido'
        );

        //check validation
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $messages = $validator->messages();
            return redirect()->route('users.edit', ['id'=>$id])
                ->withErrors($validator)
                ->withInput();
        } else {
            $users = User::where('id', '=', $id)->take(1)->get();
            $user = $users[0];

            $user->name = $request->input('name');
            $user->email = $request->input('email');

            if ($request->has('password')) {
                $user->password = bcrypt($request->input('password'));
            }

            $user->save();
            return redirect()->route('users.edit', ['id' => $user->id]);
        }
    }

    public function actionDelete ($id) {
        $users = User::where('id', '=', $id)->take(1)->get();
        $user = $users[0];
        $user->delete();
        return redirect()->route('users.index');
    }

}