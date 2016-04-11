@extends ('layouts.forms')

@section ('title')
    {{ $empreendimento->nome }}
@endsection

@section ('content')
    {!! Form::model($empreendimento, [ 'method' => 'PUT', 'files' => 'true', 'route' => [ 'empreendimentos.update', $empreendimento->id ] ]) !!}
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <div class="panel panel-default panel-preview">
                    <div class="panel-heading">
                        <label for="logotipo">Foto da fachada</label>
                    </div>
                    <div class="panel-body">
                        <img class="resize-img" src="{{ asset($empreendimento->fachada_thumbnail) }}"/>
                    </div>
                </div>
                <br/>
                {!! Form::label('fachada', 'Alterar foto') !!}
                {!! Form::file('fachada', ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-sm-8">
            <div class="row">
                <div class="form-group col-sm-8">
                    {!! Form::label('nome', 'Nome do Empreendimento') !!} <b class="texto-vermelho">*</b>
                    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group col-sm-4">
                    {!! Form::label('apartamentos_andar', 'Aptos/andar') !!} <b class="texto-vermelho">*</b>
                    {!! Form::number('apartamentos_andar', null, ['class' => 'form-control', 'min' => '1', 'max' => '20']) !!}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    {!! Form::label('latitude', 'Latitude') !!} <b class="texto-vermelho">*</b>
                    {!! Form::text('latitude', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group col-sm-6">
                    {!! Form::label('longitude', 'Longitude') !!} <b class="texto-vermelho">*</b>
                    {!! Form::text('longitude', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    {!! Form::label('construido_em', 'Construído em (ano)') !!}
                    {!! Form::text('construido_em', null, ['class' => 'form-control', 'data-year']) !!}
                </div>
                <div class="form-group col-sm-6">
                    {!! Form::label('marinha', 'Terreno de marinha?') !!}
                    {!! Form::select('marinha', [ '1' => 'Sim', '0' => 'Não' ], '0', ['class' => 'form-control', 'data-dropdown']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('lista_lazer[]', 'Opções de lazer') !!}
                {!! Form::select('lista_lazer[]', \App\ValueObjects\OpcaoLazer::listForDropdown(), null, ['class' => 'form-control', 'data-dropdown', 'multiple']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('observacoes', 'Observações') !!}
                {!! Form::textarea('observacoes', null, ['class' => 'form-control', 'rows' => 6]) !!}
            </div>
        </div>
    </div>
    <div class="form-group actions">
        {!! Form::submit('Atualizar', [ 'class' => 'btn btn-success' ]) !!}
        {!! link_to_route('empreendimentos.index', 'Voltar', [], [ 'class' => 'btn btn-default' ]) !!}
    </div>
    {!! Form::close() !!}
    @include ('colunas.index', [ 'colunas' => $empreendimento->colunas ])
@endsection