function e(nome, tipo) {
    swal({
        title: "Atenção",
        text: "Essa ação não pode ser desfeita!\nTem certeza que deseja prosseguir?",
        type: "warning",
        customClass: (tipo == "atualizacao" ? "confirma-atualizacao" : "confirma-exclusao"),
        showCancelButton: true,
        confirmButtonText: "Sim, tenho certeza!",
        cancelButtonText: "Não",
        showLoaderOnConfirm: true,
        closeOnConfirm: false
    }, function () {
        $('#form' + nome).submit();
    });
}

$(document).ready(function () {

    // incluindo select2 em todos os selects que possuírem data-dropdown
    $('select[data-dropdown]').select2({
        language: "pt-BR",
        theme: "bootstrap"
    }).change();

    // incluindo máscara de ano em todos os inputs que possuírem data-year
    $('input[data-year]').inputmask({
        mask: '9999',
        greedy: false,
        onincomplete: function () {
            $(this).val('');
        },
        oncomplete: function () {
            if (!moment($(this).val(), "YYYY").isValid()) {
                $(this).val('');
            }
        }
    });

    // incluindo máscara monetária em todos os inputs que possuírem data-money
    $('input[data-money]').maskMoney({
        thousands: ''
    });

    $('[data-get-url]').change(function() {
        var coluna_id = $(this).val();
        var url = $(this).data('get-url');
        if (coluna_id != '') {
            $.get(url + '/' + coluna_id, function(data) {
                $('#quartos').val(data.quartos);
                $('#suites').val(data.suites);
                $('#garagem').val(data.garagem);
            });
        }
    });

    $('body').on('click', '[data-remote]', function (e) {
        e.stopPropagation();
        $.get($(this).data('remote'), function (data) {
            $('.offcanvas').html(data);
            $('body').addClass('offcanvas-open');
            google.maps.event.trigger(window.mapaImoveis.map, "resize");
            window.mapaImoveis.map.setCenter(window.mapaImoveis.currentMarker.getPosition());
        });
    });

    $('body').on('click', '[data-close]', function (e) {
        e.stopPropagation();
        $('body').removeClass('offcanvas-open');
        google.maps.event.trigger(window.mapaImoveis.map, "resize");
        $('.offcanvas').html('');
    });

    $(".closed, #pesquisar").click(function() {
        $('.search-box').toggleClass('open');
    });
    
    if ($('#mapa-imoveis').length) {
        window.mapaImoveis = new Vue({
            el: '#mapa-imoveis',
            ready: function () {
                this.carregarMapa();
            },
            props: ['empreendimentos'],
            data: {
                map: null,
                markers: [],
                infoWindow: null,
                currentMarker: null,
                lista_quartos: [
                    { text: '1 quarto', value: 1 },
                    { text: '2 quartos', value: 2 },
                    { text: '3 quartos', value: 3 },
                    { text: '4 quartos', value: 4 },
                    { text: '5 quartos', value: 5 },
                ],
                lista_suites: [
                    { text: '1 suíte', value: 1 },
                    { text: '2 suítes', value: 2 },
                    { text: '3 suítes', value: 3 },
                    { text: '4 suítes', value: 4 },
                    { text: '5 suítes', value: 5 },
                ],
                lista_vagas: [
                    { text: '1 vaga de garagem', value: 1 },
                    { text: '2 vagas de garagem', value: 2 },
                    { text: '3 vagas de garagem', value: 3 },
                    { text: '4 vagas de garagem', value: 4 },
                    { text: '5 vagas de garagem', value: 5 },
                ],
                lista_aptos_andar: [
                    { text: '1 apartamento por andar', value: 1 },
                    { text: '2 apartamentos por andar', value: 2 },
                    { text: '3 apartamentos por andar', value: 3 },
                    { text: '4 apartamentos por andar', value: 4 },
                    { text: '5 apartamentos por andar', value: 5 },
                    { text: '6 apartamentos por andar', value: 6 },
                ],
                lista_idades_projeto: [
                    { text: 'Menos de 10 anos', value: 1 },
                    { text: 'De 10 a 20 anos', value: 2 },
                    { text: 'De 20 a 30 anos', value: 3 },
                    { text: 'Mais 30 anos', value: 4 },
                ],
                lista_finalidades: [
                    { text: 'Aluguel', value: 'aluguel' },
                    { text: 'Compra', value: 'compra' },
                ],
                descricao_filtros: ''
            },
            methods: {
                addMarker: function (empreendimento) {
                    var marker = new google.maps.Marker({
                        position: {
                            lat: parseFloat(empreendimento.latitude),
                            lng: parseFloat(empreendimento.longitude)
                        },
                        map: this.map,
                        title: empreendimento.nome,
                        optimized: false
                    });

                    marker.identifier = empreendimento.id;

                    marker.addListener('click', function() {
                        var that = this;
                        $.get('empreendimentos/'+this.identifier, function(data) {
                            if (window.mapaImoveis.infoWindow != null) {
                                window.mapaImoveis.infoWindow.close();
                            }
                            window.mapaImoveis.infoWindow = new google.maps.InfoWindow({
                                content: data
                            });
                            window.mapaImoveis.infoWindow.open(that.map, marker);
                            window.mapaImoveis.$set('currentMarker', marker);
                        });
                    });

                    this.markers.push(marker);
                },
                setMapOnAll: function (map) {
                    for (var i = 0; i < this.markers.length; i++) {
                        this.markers[i].setMap(map);
                    }
                },
                clearMarkers: function () {
                    this.setMapOnAll(null);
                },
                showMarkers: function () {
                    this.setMapOnAll(this.map);
                },
                deleteMarkers: function () {
                    this.clearMarkers();
                    this.$set('markers', []);
                },
                carregarMapa: function () {
                    this.$set('map', new google.maps.Map(document.getElementById('map'), {
                        center: {lat: -20.2751185, lng: -40.29226860000001},
                        zoom: 16,
                        mapTypeId: google.maps.MapTypeId.SATELLITE,
                        tilt: 45,
                        disableDefaultUI: true
                    }));

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
                        strokeColor: '#00C600',
                        strokeOpacity: 0.5,
                        strokeWeight: 3,
                        fillColor: '#00C600',
                        fillOpacity: 0.25
                    });

                    polygon.setMap(this.map);

                    var polygonLabel = new MapLabel({
                        text: 'Mata da Praia',
                        position: new google.maps.LatLng(-20.2751185, -40.29226860000001),
                        map: this.map,
                        fontSize: 14,
                        align: 'center'
                    });

                    polygonLabel.setMap(this.map);
                    var lista = JSON.parse(this.empreendimentos);

                    for (var i = 0; i < lista.length; i++) {
                        this.addMarker(lista[i]);
                    }

                    this.map.addListener('click', function() {
                        window.mapaImoveis.$set('currentMarker', null);
                        if (window.mapaImoveis.infoWindow != null) {
                            window.mapaImoveis.infoWindow.close();
                        }
                        if ($('body').hasClass('offcanvas-open')) {
                            $('body').removeClass('offcanvas-open');
                            google.maps.event.trigger(window.mapaImoveis.map, "resize");
                            $('.offcanvas').html('');
                        }
                    });
                }
            }
        });
    }
});