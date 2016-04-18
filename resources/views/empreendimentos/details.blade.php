<div class="row">
    <div class="col-sm-4 form-group">
        <img src="{{ asset($empreendimento->fachada_thumbnail) }}" alt="{{ $empreendimento->nome }}">
    </div>
    <div class="col-sm-8 no-padding-left">
        <div class="col-xs-12">
            <h3 class="offcanvas-header">{{ $empreendimento->nome }}</h3>
        </div>
        <div class="col-xs-12 form-group">
            <p class="form-control-static">Construído em {{ $empreendimento->construido_em }}</p>
            <p class="form-control-static">{{ $empreendimento->apartamentos_andar }} apartamentos por andar</p>
            <p class="form-control-static">{{ \App\ValueObjects\OpcaoLazer::getList($empreendimento->lazer) }}</p>
            @if ($empreendimento->marinha)
                <p class="form-control-static">Terreno de marinha</p>
            @endif
            @if (!empty($empreendimento->observacoes))
                <p class="form-control-static">{{ $empreendimento->observacoes }}</p>
            @endif
        </div>
    </div>
    @foreach ($empreendimento->colunas as $coluna)
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $coluna->titulo }}
                </div>
                <div class="panel-body">
                    <div class="text-align-center form-group">
                        <img src="{{ asset($coluna->planta_thumbnail) }}" alt="{{ $coluna->titulo }}">
                    </div>
                    <div class="form-group">
                        <p class="form-control-static">Área: {{ $coluna->area }} m²</p>
                        <p class="form-control-static">{{ $coluna->quartos }} quarto(s) | {{ $coluna->suites }} suíte(s) | {{ $coluna->garagem }} vaga(s)</p>
                        @if (!empty($coluna->observacoes))
                            <p class="form-control-static">{{ $coluna->observacoes }}</p>
                        @endif
                    </div>
                    @if ($coluna->anuncios()->count() > 0)
                        <div class="list-group">
                            @foreach ($coluna->anuncios as $anuncio)
                                <li class="list-group-item">
                                    <h5 class="list-group-item-heading">{{ $anuncio->titulo }}</h5>
                                    <p class="list-group-item-text">{{ \App\ValueObjects\FinalidadeAnuncio::get($anuncio->finalidade) }} | Valor: R$ {{ $anuncio->valor }}</p>
                                    @if ($coluna->quartos != $anuncio->quartos || $coluna->suites != $anuncio->suites || $coluna->garagem != $anuncio->garagem)
                                        <p class="list-group-item-text">{{ $anuncio->quartos }} quarto(s) | {{ $anuncio->suites }} suíte(s) | {{ $anuncio->garagem }} vaga(s)</p>
                                    @endif
                                    @if (!empty($anuncio->observacoes))
                                        <p class="list-group-item-text">{{ $anuncio->observacoes }}</p>
                                    @endif
                                </li>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
<button class="offcanvas-close btn btn-default" title="Fechar" data-close>
    <i class="fa fa-times"></i>
</button>