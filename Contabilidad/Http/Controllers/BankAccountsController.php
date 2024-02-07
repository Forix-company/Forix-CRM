<?php

namespace Modules\Contabilidad\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Contabilidad\Entities\AccountsPayable;
use Modules\Contabilidad\Entities\AccountsReceivable;
use Modules\Contabilidad\Entities\Balance;
use Modules\Contabilidad\Entities\BankAccounts;
use Illuminate\Support\Facades\DB;
use Modules\Proveedores\Entities\Proveedor;

class BankAccountsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $Bank_Accounts = BankAccounts::all();
        return view('contabilidad::Banks.index', compact('Bank_Accounts'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        BankAccounts::create([
            'Bank_name' => $request->Name_bank,
            'Bank_type' => $request->Bank_type,
            'balance' => str_replace(['$', ','], '', $request->Total),
        ]);

        return redirect('contabilidad/cuentas')->with('success', 'Se creo la compras exitosamente !');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $Bank_Accounts = BankAccounts::find($id);
        return view('contabilidad::Banks.show', compact('Bank_Accounts'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $Bank_Accounts = BankAccounts::find($id);
        return view('contabilidad::Banks.edit', compact('Bank_Accounts'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $Bank_Accounts = BankAccounts::find($id);
        $Bank_Accounts->update([
            'Bank_name' => $request->Name_bank,
            'Bank_type' => $request->Bank_type,
            'balance' => str_replace(['$', ','], '', $request->Total),
        ]);

        return redirect('contabilidad/cuentas')->with('success', 'Se creo la compras exitosamente !');
    }

    function transacciones()
    {

        $Transacciones = DB::table('Bank_Transactions')->join('bank_accounts', 'bank_accounts.id', '=', 'Bank_Transactions.Account_ID')
            ->select(
                'bank_transactions.id',
                'bank_accounts.Bank_name',
                'bank_accounts.Bank_type',
                'bank_transactions.Transaction_Type',
                'bank_transactions.Transaction_Date',
                'bank_transactions.Amount'
            )->get();
        return view('contabilidad::Transacciones.index', compact('Transacciones'));
    }

    function AccountsReceivable()
    {
        $AccountsReceivable = DB::table('Accounts_Receivable')->join('bank_accounts', 'bank_accounts.id', '=', 'Accounts_Receivable.Account_id')
            ->join('customer', 'customer.id', '=', 'Accounts_Receivable.Client_id')
            ->select(
                'Accounts_Receivable.id',
                'customer.name_customer',
                'Accounts_Receivable.description',
                'Accounts_Receivable.AmountReceivable',
                'Accounts_Receivable.created_at'
            )->get();
        $supplier = Proveedor::all();
        $Cuenta = BankAccounts::all();
        $Cliente = DB::table('customer')->where('name_customer', '!=', 'Cliente anonimo')->get();
        return view('contabilidad::AccountsReceivable.index', compact('AccountsReceivable', 'supplier', 'Cuenta', 'Cliente'));
    }

    function AccountsReceivable_store(Request $request)
    {
        AccountsReceivable::create([
            'Client_id' => $request->supplier,
            'Account_id' => $request->account,
            'description'=>$request->observacion,
            'AmountReceivable' => str_replace(['$', ','], '', $request->Precio),
        ]);

        return redirect('contabilidad/cuentas-por-cobrar')->with('success', 'Se guardo exitosamente !');
    }

    function AccountsPayable()
    {

        $AccountsPayable = DB::table('Accounts_Payable')->join('suppliers', 'suppliers.id', '=', 'accounts_payable.supplier_id')
            ->join('Bank_Accounts', 'Bank_Accounts.id', '=', 'accounts_payable.Account_id')
            ->select(
                'Accounts_Payable.id',
                'suppliers.name_supplier',
                'Accounts_Payable.description',
                'Accounts_Payable.AmountToPay',
                'Accounts_Payable.created_at'
            )->get();
        $supplier = Proveedor::all();
        $Cuenta = BankAccounts::all();
        return view('contabilidad::AccountsPayable.index', compact('AccountsPayable', 'supplier', 'Cuenta'));
    }

    function AccountsPayable_store(Request $request)
    {
        AccountsPayable::create([
            'supplier_id' => $request->supplier,
            'Account_id' => $request->account,
            'description'=>$request->observacion,
            'AmountToPay' => str_replace(['$', ','], '', $request->Precio),
        ]);

        return redirect('contabilidad/cuentas-por-pagar')->with('success', 'Se guardo exitosamente !');
    }

    function balance()
    {
        $Balance = Balance::join('income','income.id','=','balance_sheet.income_id')
        ->join('expenses','expenses.id','=','balance_sheet.expenses_id')
        ->select('balance_sheet.id','balance_sheet.price_total_income','balance_sheet.price_total_expenses','balance_sheet.date_balance');
        return view('contabilidad::balance.index', compact('Balance'));
    }

}
