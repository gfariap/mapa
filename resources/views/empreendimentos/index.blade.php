@extends ('layouts.forms')
@inject ('helpers', 'App\ViewServices\HelpersViewService')

@section ('title', 'Empreendimentos')

@section ('content')
    <h3 class="page-header">Filtros de busca</h3>
    <div class="search-filters">
        {!! Form::open(['route' => 'empreendimentos.index', 'method' => 'GET']) !!}
        <div class="row">
            <div class="col-sm-8 form-group">
                {!! Form::label('nome', 'Nome') !!}
                {!! Form::text('nome', $searchName, ['class' => 'form-control']) !!}
            </div>
            <div class="col-sm-4 form-group text-align-right">
                {!! Form::button('Limpar', ['class' => 'btn btn-default inline-button ajustar-sm', 'onclick' => 'window.open("'.route('empreendimentos.index').'", "_self")']) !!}
                {!! Form::submit('Filtrar', ['class' => 'btn btn-success inline-button ajustar-sm']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <h3 class="page-header">Resultados</h3>
    @if (count($empreendimentos) > 0)
        <table class="table table-hover table-responsive">
            <thead>
            <tr>
                <th>{!! $helpers->link_ordenar('empreendimentos.index', 'id', '#') !!}</th>
                <th>{!! $helpers->link_ordenar('empreendimentos.index', 'nome', 'Nome') !!}</th>
                <th>{!! $helpers->link_ordenar('empreendimentos.index', 'apartamentos_andar', 'Aptos/Andar') !!}</th>
                <th>{!! $helpers->link_ordenar('empreendimentos.index', 'construido_em', 'Construído em') !!}</th>
                <th>{!! $helpers->link_ordenar('empreendimentos.index', 'marinha', 'Terreno de Marinha') !!}</th>
                <th>{!! $helpers->link_ordenar('empreendimentos.index', 'lazer', 'Opções de Lazer') !!}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($empreendimentos as $empreendimento)
                <tr>
                    <td>{{ $empreendimento->id }}</td>
                    <td>{{ $empreendimento->nome }}</td>
                    <td>{{ $empreendimento->apartamentos_andar }}</td>
                    <td>{{ $empreendimento->construido_em }}</td>
                    <td>{{ $empreendimento->marinha ? 'Sim' : 'Não' }}</td>
                    <td>{{ \App\ValueObjects\OpcaoLazer::getList($empreendimento->lazer) }}</td>
                    <td class="actions min-width">
                        {!! link_to_route('empreendimentos.edit', 'Editar', [ $empreendimento->id ], [ 'class' => 'btn btn-link btn-xs' ]) !!}
                        @include ('partials.confirm-delete', [ 'entity' => 'Empreendimento'.$empreendimento->id, 'model' => $empreendimento, 'route' => 'empreendimentos.destroy', 'texto' => 'Excluir' ])
                    </td>
                </tr>
                @if ($empreendimento->colunas()->count() > 0)
                    <tr>
                        <td colspan="7">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Coluna</th>
                                    <th>Área</th>
                                    <th>Quartos</th>
                                    <th>Suítes</th>
                                    <th>Garagens</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($empreendimento->colunas as $coluna)
                                    <tr>
                                        <td>{{ $coluna->titulo }}</td>
                                        <td>{{ $coluna->area }}</td>
                                        <td>{{ $coluna->quartos }}</td>
                                        <td>{{ $coluna->suites }}</td>
                                        <td>{{ $coluna->garagem }}</td>
                                        <td class="actions min-width">
                                            {!! link_to_route('empreendimentos.colunas.edit', 'Editar', [ 'coluna_id' => $coluna->id, 'id' => $empreendimento->id ], [ 'class' => 'btn btn-link btn-xs' ]) !!}
                                            @include ('partials.confirm-delete', [ 'entity' => 'Coluna'.$coluna->id, 'parent_id' => $empreendimento->id, 'model' => $coluna, 'route' => 'empreendimentos.colunas.destroy', 'texto' => 'Excluir' ])
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    @else
        <div class="well no-results"><p>Nenhum empreendimento foi encontrado utilizando os filtros informados.</p></div>
    @endif
    @include ('partials.pagination', [ 'collection' => $empreendimentos ])
    <hr/>
    <div class="actions form-group">
        {!! link_to_route('empreendimentos.create', 'Cadastrar empreendimento', [], [ 'class' => 'btn btn-primary' ]) !!}
    </div>
@endsection