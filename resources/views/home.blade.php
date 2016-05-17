@extends('layouts.app')

@section('content')
    <div id="mapa-imoveis" empreendimentos='{!! str_replace("'", "\\u0027", json_encode($empreendimentos)) !!}'>
        <div id="map"></div>
        <div class="search-box hidden panel panel-body" v-bind:class="{'simples':simples,'avancado':avancado}">
            <div class="closed" v-if="!simples" v-on:click="limpar()">
                Mata da Praia - Vitória / ES<br/>
                @{{ (quartos > 0 ? quartos+" quarto"+(quartos > 1 ? "s - ":" - ") : "") }}
                @{{ area_menor }} a @{{ area_maior }} m²<br/>
                @{{ valor_menor | currency 'R$ ' | separator }} a @{{ valor_maior | currency | separator }}
            </div>
            <div class="opened" v-if="simples">
                <div class="form-group">
                    <label for="bairro">Bairro</label>
                    <select name="bairro" id="bairro" disabled="disabled" class="form-control">
                        <option value="0">Mata da Praia</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="quartos">Quantidade de quartos</label>
                    <select name="quartos" id="quartos" v-model="quartos" class="form-control">
                        <option v-for="quarto in lista_quartos" v-bind:value="quarto.value">@{{ quarto.text }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="area">Área privativa</label>
                    <div class="input-group">
                        <input type="text" class="form-control" v-model="area_menor">
                        <span class="input-group-addon">a</span>
                        <input type="text" class="form-control" v-model="area_maior">
                        <span class="input-group-addon">m²</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="valor">Valor da oferta</label>
                    <div class="input-group">
                        <span class="input-group-addon">R$</span>
                        <input type="text" class="form-control" v-model="valor_menor">
                        <span class="input-group-addon">a</span>
                        <input type="text" class="form-control" v-model="valor_maior">
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary pull-right" v-on:click="pesquisar()">Pesquisar</button>
                    <button class="btn btn-link pull-right" v-on:click="limpar()">Limpar</button>
                </div>
            </div>
            <div class="opened" v-if="avancado">
                <div class="form-group">
                    <label for="suites">Quantidade de suítes</label>
                    <select name="suites" id="suites" v-model="suites" class="form-control">
                        <option v-for="suite in lista_suites" v-bind:value="suite.value">@{{ suite.text }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="vagas">Vagas de garagem</label>
                    <select name="vagas" id="vagas" v-model="vagas" class="form-control">
                        <option v-for="vaga in lista_vagas" v-bind:value="vaga.value">@{{ vaga.text }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="aptos_andar">Apartamentos por andar</label>
                    <select name="aptos_andar" id="aptos_andar" v-model="aptos_andar" class="form-control">
                        <option v-for="apto in lista_aptos_andar" v-bind:value="apto.value">@{{ apto.text }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="idade">Idade do projeto</label>
                    <select name="idade" id="idade" v-model="idade" class="form-control">
                        <option v-for="ida in lista_idades_projeto" v-bind:value="ida.value">@{{ ida.text }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="finalidade">Finalidade</label>
                    <select name="finalidade" id="finalidade" v-model="finalidade" class="form-control">
                        <option v-for="fina in lista_finalidades" v-bind:value="fina.value">@{{ fina.text }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary pull-right" v-on:click="pesquisar()">Pesquisar</button>
                    <button class="btn btn-link pull-right" v-on:click="limpar()">Limpar</button>
                </div>
            </div>
        </div>
        <div class="offcanvas panel panel-body">
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAH5PTMGYtr1P7H4ydMJnmGXsvy5Q9RjLc"
    ></script>
    <script src="{{ asset('js/maplabel.js') }}"></script>
@endsection
