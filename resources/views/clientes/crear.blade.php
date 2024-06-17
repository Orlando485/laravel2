<div class="container text-center">
    <h1>Crear Cliente</h1>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {!! Form::open(['route' => 'clientes.store']) !!}
    <div class="form-group">
        {!! Form::label('nombre', 'Nombre del Cliente') !!}
        {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre del Cliente...', 'required']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('rfc', 'RFC del Cliente') !!}
        {!! Form::text('rfc', null, ['class' => 'form-control', 'placeholder' => 'RFC del Cliente...']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('direccion', 'Dirección del Cliente') !!}
        {!! Form::text('direccion', null, ['class' => 'form-control', 'placeholder' => 'Dirección del Cliente...']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('telefono', 'Teléfono del Cliente') !!}
        {!! Form::text('telefono', null, ['class' => 'form-control', 'placeholder' => 'Teléfono del Cliente...', 'required']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('email', 'Email del Cliente') !!}
        {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email del Cliente...', 'required']) !!}
    </div>
    <button type="submit" class="btn btn-primary">Guardar Cliente</button>
    {!! Form::close() !!}
    <hr>
</div>
