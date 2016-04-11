@extends ('layouts.forms')

@section ('title')
    Cadastrar Empreendimento
@endsection

@section ('content')
    {!! Form::open([ 'route' => 'empreendimentos.store', 'files' => 'true' ]) !!}
    <div class="row">
        <div class="form-group col-md-9 col-sm-8">
            {!! Form::label('nome', 'Nome do Empreendimento') !!} <b class="texto-vermelho">*</b>
            {!! Form::text('nome', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-3 col-sm-4">
            {!! Form::label('apartamentos_andar', 'Aptos/andar') !!} <b class="texto-vermelho">*</b>
            {!! Form::number('apartamentos_andar', null, ['class' => 'form-control', 'min' => '1', 'max' => '20']) !!}
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6 col-sm-4">
            {!! Form::label('fachada', 'Foto da fachada') !!} <b class="texto-vermelho">*</b>
            {!! Form::file('fachada', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-3 col-sm-4">
            {!! Form::label('latitude', 'Latitude') !!} <b class="texto-vermelho">*</b>
            {!! Form::text('latitude', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-3 col-sm-4">
            {!! Form::label('longitude', 'Longitude') !!} <b class="texto-vermelho">*</b>
            {!! Form::text('longitude', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6 col-sm-4">
            {!! Form::label('lista_lazer[]', 'Opções de lazer') !!}
            {!! Form::select('lista_lazer[]', \App\ValueObjects\OpcaoLazer::listForDropdown(), null, ['class' => 'form-control', 'data-dropdown', 'multiple']) !!}
        </div>
        <div class="form-group col-md-3 col-sm-4">
            {!! Form::label('construido_em', 'Construído em (ano)') !!}
            {!! Form::text('construido_em', null, ['class' => 'form-control', 'data-year']) !!}
        </div>
        <div class="form-group col-md-3 col-sm-4">
            {!! Form::label('marinha', 'Terreno de marinha?') !!}
            {!! Form::select('marinha', [ '1' => 'Sim', '0' => 'Não' ], '0', ['class' => 'form-control', 'data-dropdown']) !!}
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-12">
            {!! Form::label('observacoes', 'Observações') !!}
            {!! Form::textarea('observacoes', null, ['class' => 'form-control', 'rows' => 4]) !!}
        </div>
        <div class="form-group actions col-xs-12">
            {!! Form::submit('Cadastrar', [ 'class' => 'btn btn-success' ]) !!}
            {!! link_to_route('empreendimentos.index', 'Voltar', [], [ 'class' => 'btn btn-default' ]) !!}
        </div>
    </div>
    {!! Form::close() !!}
@endsection