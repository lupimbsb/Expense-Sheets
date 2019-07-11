<?php

namespace Gastos\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Request;
use Gastos\User;
use Gastos\Http\Requests\UsersRequest;

class UsersController extends Controller
{
    /**
     * Create a new User controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('create', 'store');
    }

    /**
     * Create a new User list view instance.
     *
     * @return view
     */
    public function index()
    {
        $users = User::all();
        return view('users.userslist')->withUsers($users);
    }

    /**
     * Create a new User form view instance.
     *
     * @return view
     */
    public function create()
    {
        return view("users.usersform");
    }

    /**
     * Store User and create a new list view instance.
     *
     * @return view
     */
    public function store(UsersRequest $request)
    {
        $data = $request->all();
        if (!isset($data["password"])) {
            $data["password"] = 123456;
        }
        $data["password"] = Hash::make($data["password"]);
        if (User::create($data)) {
            return redirect()->action('UsersController@index')->withSuccess('Usuário adicionado com sucesso!');
        } else {
            return redirect()->action('UsersController@index')->withFailure('Não foi possível adicionar o usuário!');
        }
    }

    /**
     * Create a new User form view instance.
     *
     * @return view
     */
    public function edit($id = 0)
    {
        if ($id) {
            $user = User::find($id);
            return view('users.usersform')->withUser($user);
        }
    }

    /**
     * Modify User and create a new list view instance.
     *
     * @return view
     */
    public function update(UsersRequest $request, $id)
    {
        $user = User::find($id);
        $user->fill($request->all());
        if ($user->save()) {
            return redirect()->action('UsersController@index')->withSuccess('Usuário editado com sucesso!');
        } else {
            return redirect()->action('UsersController@index')->withFailure('Não foi possível editar o usuário!');
        }
    }

    /**
     * Destroy User and create a new list view instance.
     *
     * @return view
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (empty($user)) {
            return redirect()->action('UsersController@index')->withFailure('Não foi possível encontrar o usuário!');
        }
        $user->delete();
        return redirect()->action('UsersController@index')->withSuccess('Usuário removido com sucesso!');
    }
}