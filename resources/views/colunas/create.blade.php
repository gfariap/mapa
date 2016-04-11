@extends ('layouts.forms')

@section ('title')
    Cadastrar Coluna
@endsection

@section ('content')
    {!! Form::open([ 'route' => [ 'empreendimentos.colunas.store', $empreendimento_id ], 'files' => 'true' ]) !!}
    <div class="row">
        <div class="form-group col-md-9 col-sm-8">
            {!! Form::label('titulo', 'Título da coluna') !!} <b class="texto-vermelho">*</b>
            {!! Form::text('titulo', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-3 col-sm-4">
            {!! Form::label('area', 'Área') !!} <b class="texto-vermelho">*</b>
            {!! Form::text('area', null, ['class' => 'form-control', 'data-money']) !!}
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-3 col-sm-12">
            {!! Form::label('planta', 'Foto da planta') !!} <b class="texto-vermelho">*</b>
            {!! Form::file('planta', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-3 col-sm-4">
            {!! Form::label('quartos', 'Qtde de Quartos') !!} <b class="texto-vermelho">*</b>
            {!! Form::number('quartos', null, ['class' => 'form-control', 'min' => '1', 'max' => '9']) !!}
        </div>
        <div class="form-group col-md-3 col-sm-4">
            {!! Form::label('suites', 'Qtde de Suítes') !!} <b class="texto-vermelho">*</b>
            {!! Form::number('suites', null, ['class' => 'form-control', 'min' => '0', 'max' => '9']) !!}
        </div>
        <div class="form-group col-md-3 col-sm-4">
            {!! Form::label('garagem', 'Vagas de Garagem') !!} <b class="texto-vermelho">*</b>
            {!! Form::number('garagem', null, ['class' => 'form-control', 'min' => '0', 'max' => '9']) !!}
        </div>
    </div>
    <div class="row">
        <div class="form-group col-xs-12">
            {!! Form::label('observacoes', 'Observações') !!}
            {!! Form::textarea('observacoes', null, ['class' => 'form-control', 'rows' => 4]) !!}
        </div>
        <div class="form-group actions col-xs-12">
            {!! Form::submit('Cadastrar', [ 'class' => 'btn btn-success' ]) !!}
            {!! link_to_route('empreendimentos.edit', 'Voltar', [ $empreendimento_id ], [ 'class' => 'btn btn-default' ]) !!}
        </div>
    </div>
    {!! Form::close() !!}
@endsection