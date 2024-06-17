@extends('master')
@section('titulo','Listado de perfiles')
@section('contenido')

<div class="container text-center">
    <h1>Listado de perfiles</h1>
    {!! Form::open(['route'=>'perfiles.index', 'method'=>'GET', 'class'=>'form']) !!}
    <div class="form-group">
        {!! Form::text('nombre', null, ['class'=>'form-control', 'id'=>'nombre', 'placeholder'=>'Buscar Perfil']) !!}
        <br>
        {!! Form::submit('Buscar Perfil', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
    <br>
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearPerfilModal">
        Crear nuevo Perfil
    </button>

    <div class="modal fade" id="crearPerfilModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('perfiles.crear')
                </div>
            </div>
        </div>
    </div>

    <table class="table table-success table-striped-columns mt-3">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($perfiles as $perfil)
            <tr>
                <td>{{$perfil->id}}</td>
                <td>{{$perfil->nombre}}</td>
                <td>
                    <a class="btn btn-warning" href="{{ route('perfiles.edit', $perfil->id) }}">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                </td>
                <td>
                    {!! Form::open(['route' => ['perfiles.destroy', $perfil->id], 'method' => 'DELETE']) !!}
                    <button onclick="return confirm('¿Eliminar Perfil?')" class="btn btn-danger">
                        <i class="bi bi-trash3"></i>
                    </button>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$perfiles->links()}}
</div>
@endsection