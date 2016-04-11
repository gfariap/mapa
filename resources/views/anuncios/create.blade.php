@extends ('layouts.forms')

@section ('title')
    Cadastrar Anúncio
@endsection

@section ('content')
    {!! Form::open([ 'route' => 'anuncios.store' ]) !!}
        @include ('anuncios.partials.form', ['btnLabel' => 'Cadastrar'])
    {!! Form::close() !!}
@endsection