<?php

namespace Modules\Compras\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\Compras\Entities\Compras;
use Modules\Compras\Http\Requests\StoreComprasRequest;
use Modules\Compras\Http\Requests\UpdateComprasRequest;
use Modules\Contabilidad\Entities\BankAccounts;
use Modules\Contabilidad\Entities\Gastos;
use Modules\Contabilidad\Http\Controllers\GastosController;

class ComprasController extends Controller
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

        $Compras = Compras::all();
        $Proveedor = DB::table('suppliers')->get();
        $EstadoCompraDefault = DB::table('state_buys')->whereIn('id', [1, 2, 3])->get();
        $EstadoCompraInventario = DB::table('inventory_state')->whereIn('id', [1, 2])->get();
        $ComprobanteCompra = DB::table('purchase_receipt')->get();
        return view('compras::index', compact('Compras', 'Proveedor', 'EstadoCompraDefault', 'EstadoCompraInventario', 'ComprobanteCompra'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('compras::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreComprasRequest $request)
    {
        $compras = Compras::create([
            'code' => $request->codigo,
            'voucher_id' => $request->TipoCompra,
            'supplier_id' => $request->Proveedor,
            'user_id' => auth()->user()->id,
            'name_complete' => $request->ProveedorProducto,
            'state_id' => $request->Estado,
            'authorized_id' => 2,
            'price' => str_replace(['$', ','], '', $request->Precio),
            'total' => str_replace(['$', ','], '', $request->Total),
            'quantity' => $request->Cantidad,
            'broucher' => ($request->file('brochure')) ? 'storage/brochure_' . $request->codigo . '/' . $request->file('brochure')->getClientOriginalName() : null,
            'discount' => $request->Descuento,
            'observations' => ($request->Observaciones) ? $request->Observaciones : null,
        ]);

        Storage::disk('public')->putFileAs('brochure_' . $request->codigo, $request->file('brochure'), $request->file('brochure')->getClientOriginalName());

        DB::table('transactions')->insert([
            'id_buys' => $compras->id,
            'id_sale' => 0,
            'transaction_type' => 'Orden de Compra',
            'created_at' => new \Datetime(),
            'updated_at' => new \Datetime(),
        ]);

        DB::table('Bank_Transactions')->insert([
            'Account_ID' => BankAccounts::all()->first()->id,
            'Transaction_Date' => new \Datetime(),
            'Transaction_Type' => 'Gastos',
            'Amount' => str_replace(['$', ','], '', $request->Total),
            'created_at' => new \Datetime(),
            'updated_at' => new \Datetime(),
        ]);

        Gastos::create([
            'Account_ID' => BankAccounts::all()->first()->id,
            'Concept' => 'Gastos',
            'Amount' => str_replace(['$', ','], '', $request->Total),
            'Dismissal_Date' => new \Datetime(),
        ]);

        return redirect('compras')->with('success', 'Se creo la compras exitosamente !');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $Compras= Compras::find($id);
        $Proveedor = DB::table('suppliers')->where('id', $Compras->supplier_id)->first();
        $EstadoCompraDefault = DB::table('state_buys')->whereIn('id', [1, 2, 3])->first();
        $EstadoCompraInventario = DB::table('inventory_state')->whereIn('id', [1, 2])->first();
        $ComprobanteCompra = DB::table('purchase_receipt')->first();
        return view('compras::show', compact('Compras', 'Proveedor', 'EstadoCompraDefault', 'EstadoCompraInventario', 'ComprobanteCompra'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $Compras= Compras::find($id);
        $Proveedor = DB::table('suppliers')->where('id', $Compras->supplier_id)->get();
        $EstadoCompraDefault = DB::table('state_buys')->whereIn('id', [1, 2, 3])->get();
        $EstadoCompraInventario = DB::table('inventory_state')->whereIn('id', [1, 2])->get();
        $ComprobanteCompra = DB::table('purchase_receipt')->get();
        return view('compras::edit', compact('Compras', 'Proveedor', 'EstadoCompraDefault', 'EstadoCompraInventario', 'ComprobanteCompra'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateComprasRequest $request, $id)
    {
        $compras = Compras::find($id);

        $compras->update([
            'code' => $request->codigo,
            'voucher_id' => $request->TipoCompra,
            'supplier_id' => $request->Proveedor,
            'user_id' => auth()->user()->id,
            'name_complete' => $request->ProveedorProducto,
            'state_id' => $request->Estado,
            'authorized_id' => 2,
            'price' => str_replace(['$', ','], '', $request->Precio),
            'total' => str_replace(['$', ','], '', $request->Total),
            'quantity' => $request->Cantidad,
            'broucher' => ($request->file('brochure')) ? 'storage/brochure_' . $request->codigo . '/' . $request->file('brochure')->getClientOriginalName().uniqid() : null,
            'discount' => $request->Descuento,
            'observations' => ($request->Observaciones) ? $request->Observaciones : null,
        ]);

        Storage::disk('public')->deleteDirectory('brochure_' . $compras->code);
        Storage::disk('public')->putFileAs('brochure_' . $request->codigo, $request->file('brochure'), $request->file('brochure')->getClientOriginalName().uniqid());

        if ($request->autorizacion == 1) {
            $IngresoInventario = DB::table('ingreso_inventario')->where('proveedor_id', $request->Proveedor)->first();

            DB::table('ingreso_inventario')->where('proveedor_id', $request->Proveedor)
                ->update([
                    'proveedor_id' => $request->Proveedor,
                    'compra_id' => $compras->id,
                    'producto' => $compras->nombreCompleto,
                    'cantidad' => $request->Cantidad,
                    'precio_proveedor' => $request->Precio,
                    'estado_id' => 1,
                ]);

            DB::table('inventario')->where('ingreso_id', $IngresoInventario->id)
                ->update([
                    'codigo' => $compras->codigo,
                    'nombre' => $compras->nombreCompleto,
                    'stock' => $request->Cantidad,
                    'devoluciones_id' => null,
                ]);
        }

        return redirect('compras')->with('success', 'Se actualizó la compra exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $compras = Compras::find($id);
        Storage::disk('public')->deleteDirectory('brochure_' . $compras->code);
        $compras->delete();
        return redirect('compras')->with('error', 'Se elimino el registro de compra exitosamente !');
    }
}
