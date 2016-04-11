@inject ('colunas', 'App\ViewServices\ColunasViewService')

<div class="form-group">
    {!! Form::label('coluna_id', 'Empreendimento - Coluna') !!} <b class="texto-vermelho">*</b>
    {!! Form::select('coluna_id', $colunas->dropdownOptions(true), null, ['class' => 'form-control', 'data-dropdown', 'data-get-url' => route('empreendimentos.colunas.store', [ 'id' => '0' ])]) !!}
</div>
<div class="row">
    <div class="form-group col-md-9 col-sm-8">
        {!! Form::label('titulo', 'Título do anúncio') !!} <b class="texto-vermelho">*</b>
        {!! Form::text('titulo', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-md-3 col-sm-4">
        {!! Form::label('finalidade', 'Área') !!} <b class="texto-vermelho">*</b>
        {!! Form::select('finalidade', \App\ValueObjects\FinalidadeAnuncio::listForDropdown(), null, ['class' => 'form-control', 'data-dropdown']) !!}
    </div>
</div>
<div class="row">
    <div class="form-group col-md-3 col-sm-12">
        {!! Form::label('valor', 'Valor') !!} <b class="texto-vermelho">*</b>
        {!! Form::text('valor', null, ['class' => 'form-control', 'data-money']) !!}
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
        {!! Form::submit($btnLabel, [ 'class' => 'btn btn-success' ]) !!}
        {!! link_to_route('anuncios.index', 'Voltar', [], [ 'class' => 'btn btn-default' ]) !!}
    </div>
</div>