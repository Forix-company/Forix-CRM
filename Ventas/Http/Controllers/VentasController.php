<?php

namespace Modules\Ventas\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Contabilidad\Entities\BankAccounts;
use Modules\Contabilidad\Entities\Ingresos;
use Modules\Productos\Entities\Productos;
use Modules\Ventas\Entities\Ventas;
use Modules\Ventas\Http\Requests\StoreVentasRequest;

class VentasController extends Controller
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
        $Ventas = DB::select('SELECT * FROM view_consultsales');

        $MetodoPago = DB::table('payment_method')->get();
        $Productos = Productos::all();
        $ComprobanteVentas = DB::table('sales_receipt')->get();
        $EstadoVentas = DB::table('sales_state')->get();

        $EstadoVentaOnline = DB::table('sales')
            ->join('payment_gateway_states', 'payment_gateway_states.referenceCode', '=', 'sales.id_sales_check')
            ->join('payment_configurations', 'payment_configurations.merchantId', '=', 'payment_gateway_states.merchantId')
            ->select('payment_gateway_states.merchantId', 'payment_configurations.NombreIniciales')
            ->first();

        return view('ventas::index', compact('MetodoPago', 'Ventas', 'Productos', 'ComprobanteVentas', 'EstadoVentas', 'EstadoVentaOnline'));
    }


    public function SaleEmailPayments($id)
    {
        $Ventas = DB::table('sales')
            ->join('customer', 'customer.id', '=', 'sales.customer_id')
            ->join('sales_detail', 'sales_detail.id', '=', 'sales.sale_id')
            ->select(
                'customer.nit',
                'customer.name_customer',
                'customer.email',
                'customer.phone',
                'customer.cell_phone',
                'sales_detail.products',
                'sales_detail.quantity',
                'sales_detail.price'
            )->where('sales.id', $id)->first();

        $Payment = DB::table('payment_configurations')->get();
        return view('ventas::SendPayment', compact('Ventas', 'id', 'Payment'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreVentasRequest $request)
    {

        if ($request->Verificacion == "SI") {
            $Cliente = DB::table('customer')->insertGetId([
                'nit' => $request->nit,
                'name_customer' => $request->nombre,
                'email' => $request->correo,
                'phone' => $request->telefono,
                'cell_phone' => $request->celular,
                'adress' => $request->direccion,
                'country' => $request->country,
                'departament' => $request->estado,
                'city' => $request->ciudad,
                'created_at' => new \Datetime(),
                'updated_at' => new \Datetime(),
            ]);


            $TotalInventario = $request->CantidadVenta - $request->Cantidad;

            if ($TotalInventario >= 0) {

                $ClienteID = $Cliente;

                $Productos = DB::table('products')->where('id', $request->Productos)->select('name_products', 'description_products')->first();

                $DetalleVentas = DB::table('sales_detail')->insertGetId([
                    'products' => $Productos->name_products,
                    'price' => str_replace(['$', ','], '', $request->Total),
                    'quantity' => $request->Cantidad,
                    'discount' => $request->Descuento,
                    'created_at' => new \Datetime(),
                    'updated_at' => new \Datetime(),
                ]);

                $ventas = Ventas::insertGetId([
                    'customer_id' => $ClienteID,
                    'id_sales_check' => uniqid(),
                    'user_id' => auth()->user()->id,
                    'sale_id' => $DetalleVentas,
                    'products_id' => $request->Productos,
                    'receipt_sales_id' => $request->TipoComprobante,
                    'observations' => $request->observaciones ?: null,
                    'sale_state_id' => $request->estado,
                    'payment_method_id' => $request->MetodoPago,
                    'created_at' => new \Datetime(),
                    'updated_at' => new \Datetime(),
                ]);

                DB::table('inventory')->where('code', $request->sku)
                    ->update([
                        'stock' => $TotalInventario,
                    ]);

                DB::table('transactions')->insert([
                    'id_sale' => $ventas,
                    'id_buys' => 0,
                    'transaction_type' => 'Orden de Venta',
                    'created_at' => new \Datetime(),
                    'updated_at' => new \Datetime(),
                ]);

                DB::table('Bank_Transactions')->insert([
                    'Account_ID' => BankAccounts::all()->first()->id,
                    'Transaction_Date' => new \Datetime(),
                    'Transaction_Type' => 'Ventas',
                    'Amount' => str_replace(['$', ','], '', $request->Total),
                    'created_at' => new \Datetime(),
                    'updated_at' => new \Datetime(),
                ]);

                Ingresos::create([
                    'Account_ID' => BankAccounts::all()->first()->id,
                    'Concept' => 'Ventas',
                    'Amount' => str_replace(['$', ','], '', $request->Total),
                    'Admission_date' => new \Datetime(),
                ]);

                return redirect()->back()->with('success', 'Se Creo la venta Correctamente !');
            } else {

                return redirect()->back()->with('error', 'Por favor verifique la cantidad no puede ser menor a la cantidad en inventario !');
            }
        } else {

            $Cliente = DB::table('customer')->insertGetId([
                'nit' => 0,
                'name_customer' => "Cliente anonimo",
                'email' => null,
                'phone' => null,
                'cell_phone' => null,
                'adress' => null,
                'country' => null,
                'departament' => null,
                'city' => null,
                'created_at' => new \Datetime(),
                'updated_at' => new \Datetime(),
            ]);


            $TotalInventario = $request->CantidadVenta - $request->Cantidad;

            if ($TotalInventario >= 0) {

                $ClienteID = $Cliente;

                $Productos = DB::table('products')->where('id', $request->Productos)->select('name_products', 'description_products')->first();

                $DetalleVentas = DB::table('sales_detail')->insertGetId([
                    'products' => $Productos->name_products,
                    'quantity' => $request->Cantidad,
                    'price' => str_replace(['$', ','], '', $request->Total),
                    'discount' => $request->Descuento,
                    'created_at' => new \Datetime(),
                    'updated_at' => new \Datetime(),
                ]);

                $ventas = Ventas::insertGetId([
                    'id_sales_check' => uniqid(),
                    'customer_id' => $ClienteID,
                    'user_id' => auth()->user()->id,
                    'sale_id' => $DetalleVentas,
                    'products_id' => $request->Productos,
                    'receipt_sales_id' => $request->TipoComprobante,
                    'observations' => $request->observaciones ?? null,
                    'sale_state_id' => $request->estado,
                    'payment_method_id' => $request->MetodoPago,
                    'created_at' => new \Datetime(),
                    'updated_at' => new \Datetime(),
                ]);

                DB::table('inventory')->where('id', $request->sku)
                    ->update([
                        'stock' => $TotalInventario,
                    ]);

                DB::table('products')->where('id', $request->Productos)
                    ->update([
                        'quantities' => $TotalInventario,
                    ]);

                DB::table('transactions')->insert([
                    'id_sale' => $ventas,
                    'id_buys' => 0,
                    'transaction_type' => 'Orden de Venta',
                    'created_at' => new \Datetime(),
                    'updated_at' => new \Datetime(),
                ]);

                DB::table('Bank_Transactions')->insert([
                    'Account_ID' => BankAccounts::all()->first()->id,
                    'Transaction_Date' => new \Datetime(),
                    'Transaction_Type' => 'Ventas',
                    'Amount' => str_replace(['$', ','], '', $request->Total),
                    'created_at' => new \Datetime(),
                    'updated_at' => new \Datetime(),
                ]);

                Ingresos::create([
                    'Account_ID' => BankAccounts::all()->first()->id,
                    'Concept' => 'Venta',
                    'Amount' => str_replace(['$', ','], '', $request->Total),
                    'Admission_date' => new \Datetime(),
                ]);

            } else {
                return redirect()->back()->with('error', 'Por favor verifique la cantidad no puede ser menor a la cantidad en inventario !');
            }
        }
        return redirect()->back()->with('success', 'Se Creo la venta Correctamente !');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $DescripcionVentas = DB::table('sales')
            ->join('payment_method', 'sales.payment_method_id', '=', 'payment_method.id')
            ->join('customer', 'sales.customer_id', '=', 'customer.id')
            ->join('sales_detail', 'sales.sale_id', '=', 'sales_detail.id')
            ->select(
                'customer.name_customer',
                'payment_method.PaymentMethod',
                'sales_detail.products',
                'sales_detail.price',
                'sales_detail.quantity',
                'sales_detail.discount'
            )->where('sales.id', $id)
            ->first();

        $Pago = DB::table('sales')->join('payment_gateway_states', 'payment_gateway_states.referenceCode', '=', 'sales.id_sales_check')->select('payment_gateway_states.estadoTx')->where('sales.id', $id)->first();

        return view('ventas::show', compact('DescripcionVentas', 'Pago'));
    }

    public function PosIndex()
    {
        $Productos = Productos::all();
        return view('ventas::POS.index', compact('Productos'));
    }
    public function TotalProductosPost(Request $request)
    {
        $Productos = Productos::find($request->id);
        $response = [
            'nombre' => strtoupper($Productos->name_products),
            'price' => "$" . number_format($Productos->price, 2, '.', ','),
        ];

        return $response;
    }
}
