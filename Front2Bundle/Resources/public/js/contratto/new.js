//

var Form = function() {
//
    var handleForm = function() {

        $('form.contratto').validate({
            errorElement: 'em', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",
            rules: {
                "casa_corebundle_contratto[proprietario]": {
                    required: true
                },
                "casa_corebundle_contratto[dataFirma]": {
                    required: true
                },
                "casa_corebundle_contratto[prezzi][0][vendita]": {
                    required: function() {
                        return !$('#casa_corebundle_contratto_prezzi_0_affitto').is(':checked') && !$('#casa_corebundle_contratto_prezzi_0_vendita').is(':checked')
                    }
                },
                "casa_corebundle_contratto[prezzi][0][affitto]": {
                    required: function() {
                        return !$('#casa_corebundle_contratto_prezzi_0_affitto').is(':checked') && !$('#casa_corebundle_contratto_prezzi_0_vendita').is(':checked')
                    }
                },
                "casa_corebundle_contratto[prezzi][0][prezzoVendita]": {
                    required: function() {
                        return $('#casa_corebundle_contratto_prezzi_0_vendita').is(':checked')
                    }
                },
                "casa_corebundle_contratto[prezzi][0][prezzoAffitto]": {
                    required: function() {
                        return $('#casa_corebundle_contratto_prezzi_0_affitto').is(':checked')
                    }
                }
            },
            messages: {// custom messages for radio buttons and checkboxes
                "casa_corebundle_contratto[proprietario]": {
                    required: Translator.trans('contratto.error.proprietario.required', {}, 'form')
                },
                "casa_corebundle_contratto[dataFirma]": {
                    required: Translator.trans('contratto.error.dataFirma.required', {}, 'form')
                },
                "casa_corebundle_contratto[prezzi][0][vendita]": {
                    required: Translator.trans('contratto.error.venditaaffitto.required', {}, 'form')
                },
                "casa_corebundle_contratto[prezzi][0][affitto]": {
                    required: Translator.trans('contratto.error.venditaaffitto.required', {}, 'form')
                },
                "casa_corebundle_contratto[prezzi][0][prezzoVendita]": {
                    required: Translator.trans('contratto.error.prezzoVendita.required', {}, 'form')
                },
                "casa_corebundle_contratto[prezzi][0][prezzoAffitto]": {
                    required: Translator.trans('contratto.error.prezzoAffitto.required', {}, 'form')
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

        $('.form.contratto input').keypress(function(e) {
            if (e.which == 13) {
                if ($('form.contratto').validate().form()) {
                    formSubmit();
                }
                return false;
            }
        });

        $('#casa_corebundle_contratto_button').click(function(e) {
            if ($('form.contratto').validate().form()) {
                formSubmit();
            }
        });

        var submit = false;

        function formSubmit() {
            if (!submit) {
                submit = true;
                $('#casa_corebundle_contratto_button').toggle();
                $form = $($('form.contratto')[0]);
                $.post($form.attr('action'), $form.serialize(), function(url) {
                    window.location = url;
                }).error(function() {
                    $('#casa_corebundle_contratto_button').toggle();
                    submit = false;
                });
            }
        }
    }();

    var handleForm2 = function() {

        $('form.proprietario').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                "contatto[nome]": {
                    required: true
                },
                "contatto[cognome]": {
                    required: true
                },
                "contatto[telefono]": {
                    required: true
                },
                "contatto[email]": {
                    required: false,
                    email: true
                },
                "contatto[dataNascita]": {
                    required: false
                }
            },
            messages: {// custom messages for radio buttons and checkboxes
                "contatto[nome]": {
                    required: Translator.trans('contatto.error.nome.required', {}, 'form')
                },
                "contatto[cognome]": {
                    required: Translator.trans('contatto.error.cognome.required', {}, 'form')
                },
                "contatto[telefono]": {
                    required: Translator.trans('contatto.error.telefooo.required', {}, 'form')
                },
                "contatto[email]": {
                    required: Translator.trans('contatto.error.email.email', {}, 'form')
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

        $('.form.proprietario input').keypress(function(e) {
            if (e.which == 13) {
                if ($('form.proprietario').validate().form()) {
                    formSubmit();
                }
                return false;
            }
        });
        $('#casa_corebundle_contatto_button_new').click(function(e) {
            if ($('form.proprietario').validate().form()) {
                formSubmit();
            }
        });
        $("#contatto_reset").click(function(e){
           $('form.proprietario')[0].reset();
        });

        var submit = false;

        function formSubmit() {
            if (!submit) {
                submit = true;
                $('.modal-footer').toggle();
                $form = $($('form.proprietario')[0]);
                $.post($form.attr('action'), $form.serialize(), function(json) {
                    $('#form_proprietario').append('<option value="' + json.id + '">' + json.label + '</option>');
                    $('#form_proprietario').val(json.id);
                    $('form.proprietario')[0].reset();
                    $('.modal-footer').toggle();
                    $("#wait").show();
                    $('#proprietario-chiudi').click();
                    
                    $("#wait").hidden();
                    submit = false;
                }).error(function() {
                    $('.modal-footer').toggle();
                    submit = false;
                });
            }
        }
    }();

    return {
        //main function to initiate map samples
        init: function() {
            handleForm();
            handleForm2();
        }

    };

}();

