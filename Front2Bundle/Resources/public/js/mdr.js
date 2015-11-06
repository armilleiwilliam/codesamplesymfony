$(document).ready(function () {
    $("#form_tipo_contratto").prop('selectedIndex', 0);
    $("li.last a").click(function(){
               $(".box-ricerca").slideToggle();
               $(".page-slider").toggleClass("page-slider-add-box");
    });
    var i = 0;
    var i = 300;
    $("#ric-avanz").click(function(){
        $("#form_categoria").prop("selectedIndex",0);
        $("#form_tipologia").prop("selectedIndex",0);
        $(".col-md-12 > .no-display-i").addClass("no-disp");
        $(".col-md-12 > .no-disp").toggleClass("no-display-i");
        
        // stabilisco la dimensione del campo ricerca che si ridurrà quando tolgo il campo categoria, al contrario quando viene visualizzato
        if(i == 300){
            i = 350;
        }else{
            i = 300;
        }
      
        $(".box-ricerca").animate({
            height: i
        });
        
       $("#ric-avanz").text(function (i, text){
           return text === "Ricerca ridotta"?"Ricorda avanzata":"Ricerca ridotta";
       });

        
      
   
    });
    
    $('#form_tipologia').html('');
    $(".pm").hide();
    
    $('#form_tipo_contratto').change(function () {
        $(".pm").hide();
        $('#form_prezzo_vendita').val('');
        $('#form_prezzo_affitto').val('');
        $("#pm" + $(this).val()).show();
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
 
    $("#form_tipo_contratto").change(function(){
        $(".box-ricerca").animate({
            height: "320px"
        }, 200);
    });
$("#form_invia").click(function(){
var valore = $("#form_categoria").val();
      if(valore != ''){
          $(".form_ricerca").submit();
      }else{
        alert("Devi selezionare una categoria!");
        
    }
    
});


});
    function tipologie_find(){
   getTipologie($("#form_categoria"));
    }
    function getTipologie($this) {
        $.getJSON(Routing.generate('filtro_categoria', {id: $this.val()}), function (data, status, xhr) {
            $('#form_tipologia').html('');
            $('#form_tipologia').append('<option value="">Tutte le offerte</option>');
            for (var i in data) {
                $('#form_tipologia').append('<option value="' + data[i].id + '">' + data[i].label + '</option>');
            }
        });  


}