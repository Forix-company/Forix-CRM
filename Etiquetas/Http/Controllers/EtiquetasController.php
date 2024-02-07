<?php

namespace Modules\Etiquetas\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Etiquetas\Entities\Etiquetas;
use Modules\Etiquetas\Http\Requests\StoreEtiquetasRequest;
use Modules\Etiquetas\Http\Requests\UpdateEtiquetasRequest;

class EtiquetasController extends Controller
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
        $Etiqueta  = Etiquetas::all();
        return view('etiquetas::index', compact('Etiqueta'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('etiquetas::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreEtiquetasRequest $request)
    {

        Etiquetas::create([
            'name_tags' => $request->name_tags,
            'description_tags' => $request->description_tags,
        ]);

        return redirect('etiqueta')->with('success', 'Se Creo la etiqueta !');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('etiquetas::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $etiqueta = Etiquetas::find($id);
        return view('etiquetas::edit', compact('etiqueta'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateEtiquetasRequest $request, $id)
    {
        Etiquetas::where('id', $id)->update([
            'name_tags' => $request->name_tags,
            'description_tags' => $request->description_tags,
        ]);
        return redirect('etiqueta')->with('success', 'izo la informacion de la etiqueta !');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        Etiquetas::find($id)->delete();
        return redirect('etiqueta')->with('error', 'Se elimino la etiqueta exitosamente !');
    }
}
