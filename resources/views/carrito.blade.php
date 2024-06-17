@extends('master')
@section('titulo','Carrito')
@section('contenido')
<div class="container text-center">
    <h1>Carrito de items</h1>
    <p>
        <a href="{{ route('carrito-vaciar') }}" class="btn btn-danger" onclick="return confirm('¿Vaciar Carrito?')">Vaciar Carrito</a>
    </p>

    <hr>
    <table class="table table-success table-striped-columns mt-3">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Precio</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Total</th>
                <th scope="col">Borrar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carrito as $item)
            <tr>
                <td>{{$item->nombre}}</td>
                <td>${{number_format($item->precio,0)}}</td>
                <td>
                    <input type="number" min="1" max="50" value="{{ $item->cantidad }}" id="producto_{{ $item->id }}">
                    <a href="#" class="btn btn-warning btn-update-item" data-href="{{ route('carrito-actualizar', $item->id) }}" data-id="{{ $item->id }}">
                        <i class="bi bi-arrow-clockwise"></i>
                    </a>
                </td>
                <td>{{ $item->precio * $item->cantidad }}</td>
                <td>
                    <a href="{{ route('carrito-borrar', $item->id) }}">
                        <button type="button" class="btn btn-danger">
                            <i class="bi bi-trash3-fill"></i>
                        </button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h3>
        <span class="badge badge-success">${{ number_format($total) }}</span>
    </h3>

    <hr>
    <p>
        <a class="btn btn-info" href="{{ route('productos.index') }}"> <i class="bi bi-caret-left-fill"></i> Seguir agregando</a>
        @if(count($carrito))
        <a class="btn btn-success" href="{{ route('ordenar') }}">Ordenar <i class="bi bi-caret-right-fill"></i></a>
        @endif
    </p>
    
</div>
@endsection