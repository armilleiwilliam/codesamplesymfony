$(document).ready(function () {
    $('#form_tipologia').html('');
    $(".pm").hide();
    
    $('#form_tipo_contratto').change(function () {
        $(".pm").hide();
        $('#form_prezzo_vendita').val('');
        $('#form_prezzo_affitto').val('');
        $("#pm" + $(this).val()).show();
    });

    $("#form_localita").autocomplete({
        minLength: 2,
        source: function (request, response) {
            var term = request.term;
            var cache = localStorage.getItem('mdr_' + term);
            alert("sdfsdf");
            $.getJSON(Routing.generate('geo_search', request), request, function (data, status, xhr) {
                localStorage.setItem('mdr_' + term, JSON.stringify(data, null, 2));
                response(data);
            });
        },
	close: function( event ) {
            $("#form_localita").change();
            this.cancelSearch = true;
	}
    });
    
    $('.col').change(function(){
        var ref = $(this).attr('ref');
        var active = false;
        $('[ref="'+ref+'"]').each(function(){
            active |= $(this).val() != '';
        });
        if(active) {
            $('.'+ref).addClass('box-active');
        } else {
            $('.'+ref).removeClass('box-active');
        }
    });

    $("#form_categoria").change(function () {
        getTipologie($(this));
    });
    getTipologie($("#form_categoria"));

    function getTipologie($this) {
        $.getJSON(Routing.generate('filtro_categoria', {id: $this.val()}), function (data, status, xhr) {
            $('#form_tipologia').html('');
            $('#form_tipologia').append('<option value="">Tutte le offerte</option>');
            for (var i in data) {
                $('#form_tipologia').append('<option value="' + data[i].id + '">' + data[i].label + '</option>');
            }
        });
    }
});
