@extends('master')
@section('titulo','Crear una factura')
@section('contenido')


<div class="container text-center">
    <h1>Crear factura</h1>
    @if(isset($errors) && $errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {!! Form::open(['route' => 'facturas.store', 'enctype' => 'multipart/form-data']) !!}

    <div class="form-group">
        {!!Form::number('numero',null,array(
        'class' => 'form-control',
        'required' => 'required',
        'placeholder' => 'Numero de la factura'
        ))
        !!}
    </div>

    <div class="form-group">
        {!!Form::number('valor',null,array(
        'class' => 'form-control',
        'required' => 'required',
        'placeholder' => 'Valor de la factura'
        ))
        !!}
    </div>


    <div class="form-group">
        {!!Form::textarea('detalles',null,array(
        'class' => 'form-control ckeditor',
        'placeholder' => 'Detalles de la factura'
        ))
        !!}
    </div>
    

    <div class="form-group">
        <label>Clientes</label>
        {!! Form::select('idCliente', $clientes, null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label>Forma de pago</label>
        {!! Form::select('idForma', $formas, null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label>Estados</label>
        {!! Form::select('idEstado', $estados, null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <input type="file" name="archivo" class="form-control">
    </div>
    {!! Form::submit('Guardar factura', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
    <hr>

</div>


@endsection