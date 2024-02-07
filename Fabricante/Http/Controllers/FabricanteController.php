<?php

namespace Modules\Fabricante\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Fabricante\Entities\Fabricantes;
use Modules\Fabricante\Http\Requests\StoreFabricanteRequest;
use Modules\Fabricante\Http\Requests\UpdateFabricanteRequest;

class FabricanteController extends Controller
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
        $Fabricante = Fabricantes::all();
        return view('fabricante::index', compact('Fabricante'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('fabricante::create');
    }

/**
 * Store a newly created resource in storage.
 *
 * @param StoreFabricanteRequest $request
 * @return Illuminate\Http\RedirectResponse
 */
public function store(StoreFabricanteRequest $request)
{
    $fabricante = Fabricantes::create([
        'name_manufacturer' => $request->name_manufacturer,
    ]);

    return redirect('fabricante')->with('success', 'Se Creo el Fabricante !');
}

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('fabricante::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $fabricante = Fabricantes::find($id);
        return view('fabricante::edit', compact('fabricante'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateFabricanteRequest $request, $id)
    {
        Fabricantes::where('id', $id)
            ->update(['name_manufacturer' => $request->name_manufacturer]);

        return redirect('fabricante')->with('success', 'Se Actualizo la informacion del Fabricante !');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        Fabricantes::find($id)->delete();
        return redirect('fabricante')->with('error', 'Se elimino el fabricante exitosamente !');
    }
}
