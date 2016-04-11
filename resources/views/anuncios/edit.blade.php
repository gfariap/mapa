@extends ('layouts.forms')

@section ('title')
    Editar Anúncio
@endsection

@section ('content')
    {!! Form::model($anuncio, [ 'route' => [ 'anuncios.update', $anuncio->id ] ]) !!}
        @include ('anuncios.partials.form', ['btnLabel' => 'Atualizar'])
    {!! Form::close() !!}
@endsection