<?php

namespace Modules\Pasarela\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Pasarela\Entities\PayUConfiguration;

class PasarelaController extends Controller
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
        $PayUConfiguration = PayUConfiguration::all();
        return view('pasarela::index', compact('PayUConfiguration'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('pasarela::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        switch ($request->iniciales) {
            case 'PayU':
                $PayU = new PayUConfiguration();
                $PayU->NombrePasarela = $request->pasarela;
                $PayU->NombreIniciales = $request->iniciales;
                $PayU->URL = $request->URL;
                $PayU->tax = $request->tax;
                $PayU->ApiKey = $request->ApiKey;
                $PayU->taxReturnBase = $request->taxReturnBase;
                $PayU->test = $request->test;
                $PayU->currency = $request->currency;
                $PayU->responseUrl = $request->responseUrl;
                $PayU->accountId = $request->accountId;
                $PayU->merchantId = $request->merchantId;
                $PayU->save();
                break;

            case 'Epayco':
                $PayU = new PayUConfiguration();
                $PayU->NombrePasarela = $request->pasarela;
                $PayU->NombreIniciales = $request->iniciales;
                $PayU->URL = $request->URL;
                $PayU->tax = $request->tax;
                $PayU->ApiKey = $request->ApiKey;
                $PayU->taxReturnBase = $request->taxReturnBase;
                $PayU->test = $request->test;
                $PayU->currency = $request->currency;
                $PayU->responseUrl = $request->responseUrl;
                $PayU->accountId = $request->accountId;
                $PayU->merchantId = $request->merchantId;
                $PayU->save();
                break;
                
            default:
                # code...
                break;
        }
        return redirect()
            ->back()
            ->with('success', 'Se Creo la Pasarela de Pago Con PayU Correctamente !');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $PayUConfiguration = PayUConfiguration::find($id);
        return view('pasarela::show', compact('PayUConfiguration'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $PayUConfiguration = PayUConfiguration::find($id);
        return view('pasarela::edit', compact('PayUConfiguration'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $PayU = PayUConfiguration::find($id);
        $PayU->ApiKey = $request->ApiKey;
        $PayU->accountId = $request->accountId;
        $PayU->merchantId = $request->merchantId;
        $PayU->update();

        return redirect('configuracion/payments')->with('success', 'Se Actualizo la Pasarela de Pago Correctamente !');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $PayU = PayUConfiguration::find($id);
        $PayU->delete();

        return redirect()
            ->back()
            ->with('error', 'Se elimino la pasarela de pago Correctamente !');
    }
}
