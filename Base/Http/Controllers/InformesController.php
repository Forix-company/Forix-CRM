<?php

namespace Modules\Base\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
class InformesController extends Controller
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

        $Allcategoria = DB::table('category')->count();
        $Alletiqueta = DB::table('tags')->count();
        $Allproductos = DB::table('products')->count();
        $Allfactory = DB::table('manufacturer')->count();
        $IngresoCount = DB::table('inventory_entry')->count();
        $DevolucionCount = DB::table('inventory_return')->count();

        $DailySale = '$' . number_format(DB::table('view_CalculateSalesDaily')->first()->total_sales, 2, '.', ',');

        $DailySaleLast = '$' . number_format(DB::table('view_CalculateSalesLastWeek')->first()->total_sales, 2, '.', ',');

        $MondaySalesCount = DB::table('view_ConsultationSalesMonday')->first()->total_sales;

        $TuesdaySalesCount = DB::table('view_ConsultationSaleTuesday')->first()->total_sales;

        $WednesSalesCount = DB::table('view_ConsultationSaleWednesday')->first()->total_sales;

        $ThursdaySalesCount = DB::table('view_ConsultationSaleThursday')->first()->total_sales;

        $FirdaySalesCount = DB::table('view_ConsultationSaleFriday')->first()->total_sales;

        $SaturdaySalesCount = DB::table('view_ConsultationSaleSaturday')->first()->total_sales;

        $SundaySalesCount = DB::table('view_ConsultationSaleSunday')->first()->total_sales;

        $SaleMonth = '$' . number_format(DB::table('view_ConsultationSaleMonth')->first()->total_sales, 2, '.', ',');

        $VentaPorMeses = DB::table('view_ConsultationSaleYear')->first();

        $CompraPorMeses = DB::table('view_ConsultationBuyYear')->first();

        $productosActive = DB::table('products')->where('state_id', 1)->count();
        $productosSupend = DB::table('products')->where('state_id', 2)->count();
        $productosCancel = DB::table('products')->where('state_id', 3)->count();

        $ComprasAutorizado = DB::table('buys')->where('authorized_id', 1)->sum('quantity');
        $ComprasNoAutorizado = DB::table('buys')->where('authorized_id', 2)->sum('quantity');

        $total_ingresos = 0;
        $total_gastos = 0;

        return view('base::Dashboard.Informes.index',compact(
            'Allproductos',
            'productosActive',
            'productosSupend',
            'productosCancel',
            'Allcategoria',
            'Alletiqueta',
            'ComprasAutorizado',
            'ComprasNoAutorizado',
            'DailySale',
            'total_ingresos',
            'total_gastos',
            'DailySaleLast',
            'SaleMonth',
            'MondaySalesCount',
            'TuesdaySalesCount',
            'WednesSalesCount',
            'ThursdaySalesCount',
            'FirdaySalesCount',
            'SaturdaySalesCount',
            'SundaySalesCount',
            'IngresoCount',
            'DevolucionCount',
            'VentaPorMeses',
            'CompraPorMeses',
            'Allfactory'
        ));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('base::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('base::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('base::edit');
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
