<div class="sidebar">
    <ul class="nav nav-sidebar">
        <li class="{{ $helpers->verificaRotaAtual('home') }}" title="Mapa">
            <a href="{{ route('home') }}">
                <i class="fa fa-map-o"></i>
            </a>
        </li>
        <li class="{{ $helpers->verificaRotaAtual('empreendimentos.*') }}">
            <a href="{{ route('empreendimentos.index') }}" title="Empreendimentos">
                <i class="fa fa-building-o"></i>
            </a>
        </li>
        <li class="{{ $helpers->verificaRotaAtual('anuncios.*') }}">
            <a href="{{ route('anuncios.index') }}" title="Anúncios">
                <i class="fa fa-map-marker"></i>
            </a>
        </li>
    </ul>
</div>