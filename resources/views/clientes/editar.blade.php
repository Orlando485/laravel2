@extends('master')
@section('titulo','Editar un cliente')

@section ('contenido')
<div class="container text-center">
    <h1> Editar Cliente</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <u1>
            @foreach($errors->all() as $error)
            <li> {{$error }}</li>
            @endforeach
        </u1>
    </div>
    @endif

    {!!Form::model($cliente, ['route'=>['clientes.update',$cliente->id],'method'=>'PUT'])!!}
    <div class="form-group">
        {!! Form::text('nombre',null,array(
        'class'=>'form-control',
        'required'=>'required',
        'placeholder'=>'Nombre del Cliente...'
        ))
        !!}
    </div>
    <div class="form-group">
        {!!Form::text('rfc',null,array(
        'class'=>'form-control',
        'placeholder'=>'rfc del cliente'
        ))!!}
    </div>
    <div class="form-group">
        {!!Form::text('direccion',null,array(
        'class'=>'form-control',
        'placeholder'=>'Direccion del cliente...'
        ))!!}
    </div>

    <div class="form-group">
        {!!Form::text('telefono',null,array(
        'class'=>'form-control',
        'required'=>'required',
        'placeholder'=>'Telefono del cliente...'
        ))!!}
    </div>

    <div class="form-group">
        {!!Form::text('email',null,array(
        'class'=>'form-control',
        'required'=>'required',
        'placeholder'=>'email del cliente...'
        ))!!}
    </div>
    {!!Form::submit('Guardar cliente',array('class'=>'btn btn-primary'))!!}
    {!!Form::close()!!}
    <hr>
</div>
@endsection