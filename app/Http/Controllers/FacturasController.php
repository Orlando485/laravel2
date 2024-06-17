<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Cliente;
use App\Models\FormaPago;
use App\Models\EstadoFactura;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class FacturasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
        $this->middleware('auth');
        $this->middleware('admin', ['except' => 'index']);
     }

    public function index(Request $request)
    {
        // Verifica si la dirección de ordenamiento es válida
        $orderBy = in_array($request->id, ['asc', 'desc']) ? $request->id : 'asc';

        // Realiza la consulta de acuerdo a los parámetros recibidos
        $facturas = factura::BuscadorNumero($request->numero)->orderBy('id', $orderBy)->simplePaginate(2);

        return view('facturas.index', compact('facturas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::orderBy('nombre', 'asc')->pluck('nombre', 'id')->toArray();
        $formas = Formapago::orderBy('nombre', 'asc')->pluck('nombre', 'id')->toArray();
        $estados = EstadoFactura::orderBy('nombre', 'asc')->pluck('nombre', 'id')->toArray();
        return view('facturas.crear', compact('clientes', 'formas', 'estados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'numero' => 'required|numeric',
            'valor' => 'required|numeric',
            'detalles' => 'required',
            'idCliente' => 'required',
            'idEstado' => 'required',
            'idForma' => 'required',
            'archivo' => 'mimes:jpeg,png',
        ]);

        $now = new \DateTime();
        $fecha = $now->format('Ymd-His');
        $numero = $request->get('numero');
        $archivo = $request->file('archivo');
        $nombre = "";

        if ($archivo) {
            $extension = $archivo->getClientOriginalExtension();
            $nombre = "factura-" . $numero . "_" . $fecha . "." . $extension;
            Storage::disk('local')->put($nombre, file_get_contents($archivo));
        }

        $factura = Factura::create([
            'numero' => $request->get('numero'),
            'detalles' => $request->get('detalles'),
            'valor' => $request->get('valor'),
            'archivo' => $nombre,
            'idcliente' => $request->get('idCliente'),
            'idestado' => $request->get('idEstado'),
            'idforma' => $request->get('idForma'),
        ]);

        $mensaje = $factura?'Factura creada con exito':'La Factura no pudo crearse';
        return redirect()->route('facturas.index')->with('mensaje',$mensaje);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $factura = Factura::find($id);
        $clientes = Cliente::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $formas = Formapago::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $estados = Estadofactura::orderBy('nombre', 'asc')->pluck('nombre', 'id');

        return view('facturas.editar', compact('factura', 'clientes', 'formas', 'estados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'numero' => 'required|numeric',
            'valor' => 'required|numeric',
            'detalles' => 'required',
            'idCliente' => 'required',
            'idEstado' => 'required',
            'idForma' => 'required',
            'archivo' => 'mimes:jpeg,png',
        ]);

        $factura = Factura::find($id);

        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');
            $now = new \DateTime();
            $fecha = $now->format('Ymd-His');
            $numero = $request->get('numero');
            $extension = $archivo->getClientOriginalExtension();
            $nombreArchivo = "factura-" . $numero . "_" . $fecha . "." . $extension;
            Storage::disk('local')->put($nombreArchivo, file_get_contents($archivo));

            if ($factura->archivo) {
                Storage::disk('local')->delete($factura->archivo);
            }

            $factura->archivo = $nombreArchivo;
        }

        $factura->numero = $request->get('numero');
        $factura->detalles = $request->get('detalles');
        $factura->valor = $request->get('valor');
        $factura->idcliente = $request->get('idCliente');
        $factura->idestado = $request->get('idEstado');
        $factura->idforma = $request->get('idForma');
        $factura->save();

        return redirect()->route('facturas.index');
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $factura = Factura::findOrFail($id);
        $archivo = $factura->archivo;

        if ($archivo) {
            Storage::delete($archivo);
        }

        $factura->delete();

        return redirect()->route('facturas.index');
    }
}
