<?php

namespace Modules\Empresas\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Empresas\Entities\Empresas;
use Modules\Empresas\Http\Requests\StoreEmpresasRequest;
use Modules\Empresas\Http\Requests\UpdateEmpresasRequest;

class EmpresasController extends Controller
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
        $Empresa = Empresas::all();
        return view('empresas::index', compact('Empresa'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('empresas::create');
    }

    public function store(StoreEmpresasRequest $request)
    {
        $business = new Empresas();
        $business->fill($request->only(['nit', 'business_name', 'mail', 'address', 'country', 'department', 'city']));

        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $photo_avatar = 'business/' . $image->getClientOriginalName();
            Storage::disk('business')->putFileAs('', $image, $image->getClientOriginalName());
            $business->logo = $photo_avatar;
        } else {
            $business->logo = 'business/business_default.png';
        }

        $business->save();

        return redirect('empresa')->with('success', 'Se actualizo los datos exitosamente !');
    }

    public function edit($id)
    {
        $empresa= Empresas::find($id);
        return view('empresas::edit', compact('empresa'));
    }

    public function update(UpdateEmpresasRequest $request, $id)
    {
        $business = Empresas::find($id);
        $business->fill($request->only(['nit', 'business_name', 'mail', 'address', 'country', 'department', 'city']));

        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $photo_avatar = 'business/' . $image->getClientOriginalName();
            Storage::disk('business')->putFileAs('', $image, $image->getClientOriginalName());
            $business->logo = $photo_avatar;
        } else {
            $business->logo = 'business/business_default.png';
        }

        $business->save();

        return redirect('empresa')->with('success', 'Se actualizo los datos exitosamente !');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        Empresas::find($id)->delete();
        return redirect('empresa')->with('error', 'Se elimino el registro exitosamente !');
    }
}
