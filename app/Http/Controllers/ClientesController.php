<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Symfony\Contracts\Service\Attribute\Required;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$clientes = Cliente::paginate(2);
        $clientes = Cliente::buscador($request->nombre)
                   ->orderBy('id', 'asc')
                   ->simplePaginate(2);
        return view('clientes.index', compact('clientes' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.crear');
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
            'nombre' => 'required',
            'rfc' => 'required|unique:clientes',
            'email' => 'required|unique:clientes',
        ]);


        $cliente = Cliente::create([
            'nombre' => $request->get('nombre'),
            'rfc' => $request->get('rfc'),
            'direccion' => $request->get('direccion'),
            'telefono' => $request->get('telefono'),
            'email' => $request->get('email')
        ]);

        return redirect()->route('clientes.index');
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
        $cliente = Cliente::find($id);
        return view('clientes.editar', compact('cliente'));
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
            'nombre' => 'required',
            'rfc' => 'required|unique:clientes,rfc,' . $id,
            'telefono' => 'required|numeric',
            'direccion' => 'required',
            'email' => 'required|email|unique:clientes,email,' . $id
        ]);

        $cliente = Cliente::find($id);
        $cliente->nombre = $request->get("nombre");
        $cliente->rfc = $request->get("rfc");
        $cliente->direccion = $request->get("direccion");
        $cliente->telefono = $request->get("telefono");
        $cliente->email = $request->get("email");
        $cliente->save();

        return redirect()->route('clientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();
        return redirect()->route('clientes.index');
    }
}
