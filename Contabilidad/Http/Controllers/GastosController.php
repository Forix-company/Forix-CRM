<?php

namespace Modules\Contabilidad\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Modules\Contabilidad\Entities\BankAccounts;
use Modules\Contabilidad\Entities\Gastos;

class GastosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $gastos = Gastos::join('Bank_Accounts', 'Expenses.Account_ID', '=', 'Bank_Accounts.id')
            ->join('buys', 'buys.id', '=', 'expenses.buys_id')
            ->select(
                'Expenses.id',
                'buys.name_complete',
                'buys.quantity',
                'Expenses.Concept',
                'Expenses.Amount',
                'Expenses.Dismissal_Date'
            )->get();
        return view('contabilidad::Gastos.index', compact('gastos'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('contabilidad::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param string $request
     * @return Renderable
     */
    public function store($request)
    {
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('contabilidad::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('contabilidad::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
