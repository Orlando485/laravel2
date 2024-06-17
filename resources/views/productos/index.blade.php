@extends('master')
@section('titulo','Listado de productos')
@section('contenido')
<div class="container text-center">
    <h1>Listado de productos</h1>
    <hr>

    <table class="table table-success table-striped-columns mt-3">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Precio</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Agregar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <td>{{$producto->nombre}}</td>
                <td>{{$producto->precio}}</td>
                <td>{{$producto->cantidad}}</td>
                <td>
                    <a href="{{ route('carrito-agregar', $producto->id) }}">
                        <button type="button" class="btn btn-primary">
                            <i class="bi bi-cart4"></i>
                        </button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
</div>
@endsection