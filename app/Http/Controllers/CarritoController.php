<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        if (!Session::has('carrito')) {
            Session::put('carrito', array());
        }
    }
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show() // $id)
    {
        $carrito = Session::get('carrito');
        $total = $this->total();
        // return $carrito
        return view('carrito', compact('carrito', 'total'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $cantidad)
    {
        $carrito = Session::get('carrito');
        $producto = Producto::find($id);
        $carrito[$producto->id]->cantidad = $cantidad;
        Session::put('carrito', $carrito);
        return redirect()->route('carrito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carrito = Session::get('carrito');
        unset($carrito[$id]);
        Session::put('carrito', $carrito);
        return redirect()->route('carrito');
    }

    public function add($id)
    {
        $carrito = Session::get('carrito');
        $producto = Producto::find($id);

        $producto->cantidad = 1;

        $carrito[$producto->id] = $producto;
        Session::put('carrito', $carrito);
        return redirect()->route('carrito');
    }

    public function trash()
    {
        Session::forget('carrito');
        return redirect()->route('carrito');
    }

    public function total()
    {
        $carrito = Session::get('carrito');
        $total = 0;

        foreach ($carrito as $item) {
            $total += $item->precio * $item->cantidad;
        }
        return $total;
    }

    public function guardarPedido()
    {
        $carrito = Session::get('carrito');
        if (count($carrito)) {
            //$now=new \DateTime();
            $now = now();
            $numero = $now->format('Ymd-His');
            foreach ($carrito as $producto) {
                $this->guardarItem($producto, $numero);
            }
            Session::forget('carrito');
        }
        return redirect()->route('productos.index')->with('mensaje','Pedido generado');
    }

    public function guardarItem($producto, $numero)
    {
        $productoguardado = Pedido::create([
            'numero' => $numero,
            'idproducto' => $producto->id,
            'cantidad' => $producto->cantidad,
            'precio' => $producto->precio
        ]);
    }
}
