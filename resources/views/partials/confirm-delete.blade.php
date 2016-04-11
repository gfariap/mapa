{!! Form::model($model, [ 'id' => "form${entity}", 'method' => 'DELETE', 'route' => (isset($parent_id) ? [ $route, $parent_id, $model->id ] : [ $route, $model->id ]) ]) !!}
    <button type="button" class="btn btn-link btn-xs btn-excluir" onclick="e('{{ $entity }}')">{!! isset($texto) ? $texto : 'Excluir' !!}</button>
{!! Form::close() !!}