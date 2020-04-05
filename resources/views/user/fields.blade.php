{!! Form::hidden('id', isset($user) ? $user->id : 0) !!}
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Nome:') !!}
    {!! Form::text('name', isset($user) ? $user->name : '', ['class' => 'form-control bg-dark text-white', 'required']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', isset($user) ? $user->email : '', ['class' => 'form-control bg-dark text-white', 'required']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('password', 'Senha:') !!}
    {!! Form::password('password', ['class' => 'form-control bg-dark text-white', (isset($user) ? null : 'required')]) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::checkbox('active', '1', isset($user) ? $user->active : true) !!}
    {!! Form::label('active', 'Ativo') !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::checkbox('admin', '1', isset($user) ? $user->admin : false) !!}
    {!! Form::label('admin', 'Administrador') !!}
</div>

<div class="form-group col-sm-12 mt-2">
    {!! Form::submit('salvar', ['class' => 'btn btn-secondary']) !!}
</div>
