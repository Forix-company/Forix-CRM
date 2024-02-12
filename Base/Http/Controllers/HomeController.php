<?php

namespace Modules\Base\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Modules\Base\Entities\Backups;
use Modules\Base\Entities\plantilla;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('base::Dashboard.Inicio.index');
    }

    function plantillas_index()
    {
        $plantilla = plantilla::first();
        return view('base::Dashboard.Plantillas.index', compact('plantilla'));
    }

    function copias_de_seguridad()
    {
        $backups = DB::table('backups')->get();
        return view('base::Dashboard.Configuracion.seguridad.index', compact('backups'));
    }

    function descargarBackup($id)
    {
        $Backups = Backups::find($id);
        $rutaArchivo = storage_path('app/Laravel/' . $Backups->location);
        // Verificar si el archivo existe
        if (file_exists($rutaArchivo)) {
            $headers = array(
                'Content-Type: application/octet-stream',
                'Content-Length: ' . filesize($rutaArchivo)
            );
            // Configurar la respuesta para descargar el archivo
            return response()->download($rutaArchivo, "Backup_" . $Backups->name . "_" . $Backups->date_create . '.zip', $headers);
        } else {
            // Manejar la situación en la que el archivo no existe
            abort(404, 'El archivo no se encontró');
        }
    }

    function plantillas_store(Request $request)
    {
        plantilla::where('id', 1)->update([
            'color_logo' => $request->color_logo,
            'color_header' => $request->color_header,
            'color_sidebar' => $request->color_sidebar,
            'color_body' => $request->color_body
        ]);

        return redirect()->back()->with('success', 'Se actualizo los datos exitosamente !');
    }
    public function Herramientas()
    {
        return view('base::Dashboard.Configuracion.index');
    }
}
