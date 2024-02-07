<?php

namespace Modules\Base\Http\Controllers;

use Modules\Base\Exports\BusinessExport;
use Modules\Base\Exports\CategoryExport;
use Modules\Base\Exports\EtiquetaExport;
use Modules\Base\Exports\FactoryExport;
use Modules\Base\Exports\SupplierExport;
use Modules\Base\Imports\CategoryImport;
use Modules\Base\Imports\EtiquetaImport;
use Modules\Base\Imports\FactoryImport;
use Modules\Base\Imports\SupplierImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Routing\Controller;
class ImportExportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('base::Dashboard.ImportDocuments.Import.index');
    }

    public function ExportCategory()
    {
        return Excel::download(new CategoryExport, 'Categoria.xlsx');
    }

    public function ImportCategory(Request $request)
    {
        $file = $request->file('category');

        Excel::import(new CategoryImport, $file);

        return redirect()->back()->with('success', 'Se Importo el Archivo Correctamente exitosamente !');
    }

    public function ExportEtiqueta()
    {
        return Excel::download(new EtiquetaExport, 'Etiqueta.xlsx');
    }

    public function ImportEtiqueta(Request $request)
    {
        $file = $request->file('etiqueta');

        Excel::import(new EtiquetaImport, $file);

        return redirect()->back()->with('success', 'Se Importo el Archivo Correctamente exitosamente !');
    }

    public function ExportFactory()
    {
        return Excel::download(new FactoryExport, 'Fabricante.xlsx');
    }

    public function ImportFactory(Request $request)
    {
        $file = $request->file('factory');

        Excel::import(new FactoryImport, $file);

        return redirect()->back()->with('success', 'Se Importo el Archivo Correctamente exitosamente !');
    }

    public function ExportSupplier()
    {
        return Excel::download(new SupplierExport, 'proveedor.xlsx');
    }

    public function ImportSupplier(Request $request)
    {
        $file = $request->file('proveedor');

        Excel::import(new SupplierImport, $file);

        return redirect()->back()->with('success', 'Se Importo el Archivo Correctamente exitosamente !');
    }
}
