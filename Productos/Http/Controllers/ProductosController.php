<?php

namespace Modules\Productos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\Productos\Entities\Productos;
use Modules\Productos\Http\Requests\StoreProductosRequest;
use Modules\Productos\Http\Requests\UpdateProductosRequest;

class ProductosController extends Controller
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
        $Inventario =  DB::table('inventory')->get();
        $categoria = DB::table('category')->get();
        $etiqueta = DB::table('tags')->get();
        $estado = DB::table('state_products')->get();
        $fabricante = DB::table('manufacturer')->get();
        $productos = DB::select('SELECT * FROM view_ConsultProducts');

        return view('productos::index', compact('productos', 'categoria', 'etiqueta', 'estado', 'fabricante', 'Inventario'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('productos::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreProductosRequest $request)
    {

        if ($request->file('foto') && str_replace(['$', ','], '', $request->PrecioCompra) <=  str_replace(['$', ','], '', $request->precio)) {

            $image = $request->file('foto');
            $photo_products = 'products/' . $image->getClientOriginalName();
            Storage::disk('products')->putFileAs('', $request->file('foto'), $image->getClientOriginalName());

            productos::create([
                'sku' => ($request->SKU) ? $request->SKU : 0,
                'imagen' => $photo_products,
                'name_products' => $request->NombreProducto,
                'description_products' => $request->DescripcionProducto,
                'quantities' => $request->CantidadCompra,
                'price' => str_replace(['$', ','], '', $request->precio),
                'category_id' => $request->categoria_id,
                'tags_id' => $request->etiqueta_id,
                'inventory_min' => $request->inventarioMin,
                'user_id' => auth()->user()->id,
                'state_id' => $request->estado_id,
                'manufacturer_id' => $request->fabricante_id,
                'inventory_id' => $request->inventario_id
            ]);
        } else {
            if (str_replace(['$', ','], '', $request->PrecioCompra) <= str_replace(['$', ','], '', $request->precio)) {
                productos::create([
                    'sku' => ($request->SKU) ? $request->SKU : 0,
                    'imagen' => 'img/products_default.png',
                    'name_products' => $request->NombreProducto,
                    'description_products' => $request->DescripcionProducto,
                    'quantities' => $request->CantidadCompra,
                    'price' => str_replace(['$', ','], '', $request->precio),
                    'category_id' => $request->categoria_id,
                    'tags_id' => $request->etiqueta_id,
                    'inventory_min' => $request->inventarioMin,
                    'user_id' => auth()->user()->id,
                    'state_id' => $request->estado_id,
                    'manufacturer_id' => $request->fabricante_id,
                    'inventory_id' => $request->inventario_id
                ]);
            } else {
                return redirect()->back()->with('error', 'Por favor verifique el precio no puede ser menor al precio de compra !');
            }
        }

        return redirect('productos')->with('success', 'Se guardo el producto exitosamente !');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {

        $Inventario = DB::table('inventory')->where('id', $id)->get();
        $categoria = DB::table('category')->get();
        $etiqueta = DB::table('tags')->get();
        $estado = DB::table('state_products')->get();
        $fabricante = DB::table('manufacturer')->get();
        $producto = Productos::first();

        return view('productos::show', compact('producto', 'categoria', 'etiqueta', 'estado', 'fabricante', 'Inventario'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {

        $Inventario = DB::table('inventory')->where($id);
        $categoria = DB::table('category')->get();
        $etiqueta = DB::table('tags')->get();
        $estado = DB::table('state_products')->get();
        $fabricante = DB::table('manufacturer')->get();
        $producto = Productos::first();

        return view('productos::edit', compact('producto', 'categoria', 'etiqueta', 'estado', 'fabricante', 'Inventario'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateProductosRequest $request, $id)
    {

        if ($request->file('foto')) {

            $image = $request->file('foto');
            $photo_products = 'products/' . $image->getClientOriginalName();
            Storage::disk('products')->putFileAs('', $request->file('foto'), $image->getClientOriginalName());

            productos::find($id)->update([
                'sku' => ($request->SKU) ? $request->SKU : 0,
                'imagen' => $photo_products,
                'name_products' => $request->NombreProducto,
                'description_products' => $request->DescripcionProducto,
                'quantities' => $request->cantidad,
                'price' => str_replace(['$', ','], '', $request->precio),
                'category_id' => $request->categoria_id,
                'tags_id' => $request->etiqueta_id,
                'inventory_min' => $request->inventarioMin,
                'user_id' => auth()->user()->id,
                'state_id' => $request->estado_id,
                'manufacturer_id' => $request->fabricante_id
            ]);
        } else {
            productos::find($id)->update([
                'sku' => ($request->SKU) ? $request->SKU : 0,
                'imagen' => 'img/products_default.png',
                'name_products' => $request->NombreProducto,
                'description_products' => $request->DescripcionProducto,
                'quantities' => $request->cantidad,
                'price' => str_replace(['$', ','], '', $request->precio),
                'category_id' => $request->categoria_id,
                'tags_id' => $request->etiqueta_id,
                'inventory_min' => $request->inventarioMin,
                'user_id' => auth()->user()->id,
                'state_id' => $request->estado_id,
                'manufacturer_id' => $request->fabricante_id,
            ]);
        }
        return redirect('productos')->with('success', 'Se actualizo el producto exitosamente !');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $operador = productos::find($id);
        Storage::disk('products')->delete($operador->imagen);
        $operador->delete();

        return redirect('productos')->with('error', 'Se elimino el usuario exitosamente !');
    }
}
