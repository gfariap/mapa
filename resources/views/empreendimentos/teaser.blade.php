<div class="row">
    <div class="col-xs-3 image-container">
        <img src="{{ asset($empreendimento->fachada_thumbnail) }}" alt="{{ $empreendimento->nome }}" />
    </div>
    <div class="col-xs-9">
        <h4>{{ $empreendimento->nome }}</h4>
        <p class="form-control-static">Apartamentos por andar: {{ $empreendimento->apartamentos_andar }}</p>
        <p class="form-control-static">Data do projeto: {{ $empreendimento->construido_em }}</p>
        <p class="form-control-static">Opções de lazer: {{ \App\ValueObjects\OpcaoLazer::getList($empreendimento->lazer) }}</p>
    </div>
</div>
<a href="#" data-remote="{{ route('empreendimentos.show', [ $empreendimento->id, 'full' => 'S' ]) }}" class="btn btn-link btn-details">Ver Detalhes</a>