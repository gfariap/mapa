<h3 class="page-header">Colunas</h3>
@if (count($colunas) > 0)
    <table class="table table-hover table-responsive">
        <thead>
        <tr>
            <th>Título</th>
            <th>Área</th>
            <th>Quartos</th>
            <th>Suítes</th>
            <th>Garagens</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($colunas as $coluna)
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
@else
    <div class="well no-results"><p>Nenhuma coluna foi cadastrada nesse empreendimento.</p></div>
@endif
<hr/>
<div class="actions form-group">
    {!! link_to_route('empreendimentos.colunas.create', 'Cadastrar coluna', [ $empreendimento->id ], [ 'class' => 'btn btn-primary' ]) !!}
</div>