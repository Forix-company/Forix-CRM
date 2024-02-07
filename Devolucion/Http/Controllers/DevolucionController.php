<?php

namespace Modules\Devolucion\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\Devolucion\Entities\Devolucion;
use Modules\Devolucion\Http\Requests\StoreDevolucionRequest;
use Modules\Devolucion\Http\Requests\UpdateDevolucionRequest;

class DevolucionController extends Controller
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
        $Devolucioninventario = DB::select('SELECT * FROM view_returninventory');
        $Proveedor = DB::table('suppliers')->get();
        $MotivoDevolucion = DB::table('inventory_state')->whereIn('id', [3])->get();
        return view('devolucion::index', compact( 'Devolucioninventario','Proveedor', 'MotivoDevolucion'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('devolucion::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreDevolucionRequest $request)
    {

        if ($request->Stock >= $request->Cantidad) {
            $proveedor = DB::table('suppliers')->where('id', $request->proveedor)->first();

            $devolucioninventario = DB::table('inventory_return')->insertGetId([
                'supplier_id' => $request->proveedor,
                'products' => $proveedor->product_offered,
                'quantity' => $request->Cantidad,
                'observations' => $request->observacion,
                'state_id' => $request->MotivoDevolucion,
                'support_document' => null
            ]);

            $inventario = DB::table('inventory')->where('id', $request->producto)->first();

            DB::table('inventory')->where('id', $request->producto)->update([
                'return_id' => $devolucioninventario,
                'stock' => $inventario->stock - $request->Cantidad,
            ]);

            return redirect()->back()->with('success', 'Se creo solicitud de devolucion exitosamente !');
        } else {
            return redirect()->back()->with('error', 'Porfavor Revisar la cantidad no puede ser mayor al Stock');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $Devolucion = DB::select('CALL sp_get_inventory_return(?)', array($id))[0];
        $Proveedor = DB::table('suppliers')->get();
        $EstadoDevolucion = DB::table('inventory_state')->whereIn('id', [3])->get();
        return view('devolucion::show', compact('Devolucion', 'Proveedor', 'EstadoDevolucion'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $Devolucion = DB::select('CALL sp_get_inventory_return(?)', array($id))[0];
        $Proveedor = DB::table('suppliers')->get();
        $EstadoDevolucion = DB::table('inventory_state')->whereIn('id', [4])->get();
        return view('devolucion::edit', compact('Devolucion', 'Proveedor', 'EstadoDevolucion'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateDevolucionRequest $request, $id)
    {
        $image = $request->file('SoporteGarantia');
        $brochure = 'storage/brochure_' . $request->Proveedor . '_SoporteGarantia_' . $request->Producto . '/' . $image->getClientOriginalName();

        Storage::disk('public')->putFileAs('brochure_' . $request->Proveedor . '_SoporteGarantia_' . $request->Producto, $image, $image->getClientOriginalName());

        DB::table('inventory')->where('return_id', $id)->increment('stock', $request->Stock);

        Devolucion::find($id)->update([
            'supplier_id' => $request->Proveedor,
            'products' => $request->Producto,
            'observations' => $request->observacion,
            'state_id' => $request->MotivoDevolucion,
            'support_document' => $brochure
        ]);

        return redirect('devolucion')->with('success', 'Se actualizó la devolución exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $devolucionInventario = Devolucion::find($id);
        Storage::disk('public')->deleteDirectory('brochure_' . $devolucionInventario->supplier_id . "_SoporteGarantia_" . $devolucionInventario->products);
        $devolucionInventario->delete();

        return redirect('devolucion')->with('error', 'Se eliminó la orden de devolución exitosamente!');
    }
}
