<?php

namespace Modules\Base\Http\Controllers;

use Modules\Base\Http\Requests\StoreModulesRequest;
use Modules\Base\Http\Requests\UpdateModulesRequest;
use Modules\Base\Entities\Modules;
use Illuminate\Support\Facades\Artisan;
use Nwidart\Modules\Facades\Module;
use Illuminate\Routing\Controller;
class ModulesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allModules = Module::all();
        return view('base::Dashboard.Modulos.index', compact('allModules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreModulesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreModulesRequest $request)
    {
        $modulosActivados = $request->input('modules', []);

        Modules::truncate();

        $modulosInstalados = Module::all();

        foreach ($modulosInstalados as $modulo) {
            // Verificar si el módulo está en la lista de módulos seleccionados
            if (in_array($modulo->getName(), $modulosActivados)) {
                // Si está seleccionado y no está activo, lo activamos
                if (!$modulo->isEnabled()) {
                    Module::enable($modulo->getName());
                }
                Modules::updateOrCreate([
                    'name' => $modulo->getName(),
                    'status' => 1
                ]);
            } else {
                // Si no está seleccionado y está activo, lo desactivamos
                if ($modulo->isEnabled()) {
                    Module::disable($modulo->getName());
                }
                Modules::updateOrCreate([
                    'name' => $modulo->getName(),
                    'status' => 0
                ]);
            }
        }

        return redirect()->back()->with('success', 'Módulos guardados correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Modules  $modules
     * @return \Illuminate\Http\Response
     */
    public function show(Modules $modules)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Modules  $modules
     * @return \Illuminate\Http\Response
     */
    public function edit(Modules $modules)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateModulesRequest  $request
     * @param  \App\Models\Modules  $modules
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateModulesRequest $request, Modules $modules)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Modules  $modules
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modules $modules)
    {
        //
    }
}
