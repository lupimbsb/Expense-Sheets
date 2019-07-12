<?php
/**
 * Created by PhpStorm.
 * User: Lupim
 * Date: 29/01/2019
 * Time: 17:36
 */

namespace Gastos\Http\Controllers;

use Carbon\Carbon;
use Gastos\Divida;
use Gastos\Pagamento;
use Gastos\Tipo;
use Gastos\User;
use Illuminate\Support\Facades\Input;
use Request;

class PainelController extends Controller
{

    /**
     * Create a new Panel controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Create a new Panel dashboard view instance.
     *
     * @return view
     */
    public function dashboard()
    {
        //GET PAST AND RECENT DEBTS AND TOTALS
        $mes = Input::get('month', Carbon::now()->month);
        $currentMonth = Carbon::createFromFormat('m', $mes);
        $lastMonth = Carbon::createFromFormat('m', $mes)->subMonth();

        $pagamentosPassados = Pagamento::whereMonth(
            'data_referencia', '<=', $lastMonth->month
        )->orderBy("data_referencia", "desc")->get();
        $pagamentosRecentes = Pagamento::whereMonth(
            'data_referencia', '=', $currentMonth
        )->orderBy("data_referencia", "desc")->get();
        $dividasPassadas = Divida::whereMonth(
            'data_referencia', '<=', $lastMonth->month
        )->orderBy("data_referencia", "desc")->get();
        $dividasRecentes = Divida::whereMonth(
            'data_referencia', '=', $currentMonth->month
        )->orderBy("data_referencia", "desc")->get();

        $arrayTotais = array();
        foreach (User::all() as $user) {
            $arrayTotais['dividasPassadas'][$user->id] = 0;
            foreach ($dividasPassadas as $dp) {
                if (!$dp->devedores->where("user_id", $user->id)->isEmpty()) {
                    $arrayTotais['dividasPassadas'][$user->id] += $dp->valor * $dp->devedores->where("user_id", $user->id)->first()->porcentagem;
                }
            }
            $arrayTotais['dividasRecentes'][$user->id] = 0;
            foreach ($dividasRecentes as $dr) {
                if (!$dr->devedores->where("user_id", $user->id)->isEmpty()) {
                    $arrayTotais['dividasRecentes'][$user->id] += $dr->valor * $dr->devedores->where("user_id", $user->id)->first()->porcentagem;
                }
            }
            $arrayTotais['pagamentosPassados'][$user->id] = 0;
            foreach ($pagamentosPassados->where("user_id", $user->id) as $pp) {
                $arrayTotais['pagamentosPassados'][$user->id] += $pp->valor;
            }
            $arrayTotais['pagamentosRecentes'][$user->id] = 0;
            foreach ($pagamentosRecentes->where("user_id", $user->id) as $pr) {
                $arrayTotais['pagamentosRecentes'][$user->id] += $pr->valor;
            }
            $arrayTotais['total'][$user->id] = ($arrayTotais["dividasPassadas"][$user->id] - $arrayTotais["pagamentosPassados"][$user->id]) +
                $arrayTotais['dividasRecentes'][$user->id] - $arrayTotais['pagamentosRecentes'][$user->id];

        }
        //GET MONTHS WITH DEBTS REGISTERED
        $months = array();
        if (!Divida::all()->isEmpty()) {
            $firstMonth = str_replace("/", "-", Divida::orderBy("data_referencia", "asc")->first()->data_referencia);
            $lastMonth = str_replace("/", "-", Divida::latest("data_referencia")->first()->data_referencia);
            $start = (new \DateTime($firstMonth))->modify('first day of this month');
            $end = (new \DateTime($lastMonth))->modify('first day of next month');
            $interval = \DateInterval::createFromDateString('1 month');
            $period = new \DatePeriod($start, $interval, $end);

            foreach ($period as $dt) {
                $monthDigit = intval($dt->format("m"));
                if ($currentMonth->month == $monthDigit) {
                    $months[$monthDigit]['current'] = true;
                }
                $months[$monthDigit]['date'] = $dt->format("M/Y");
            }
        }

        //GET DEBTS BY TYPE FOR CHART
        $dividas = Divida::all();
        $dividasPorTipo = $dividas->groupBy(function ($item) {
            return $item['tipo_id'];
        })->mapWithKeys(function ($month) {
            return [$month->first()->tipo->descricao => $month->sum('valor')];
        });

        return view("dashboard")
            ->with("users", User::all())
            ->with('tipos', Tipo::all())
            ->with("dividasPorTipo", $dividasPorTipo)
            ->with("dividas", $dividasRecentes)
            ->with("arrayTotais", $arrayTotais)
            ->with("months", $months)
            ->with("total", array());
    }
}
