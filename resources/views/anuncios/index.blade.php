@extends ('layouts.forms')
@inject ('helpers', 'App\ViewServices\HelpersViewService')

@section ('title')
    Anúncios
    <div class="actions pull-right">
        {!! link_to_route('anuncios.create', 'Cadastrar anúncio', [], [ 'class' => 'btn btn-primary' ]) !!}
    </div>
@endsection

@section ('content')
    <h3 class="page-header">Filtros de busca</h3>
    <div class="search-filters">
        {!! Form::open(['route' => 'anuncios.index', 'method' => 'GET']) !!}
        <div class="row">
            <div class="col-sm-8 form-group">
                {!! Form::label('titulo', 'Título') !!}
                {!! Form::text('titulo', $searchTitulo, ['class' => 'form-control']) !!}
            </div>
            <div class="col-sm-4 form-group text-align-right">
                {!! Form::button('Limpar', ['class' => 'btn btn-default inline-button ajustar-sm', 'onclick' => 'window.open("'.route('anuncios.index').'", "_self")']) !!}
                {!! Form::submit('Filtrar', ['class' => 'btn btn-success inline-button ajustar-sm']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <h3 class="page-header">Resultados</h3>
    @if (count($anuncios) > 0)
        <table class="table table-hover table-responsive">
            <thead>
            <tr>
                <th>{!! $helpers->link_ordenar('anuncios.index', 'id', '#') !!}</th>
                <th>{!! $helpers->link_ordenar('anuncios.index', 'titulo', 'Anúncio') !!}</th>
                <th>{!! $helpers->link_ordenar('anuncios.index', 'finalidade', 'Finalidade') !!}</th>
                <th>{!! $helpers->link_ordenar('anuncios.index', 'valor', 'Valor') !!}</th>
                <th>{!! $helpers->link_ordenar('anuncios.index', 'quartos', 'Qtde de Quartos') !!}</th>
                <th>{!! $helpers->link_ordenar('anuncios.index', 'suites', 'Qtde de Suítes') !!}</th>
                <th>{!! $helpers->link_ordenar('anuncios.index', 'garagem', 'Vagas de Garagem') !!}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($anuncios as $anuncio)
                <tr>
                    <td>{{ $anuncio->id }}</td>
                    <td>{{ $anuncio->titulo }}</td>
                    <td>{{ \App\ValueObjects\FinalidadeAnuncio::get($anuncio->finalidade) }}</td>
                    <td>{{ $anuncio->valor }}</td>
                    <td>{{ $anuncio->quartos }}</td>
                    <td>{{ $anuncio->suites }}</td>
                    <td>{{ $anuncio->garagem }}</td>
                    <td class="actions min-width">
                        {!! link_to_route('anuncios.edit', 'Editar', [ $anuncio->id ], [ 'class' => 'btn btn-link btn-xs' ]) !!}
                        @include ('partials.confirm-delete', [ 'entity' => 'Anuncio'.$anuncio->id, 'model' => $anuncio, 'route' => 'anuncios.destroy', 'texto' => 'Excluir' ])
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <div class="well no-results"><p>Nenhum anúncio foi encontrado utilizando os filtros informados.</p></div>
    @endif
    @include ('partials.pagination', [ 'collection' => $anuncios ])
@endsection