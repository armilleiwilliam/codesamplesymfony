var Form = function() {

    var handleForm = function() {

        $('.post-comment form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                "form[nome]": {
                    required: true
                },
                "form[cognome]": {
                    required: true
                },
                "form[email]": {
                    email: true,
                    required: function() { return $('#form_telefono').val() == '';}
                },
                "form[telefono]": {
                    required: function() { return $('#form_email').val() == '';}
                },
                "form[messaggio]": {
                    required: true
                }
            },
            messages: {// custom messages for radio buttons and checkboxes
                "form[nome]": {
                    required: Translator.trans('contratto.error.proprietario.required', 'form')
                },
                "form[cognome]": {
                    required: Translator.trans('messaggio.error.nome.required', 'form')
                },
                "form[email]": {
                    email: Translator.trans('messaggio.error.email.email', {}, 'form'),
                    required: Translator.trans('messaggio.error.emailtelefono.required', 'form')
                },
                "form[telefono]": {
                    required: Translator.trans('messaggio.error.emailtelefono.required', {}, 'form')
                },
                "form[messaggio]": {
                    required: Translator.trans('messaggio.error.messaggio.required', {}, 'form')
                }
            },
            invalidHandler: function(event, validator) { //display error alert on form submit   

            },
            highlight: function(element) { // hightlight error inputs
                $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },
            errorPlacement: function(error, element) {
                if (element.closest('.input-icon').size() === 1) {
                    error.insertAfter(element.closest('.input-icon'));
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                formSubmit();
            }
        });

        $('.form-scheda input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.post-comment form').validate().form()) {
                    formSubmit();
                }
                return false;
            }
        });

        $('#form_invia_form').click(function(e) {
            if ($('.post-comment form').validate().form()) {
                formSubmit();
            }
        });
        
        function formSubmit() {
            $('#form_invia_form').toggle();
            var form = $($('.post-comment form')[0]);
            $.getJSON(form.attr('action'), form.serialize(), function (data, status, xhr){
                
                $("#req-info").slideToggle();
                $('#cortesia').html(data);
            }).error(function(){
                $('#form_invia_form').toggle();
            });
        }
    }();
    
    var toggleForm = function() {
        $("#btn-info").click(function(){
            $("#req-info").slideToggle();
            $('#cortesia').html("");
            $("#form_nome").val("");
            
            $("#form_cognome").val("");
            $("#form_email").val("");
            $("#form_telefono").val("");
            $("#form_messaggio").val("");
              $('#form_invia_form').show();
        });
    
    }();

    return {
        //main function to initiate map samples
        init: function() {
            handleForm();
            toggleForm();
        }

    };

}();