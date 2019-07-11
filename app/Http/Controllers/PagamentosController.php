<?php

namespace Gastos\Http\Controllers;

use Gastos\User;
use Request;
use Gastos\Pagamento;
use Gastos\Http\Requests\PagamentosRequest;

class PagamentosController extends Controller
{
    /**
     * Create a new Pagamento controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Create a new Pagamento list view instance.
     *
     * @return view
     */
    public function index()
    {
        $pagamentos = Pagamento::all();
        return view('pagamentos.pagamentoslist')->withPagamentos($pagamentos);
    }

    /**
     * Create a new Pagamento form view instance.
     *
     * @return view
     */
    public function create()
    {
        return view("pagamentos.pagamentosform")->with('users', User::all());
    }

    /**
     * Store Pagamento and create a new list view instance.
     *
     * @return view
     */
    public function store(PagamentosRequest $request)
    {
        if (Pagamento::create($request->all())) {
            return redirect()->action('PagamentosController@index')->withSuccess('Pagamento adicionado com sucesso!');
        } else {
            return redirect()->action('PagamentosController@index')->withFailure('Não foi possível adicionar o pagamento!');
        }
    }

    /**
     * Create a new Pagamento form view instance.
     *
     * @return view
     */
    public function edit($id = 0)
    {
        if ($id) {
            $pagamento = Pagamento::find($id);
            return view('pagamentos.pagamentosform')->withPagamento($pagamento)->with('users', User::all());
        }
    }

    /**
     * Modify Pagamento and create a new list view instance.
     *
     * @return view
     */
    public function update(PagamentosRequest $request, $id)
    {
        $pagamento = Pagamento::find($id);
        $pagamento->fill($request->all());
        if ($pagamento->save()) {
            return redirect()->action('PagamentosController@index')->withSuccess('Pagamento editado com sucesso!');
        } else {
            return redirect()->action('PagamentosController@index')->withFailure('Não foi possível editar o pagamento!');
        }
    }

    /**
     * Destroy Pagamento and create a new list view instance.
     *
     * @return view
     */
    public function destroy($id)
    {
        $pagamento = Pagamento::find($id);

        if (empty($pagamento)) {
            return redirect()->action('PagamentosController@index')->withFailure('Não foi possível encontrar o pagamento!');
        }
        $pagamento->delete();
        return redirect()->action('PagamentosController@index')->withSuccess('Pagamento removido com sucesso!');
    }
}
