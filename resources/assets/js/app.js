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
});