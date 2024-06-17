@extends('master')
@section('titulo','Listado de clientes')
@section('contenido')
<div class="container text-center">
    <h1>Listado de Clientes</h1>

    {!! Form::open(['route'=>'clientes.index','method'=>'GET','class'=>'form']) !!}
    <div class="form-group">
        {!! Form::text('nombre', null, ['class'=>'form-control', 'id'=>'nombre', 'placeholder'=>'Buscar cliente']) !!}
        {!! Form::submit('Buscar Cliente', ['class'=> 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}

    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearClienteModal">
        Crear nuevo Cliente
    </button>

    <table class="table table-success table-striped-columns mt-3">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">RFC</th>
                <th scope="col">Telefono</th>
                <th scope="col">Email</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
            <tr>
                <td>{{$cliente->nombre}}</td>
                <td>{{$cliente->rfc}}</td>
                <td>{{$cliente->telefono}}</td>
                <td>{{$cliente->email}}</td>
                <td>
                    <a class="btn btn-warning" href="{{ route('clientes.edit', $cliente->id) }}">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                </td>
                <td>
                    {!! Form::open(['route' => ['clientes.destroy', $cliente->id,]]) !!}
                    <input type="hidden" name="_method" value="DELETE">
                    <button onclick="return confirm('¿Eliminar cliente?')" class="btn btn-danger">
                        <i class="bi bi-trash3"></i>
                    </button>
                    {!! Form::close() !!}
                </td>

            </tr>

            @endforeach
        </tbody>
    </table>
    {{$clientes->links()}}


    <div class="modal fade" id="crearClienteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('clientes.crear')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection