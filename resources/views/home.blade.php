@extends('layouts.app')

@section('content')
    <div id="map"></div>
    <div class="search-box panel panel-body">
      <div class="closed">
        Mata da Praia - Vitória / ES<br>4 quartos - Entre 200 e 300m² - Entre 2.000.000 e 3.000.000
      </div>
      <div class="opened">
        <div class="form-group">
          <label for="bairro">Bairro</label>
          <select name="bairro" id="bairro" disabled="disabled" class="form-control">
            <option value="0">Mata da Praia</option>
          </select>
        </div>
        <div class="form-group">
          <label for="quartos">Quantidade de quartos</label>
          <select name="quartos" id="quartos" class="form-control">
            <option value="">Selecione a quantidade de quartos</option>
            <option value="2">2 quartos</option>
            <option value="3">3 quartos</option>
            <option value="4" selected>4 quartos</option>
          </select>
        </div>
        <div class="form-group">
          <label for="area">Área privativa</label>
          <select name="area" id="area" class="form-control">
            <option value="">Selecione a área privativa</option>
            <option value="1">Menos que 100m²</option>
            <option value="2">Entre 100m² e 200m²</option>
            <option value="3" selected>Entre 200m² e 300m²</option>
            <option value="4">Mais que 300m²</option>
          </select>
        </div>
        <div class="form-group">
          <label for="valor">Valor da oferta</label>
          <select name="valor" id="valor" class="form-control">
            <option value="">Selecione o valor da oferta</option>
            <option value="1">Menos que 1.000.000</option>
            <option value="2">Entre 1.000.000 e 2.000.000</option>
            <option value="3" selected>Entre 2.000.000 e 3.000.000</option>
            <option value="4">Mais que 3.000.000</option>
          </select>
        </div>
        <div class="form-group">
          <button class="btn btn-primary pull-right" id="pesquisar">Pesquisar</button>
          <button class="btn btn-link pull-right">Limpar</button>
        </div>
      </div>
    </div>
    <div class="offcanvas panel panel-body">
      <div class="row">
        <div class="col-xs-12 form-group">
          <img src="{{ asset('img/coluna1.jpg') }}" alt="Condomínio Paradise Island - 101">
        </div>
        <div class="col-xs-12 form-group">
          <label for="anuncio">Apartamento anunciado</label>
          <p class="form-control-static">Condomínio Paradise Island - 101</p>
        </div>
        <div class="col-xs-12 form-group">
          <label for="garagem">Vagas de garagem</label>
          <p class="form-control-static">3</p>
        </div>
        <div class="col-xs-12 form-group">
          <label for="lazer">Área de lazer</label>
          <p class="form-control-static">Salão de Festas, Piscina, Churrasqueira, Área Fitness, Espaço Gourmet</p>
        </div>
        <div class="col-xs-12 form-group">
          <label for="marinha">Terreno de marinha</label>
          <p class="form-control-static">Não</p>
        </div>
        <div class="col-xs-12 form-group">
          <label for="preco">Preço</label>
          <p class="form-control-static">R$ 2.500.000,00</p>
        </div>
        <div class="col-xs-12 form-group">
          <label for="observacoes">Observações</label>
          <p class="form-control-static">-</p>
        </div>
      </div>
    </div>
@endsection

