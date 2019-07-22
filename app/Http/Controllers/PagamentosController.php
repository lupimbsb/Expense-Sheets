<?php

namespace Gastos\Http\Controllers;

use Gastos\User;
use Gastos\Pagamento;
use Gastos\Http\Requests\PagamentosRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;

class PagamentosController extends Controller
{
    /**
     * Create a new Pagamento controller instance.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Create a new Pagamento list view instance.
     * @return View
     */
    public function index()
    {
        $pagamentos = Pagamento::orderBy("data_referencia", "desc")->get();
        return view('pagamentos.pagamentoslist')->withPagamentos($pagamentos);
    }

    /**
     * Create a new Pagamento form view instance.
     * @return View
     */
    public function create()
    {
        return view("pagamentos.pagamentosform")->with('users', User::all());
    }

    /**
     * Store Pagamento and create a new list view instance.
     * @param PagamentosRequest $request
     * @return RedirectResponse
     */
    public function store(PagamentosRequest $request)
    {
        $previous = str_replace(url('/'), '', URL::previous());
        if (Pagamento::create($request->all())) {
            if ($previous == '/') {
                return redirect()->back()->withSuccess('Pagamento adicionado com sucesso!');
            }
            return redirect()->action('PagamentosController@index')->withSuccess('Pagamento adicionado com sucesso!');
        } else {
            if ($previous == '/') {
                return redirect()->back()->withFailure('Não foi possível adicionar o pagamento!');
            }
            return redirect()->action('PagamentosController@index')->withFailure('Não foi possível adicionar o pagamento!');
        }
    }

    /**
     * Create a new Pagamento form view instance.
     * @param $id
     * @return View
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
     * @param PagamentosRequest $request
     * @param Integer $id
     * @return RedirectResponse
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
     * @param Integer $id
     * @return RedirectResponse
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
