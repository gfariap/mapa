@extends ('layouts.forms')

@section ('title')
    {{ $coluna->empreendimento->nome }} - {{ $coluna->titulo }}
@endsection

@section ('content')
    {!! Form::model($coluna, [ 'method' => 'PUT', 'files' => 'true', 'route' => [ 'empreendimentos.colunas.update', $coluna->empreendimento_id, $coluna->id ] ]) !!}
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <div class="panel panel-default panel-preview">
                    <div class="panel-heading">
                        <label for="logotipo">Foto da planta</label>
                    </div>
                    <div class="panel-body">
                        <img class="resize-img" src="{{ asset($coluna->planta_thumbnail) }}"/>
                    </div>
                </div>
                <br/>
                {!! Form::label('planta', 'Alterar foto') !!}
                {!! Form::file('planta', ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-sm-8">
            <div class="row">
                <div class="form-group col-sm-8">
                    {!! Form::label('titulo', 'Título da coluna') !!} <b class="texto-vermelho">*</b>
                    {!! Form::text('titulo', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group col-sm-4">
                    {!! Form::label('area', 'Área') !!} <b class="texto-vermelho">*</b>
                    {!! Form::text('area', null, ['class' => 'form-control', 'data-money']) !!}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-4">
                    {!! Form::label('quartos', 'Qtde de Quartos') !!} <b class="texto-vermelho">*</b>
                    {!! Form::number('quartos', null, ['class' => 'form-control', 'min' => '1', 'max' => '9']) !!}
                </div>
                <div class="form-group col-sm-4">
                    {!! Form::label('suites', 'Qtde de Suítes') !!} <b class="texto-vermelho">*</b>
                    {!! Form::number('suites', null, ['class' => 'form-control', 'min' => '0', 'max' => '9']) !!}
                </div>
                <div class="form-group col-sm-4">
                    {!! Form::label('garagem', 'Vagas de Garagem') !!} <b class="texto-vermelho">*</b>
                    {!! Form::number('garagem', null, ['class' => 'form-control', 'min' => '0', 'max' => '9']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('observacoes', 'Observações') !!}
                {!! Form::textarea('observacoes', null, ['class' => 'form-control', 'rows' => 6]) !!}
            </div>
        </div>
    </div>
    <div class="form-group actions">
        {!! Form::submit('Atualizar', [ 'class' => 'btn btn-success' ]) !!}
        {!! link_to_route('empreendimentos.edit', 'Voltar', [ $coluna->empreendimento_id ], [ 'class' => 'btn btn-default' ]) !!}
    </div>
    {!! Form::close() !!}
@endsection