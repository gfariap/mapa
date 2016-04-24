@extends('layouts.app')

@section('content')
  <div id="mapa-imoveis" empreendimentos='{!! str_replace("'", "\\u0027", json_encode($empreendimentos)) !!}'>
    <div id="map"></div>
    {{--<div class="search-box panel panel-body">--}}
      {{--<div class="closed">--}}
        {{--Mata da Praia - Vitória / ES<br>@{{ descricao_filtros }}--}}
      {{--</div>--}}
      {{--<div class="opened">--}}
        {{--<div class="form-group">--}}
          {{--<label for="bairro">Bairro</label>--}}
          {{--<select name="bairro" id="bairro" disabled="disabled" class="form-control">--}}
            {{--<option value="0">Mata da Praia</option>--}}
          {{--</select>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
          {{--<label for="quartos">Quantidade de quartos</label>--}}
          {{--<select name="quartos" id="quartos" v-model="quartos" class="form-control">--}}
            {{--<option value="">Selecione a quantidade de quartos</option>--}}
            {{--<option v-for="quarto in lista_quartos" v-bind:value="quarto.value">@{{ quarto.text }}</option>--}}
          {{--</select>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
          {{--<label for="area">Área privativa</label>--}}
          {{--<select name="area" id="area" v-model="area" class="form-control">--}}
            {{--<option value="">Selecione a área privativa</option>--}}
            {{--<option v-for="a in lista_areas" v-bind:value="a.value">@{{ a.text }}</option>--}}
          {{--</select>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
          {{--<label for="valor">Valor da oferta</label>--}}
          {{--<select name="valor" id="valor" class="form-control">--}}
            {{--<option value="">Selecione o valor da oferta</option>--}}
            {{--<option value="1">Menos que 1.000.000</option>--}}
            {{--<option value="2">Entre 1.000.000 e 2.000.000</option>--}}
            {{--<option value="3" selected>Entre 2.000.000 e 3.000.000</option>--}}
            {{--<option value="4">Mais que 3.000.000</option>--}}
          {{--</select>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
          {{--<button class="btn btn-primary pull-right" id="pesquisar">Pesquisar</button>--}}
          {{--<button class="btn btn-link pull-right">Limpar</button>--}}
        {{--</div>--}}
      {{--</div>--}}
    {{--</div>--}}
    <div class="offcanvas panel panel-body">
    </div>
  </div>
@endsection

@section('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAH5PTMGYtr1P7H4ydMJnmGXsvy5Q9RjLc"
    ></script>    
    <script type="text/javascript" src="https://google-maps-utility-library-v3.googlecode.com/svn/trunk/maplabel/src/maplabel-compiled.js"></script>
@endsection
