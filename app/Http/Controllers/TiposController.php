<?php

namespace Gastos\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Gastos\Tipo;
use Gastos\Http\Requests\TiposRequest;

class TiposController extends Controller
{
    /**
     * Create a new Tipo controller instance.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Create a new Tipo list view instance.
     * @return View
     */
    public function index()
    {
        $tipos = Tipo::all();
        return view('tipos.tiposlist')->withTipos($tipos);
    }

    /**
     * Create a new Tipo form view instance.
     * @return View
     */
    public function create()
    {
        return view("tipos.tiposform");
    }

    /**
     * Store Tipo and create a new list view instance.
     * @param TiposRequest $request
     * @return RedirectResponse
     */
    public function store(TiposRequest $request)
    {
        if (Tipo::create($request->all())) {
            return redirect()->action('TiposController@index')->withSuccess('Tipo adicionado com sucesso!');
        } else {
            return redirect()->action('TiposController@index')->withFailure('Não foi possível adicionar o tipo!');
        }
    }

    /**
     * Create a new Tipo form view instance.
     * @param $id
     * @return View
     */
    public function edit($id = 0)
    {
        if ($id) {
            $tipo = Tipo::find($id);
            return view('tipos.tiposform')->withTipo($tipo);
        }
    }

    /**
     * Modify Tipo and create a new list view instance.
     * @param TiposRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(TiposRequest $request, $id)
    {
        $tipo = Tipo::find($id);
        $tipo->fill($request->all());
        if ($tipo->save()) {
            return redirect()->action('TiposController@index')->withSuccess('Tipo editado com sucesso!');
        } else {
            return redirect()->action('TiposController@index')->withFailure('Não foi possível editar o tipo!');
        }
    }

    /**
     * Destroy Tipo and create a new list view instance.
     * @param Integer $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $tipo = Tipo::find($id);

        if (empty($tipo)) {
            return redirect()->action('TiposController@index')->withFailure('Não foi possível encontrar o tipo!');
        }
        $tipo->delete();
        return redirect()->action('TiposController@index')->withSuccess('Tipo removido com sucesso!');
    }
}
