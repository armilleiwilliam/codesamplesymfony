function scheda_evi(id, ids){
    $.post(Routing.generate("scheda_evidenza", {id : id }), function(data){
        if(data == 1){
            $("#evi"+ids).removeClass("red")
            $("#evi"+ids).addClass("green");
        }else if(data == 0){
            $("#evi"+ids).removeClass("green")
            $("#evi"+ids).addClass("red");
        }
    }).fail(function(){
       alert("ss");     
   });
}

function scheda_esc(id, ids){
    $.post(Routing.generate("scheda_esclusiva", {id : id }), function(data){
        if(data == 1){
            $("#esc"+ids).removeClass("red")
            $("#esc"+ids).addClass("green");
        }else if(data == 0){
            $("#esc"+ids).removeClass("green")
            $("#esc"+ids).addClass("red");
        }
    }).fail(function(){
       alert("ss");     
   });
}
function scheda_asta(id, ids){
    $.post(Routing.generate("scheda_asta", {id : id }), function(data){
        if(data == 1){
            $("#asta"+ids).removeClass("red")
            $("#asta"+ids).addClass("green");
        }else if(data == 0){
            $("#asta"+ids).removeClass("green")
            $("#asta"+ids).addClass("red");
        }
    }).fail(function(){
       alert("ss");     
   });
}
function scheda_pub(id, ids){

    $.post(Routing.generate("scheda_pubblicazione_tre", {id : id }), function(data){
        if(data == 1){
            $("#pub"+ids).removeClass("red")
            $("#pub"+ids).addClass("green");
        }else if(data == 0){
            $("#pub"+ids).removeClass("green")
            $("#pub"+ids).addClass("red");
        }
    }).fail(function(){
       alert("ss");     
   });
}
