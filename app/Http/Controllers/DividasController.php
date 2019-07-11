<?php

namespace Gastos\Http\Controllers;

use Gastos\Tipo;
use Gastos\Divida;
use Gastos\Devedores;
use Gastos\User;
use Illuminate\Support\Facades\Auth;
use Request;
use Gastos\Http\Requests\DividasRequest;

class DividasController extends Controller
{
    /**
     * Create a new Divida controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Create a new Divida list view instance.
     *
     * @return view
     */
    public function index()
    {
        $dividas = Divida::all();
        return view('dividas.dividaslist')->withDividas($dividas);
    }

    /**
     * Create a new Divida form view instance.
     *
     * @return view
     */
    public function create()
    {
        return view("dividas.dividasform")->with('tipos', Tipo::all())->with('users', User::all());
    }

    /**
     * Store Divida and create a new list view instance.
     *
     * @return view
     */
    public function store(DividasRequest $request)
    {
        $data = $request->all();
        $user = Auth::user();
        $data['criador_id'] = $user->id;
        $insert = Divida::create($data);
        $dividaId = $insert->id;

        foreach ($data['user_id'] as $userId) {
            $dataInsertDevedores = array(
                "user_id" => $userId,
                "divida_id" => $dividaId,
                "porcentagem" => 1 / count($data['user_id'])
            );
            Devedores::create($dataInsertDevedores);
        }
        if ($insert) {
            return redirect()->action('DividasController@index')->withSuccess('Dívida adicionado com sucesso!');
        } else {
            return redirect()->action('DividasController@index')->withFailure('Não foi possível adicionar o dívida!');
        }
    }

    /**
     * Create a new Divida form view instance.
     *
     * @return view
     */
    public function edit($id = 0)
    {
        if ($id) {
            $divida = Divida::find($id);
            return view('dividas.dividasform')->withDivida($divida)->with('tipos', Tipo::all())->with('users', User::all());
        }
    }

    /**
     * Modify Divida and create a new list view instance.
     *
     * @return view
     */
    public function update(DividasRequest $request, $id)
    {
        $divida = Divida::find($id);
        $data = $request->all();
        $divida->fill($data);
        $devedores = $divida->devedores;

        $devedores->each(function ($item) use ($data) {
            $item->delete();
        });

        foreach ($data['user_id'] as $userId) {
            $dataInsertDevedores = array(
                "user_id" => $userId,
                "divida_id" => $divida->id,
                "porcentagem" => 1 / count($data['user_id'])
            );
            Devedores::create($dataInsertDevedores);
        }

        if ($divida->save()) {
            return redirect()->action('DividasController@index')->withSuccess('Dívida editado com sucesso!');
        } else {
            return redirect()->action('DividasController@index')->withFailure('Não foi possível editar o dívida!');
        }
    }

    /**
     * Destroy Divida and create a new list view instance.
     *
     * @return view
     */
    public function destroy($id)
    {
        $divida = Divida::find($id);

        if (empty($divida)) {
            return redirect()->action('DividasController@index')->withFailure('Não foi possível encontrar o dívida!');
        }
        $divida->delete();
        return redirect()->action('DividasController@index')->withSuccess('Dívida removido com sucesso!');
    }
}
