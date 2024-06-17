@extends('master')
@section('titulo', 'Listado de facturas')
@section('contenido')

<div class="container text-center">
    <h1>Listado de facturas</h1>
    {!! Form::open(['route'=>'facturas.index', 'method'=>'GET', 'class'=>'form']) !!}
    <div class="form-group">
        {!! Form::text('numero', null, ['class'=>'form-control', 'id'=>'numero', 'placeholder'=>'Buscar Factura']) !!}
        <br>
        {!! Form::submit('Buscar Factura', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
    <!--Fin Formulario de Búsqueda-->
    <br>
    <a class="btn btn-success" href="{{ route('facturas.create') }}"> Crear nueva factura</a>
    <hr>
    <table class="table table-success table-striped-columns mt-3">
        <thead>
            <tr>
                <th scope="col">Número</th>
                <th scope="col">Valor</th>
                <th scope="col">Detalles</th>
                <th scope="col">Cliente</th>
                <th scope="col">Forma de Pago</th>
                <th scope="col">Estado</th>
                <th scope="col">Archivo</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($facturas as $factura)
            <tr>
                <td>{{ $factura->numero }}</td>
                <td>{{ $factura->valor }}</td>
                <td>{!! html_entity_decode($factura->detalles) !!}</td>
                <td>{{ $factura->cliente->nombre}}</td>
                <td>{{ $factura->forma->nombre}}</td>
                <td>{{ $factura->estado->nombre}}</td>
                <td><img src="{{asset('archivos/'.$factura->archivo) }}" class="factura-imagen" alt="archivo"></td>
                <td>
                    <a class="btn btn-warning" href="{{ route('facturas.edit', $factura->id) }}">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                </td>
                <td>
                {!! Form::open(['route' => ['facturas.destroy', $factura->id], 'method' => 'DELETE']) !!}
                <button onclick="return confirm('¿Eliminar factura?')" class="btn btn-danger">
                    <i class="bi bi-trash3"></i>
                </button>
                {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$facturas->links()}}
</div>
@endsection