@section('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAH5PTMGYtr1P7H4ydMJnmGXsvy5Q9RjLc"
    ></script>    
    <script type="text/javascript" src="https://google-maps-utility-library-v3.googlecode.com/svn/trunk/maplabel/src/maplabel-compiled.js"></script>
    <script>
      var map;
      $(document).ready(function() {
        $(".closed, #pesquisar").click(function() {
          $('.search-box').toggleClass('open');
        });

        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -20.2751185, lng: -40.29226860000001},
          zoom: 16,
          mapTypeId: google.maps.MapTypeId.SATELLITE,
          tilt: 45,
          disableDefaultUI: true
        });
        
        // Define the LatLng coordinates for the polygon.
          var coords = [
            new google.maps.LatLng(-20.273999, -40.300703),
            new google.maps.LatLng(-20.274977, -40.300737),
            new google.maps.LatLng(-20.277648, -40.301119),
            new google.maps.LatLng(-20.277834, -40.299690),
            new google.maps.LatLng(-20.278150, -40.299751),
            new google.maps.LatLng(-20.278398, -40.297780),
            new google.maps.LatLng(-20.279701, -40.297975),
            new google.maps.LatLng(-20.279970, -40.296017),
            new google.maps.LatLng(-20.278997, -40.294651),
            new google.maps.LatLng(-20.280074, -40.292497),
            new google.maps.LatLng(-20.279479, -40.292064),
            new google.maps.LatLng(-20.278255, -40.290634),
            new google.maps.LatLng(-20.280564, -40.288435),
            new google.maps.LatLng(-20.280787, -40.288363),
            new google.maps.LatLng(-20.281626, -40.287482),
            new google.maps.LatLng(-20.280845, -40.286991),
            new google.maps.LatLng(-20.278646, -40.284878),
            new google.maps.LatLng(-20.278031, -40.284239),
            new google.maps.LatLng(-20.276124, -40.281854),
            new google.maps.LatLng(-20.275491, -40.280940),
            new google.maps.LatLng(-20.274517, -40.282242),
            new google.maps.LatLng(-20.273604, -40.283951),
            new google.maps.LatLng(-20.271650, -40.287262),
            new google.maps.LatLng(-20.273260, -40.295284),
            new google.maps.LatLng(-20.273640, -40.296021),
            new google.maps.LatLng(-20.272931, -40.296192),
            new google.maps.LatLng(-20.272895, -40.296793),
            new google.maps.LatLng(-20.272932, -40.297546),
            new google.maps.LatLng(-20.273137, -40.297501),
            new google.maps.LatLng(-20.273428, -40.298795),
            new google.maps.LatLng(-20.273734, -40.299313),
            new google.maps.LatLng(-20.273999, -40.300703)];

          // Construct the polygon.
          var polygon = new google.maps.Polygon({
            paths: coords,
            clickable: false,
            strokeColor: '#FF0000',
            strokeOpacity: 0.5,
            strokeWeight: 3,
            fillColor: '#FF0000',
            fillOpacity: 0.25
          });

          polygon.setMap(map);

          var polygonLabel = new MapLabel({
            text: 'Mata da Praia',
            position: new google.maps.LatLng(-20.2751185, -40.29226860000001),
            map: map,
            fontSize: 14,
            align: 'center'
          });

          var markerCoord = new google.maps.LatLng(-20.2802534, -40.2884154);

          var marker = new google.maps.Marker({
            position: markerCoord,
            title: 'Condomínio Paradise Island'
          });

          var contentString = '<div class="col-xs-6 image-container">'+
            '<img src="{{ asset('img/fachada.jpg') }}" alt="Condomínio Paradise Island" />'+
            '</div>'+
            '<div class="col-xs-6">'+
            '<h3>Condomínio Paradise Island</h3>'+
            '<p class="form-control-static">Quantidade de Quartos e Suítes: 4q/4s</p>'+
            '<p class="form-control-static">Área Privativa: Col 1 - 229,24m² / Col 2 - 227,87m²</p>'+
            '<p class="form-control-static">Apartamentos por andar: 2</p>'+
            '<p class="form-control-static">Idade do Projeto: 1996</p>'+
            '<h4>Anúncios</h4>'+
            '<div class="list-group">'+
            '<a href="#" class="list-group-item">Apartamento 101</a>'+
            '<a href="#" class="list-group-item">Apartamento 102</a>'+
            '</div>'+
            '</div>';

          var infowindow = new google.maps.InfoWindow({
            content: contentString
          });

          google.maps.event.addListener(map, "zoom_changed", function() {
            if (map.getZoom() > 17) {
                marker.setMap(map); 
                polygonLabel.setMap(null);
            } else {
                marker.setMap(null);
                polygonLabel.setMap(map);
            }
          });

          map.addListener('click', function() {
            infowindow.close();
            $('body').removeClass('offcanvas-open');
          });

          marker.addListener('click', function() {
            infowindow.open(map, marker);
          });

          $('body').on('click', '.list-group-item', function() {
            $('body').addClass('offcanvas-open');
            map.setCenter(new google.maps.LatLng(markerCoord.lat() + 0.002, markerCoord.lng() + 0.001));
          });
      });
    </script>
@endsection
