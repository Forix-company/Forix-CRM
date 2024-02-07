<?php

namespace Modules\Proveedores\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Proveedores\Entities\Proveedor;
use Modules\Proveedores\Http\Requests\StoreProveedoresRequest;
use Modules\Proveedores\Http\Requests\UpdateProveedoresRequest;

class ProveedoresController extends Controller
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
        $Proveedor = Proveedor::all();
        return view('proveedores::index', compact('Proveedor'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('proveedores::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreProveedoresRequest $request)
    {

        if ($request->file('brochure')) {

            $image = $request->file('brochure');
            $brochure = 'storage/brochure_' . $request->nit . '/' . $image->getClientOriginalName();
            Storage::disk('public')->putFileAs('brochure_' . $request->nit, $request->file('brochure'), $image->getClientOriginalName());

            Proveedor::create([
                'nit' => $request->nit,
                'name_supplier' => $request->nombreProveedor,
                'email' => $request->correo,
                'phone' => $request->telefono,
                'cell_phone' => $request->celular,
                'address' => $request->direccion,
                'product_offered' => $request->producto_ofrecido,
                'broucher' => $brochure,
                'country' => $request->country,
                'department' => $request->estado,
                'city' => $request->ciudad,

            ]);
        } else {

            Proveedor::create([
                'nit' => $request->nit,
                'name_supplier' => $request->nombreProveedor,
                'email' => $request->correo,
                'phone' => $request->telefono,
                'cell_phone' => $request->celular,
                'address' => $request->direccion,
                'product_offered' => $request->producto_ofrecido,
                'broucher' => NULL,
                'country' => $request->country,
                'department' => $request->estado,
                'city' => $request->ciudad,
            ]);
        }
        return redirect('proveedor')->with('success', 'Se creo el proveedor exitosamente !');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $proveedor = proveedor::find($id);
        return view('proveedores::show', compact('proveedor'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $proveedor = proveedor::find($id);
        return view('proveedores::edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateProveedoresRequest $request, $id)
    {

        if ($request->file('brochure')) {

            $image = $request->file('brochure');
            $brochure = 'storage/brochure_' . $request->nit . '/' . $image->getClientOriginalName();
            Storage::disk('public')->putFileAs('brochure_' . $request->nit, $request->file('brochure'), $image->getClientOriginalName());

            proveedor::find($id)->update([
                'nit' => $request->nit,
                'name_supplier' => $request->nombreProveedor,
                'email' => $request->correo ?? null,
                'phone' => $request->telefono,
                'cell_phone' => $request->celular,
                'address' => $request->direccion,
                'product_offered' => $request->producto_ofrecido,
                'broucher' => $brochure,
                'country' => $request->country,
                'department' => $request->estado,
                'city' => $request->ciudad

            ]);
        } else {
            proveedor::find($id)->update([
                'nit' => $request->nit,
                'name_supplier' => $request->nombreProveedor,
                'email' => $request->correo ?: null,
                'phone' => $request->telefono,
                'cell_phone' => $request->celular,
                'address' => $request->direccion,
                'product_offered' => $request->producto_ofrecido,
                'broucher' => null,
                'country' => $request->country,
                'department' => $request->estado,
                'city' => $request->ciudad

            ]);
        }
        return redirect('proveedor')->with('success', 'Se actualizo los datos exitosamente !');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $proveedor = proveedor::find($id);
        Storage::disk('public')->deleteDirectory('brochure_' . $proveedor->nit);
        $proveedor->delete();

        return redirect()->back()->with('error', 'Se elimino el proveedor exitosamente !');
    }
}
