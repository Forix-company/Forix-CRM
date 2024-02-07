<?php

namespace Modules\Categoria\Http\Controllers;

use Modules\Categoria\Entities\Categoria;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\Categoria\Http\Requests\StoreCategoriasRequest;
use Modules\Categoria\Http\Requests\UpdateCategoriasRequest;

class CategoriaController extends Controller
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
        $Categoria = Categoria::all();
        return view('categoria::index', compact('Categoria'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreCategoriasRequest $request)
    {

        Categoria::create([
            'name_category' => $request->name_category,
            'description_category' => $request->description_category
        ]);

        return redirect('categoria')->with('success', 'Se Creo la categoria exitosamente !');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $categoria = Categoria::find($id);
        return view('categoria::edit',compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateCategoriasRequest $request, $id)
    {
        Categoria::where('id', $id)->update([
            'name_category' => $request->name_category,
            'description_category' => $request->description_category,
        ]);

        return redirect('categoria')->with('success', 'Se Actualizo la informacion de la categoria !');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        Categoria::find($id)->delete();
        return redirect('categoria')->with('error', 'Se elimino la categoria exitosamente !');
    }
}
