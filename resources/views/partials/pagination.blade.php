@if (count($collection) > 0)
    <hr/>
    <div class="paginator">
        {!! $collection->appends(Request::except('page'))->render() !!}
        <div class="total pull-right">
            Exibindo {{ $collection->total() > $collection->perPage() ? $collection->perPage() : $collection->total() }} de {{ $collection->total() }} registros encontrados.
        </div>
    </div>
@endif