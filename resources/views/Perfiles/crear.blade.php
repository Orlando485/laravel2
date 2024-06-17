<div class="container text-center">
    <h1>Crear perfil</h1>
    @if($errors->any())
    <div>
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    {!! Form::open(['route'=>'perfiles.store']) !!}
    <div class="form-group">
        {!! Form::label('nombre', 'Nombre del Perfil') !!}
        {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre del perfil...', 'required']) !!}
    </div>
    {!! Form::submit('Guardar Perfil', array('class' => 'btn btn-primary')) !!}
    {!! Form::close() !!}
    <hr>
</div>
