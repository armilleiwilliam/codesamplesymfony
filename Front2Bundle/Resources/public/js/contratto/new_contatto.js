

var Form = function() {
//

    var handleForm2 = function() {

        $('form.proprietario').validate({
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
                "form[telefono]": {
                    required: function(){
                        return $("#form_email").val() == ""
                    }
                },
                "form[email]": {
                    required: function(){
                        return $("#form_telefono").val() == ""
                    },
                    email: true
                },
                "form[dataNascita]": {
                    required: false
                }
            },
            messages: {// custom messages for radio buttons and checkboxes
                "form[nome]": {
                    required: Translator.trans('form.error.nome.required', {}, 'form')
                },
                "form[cognome]": {
                    required: Translator.trans('form.error.cognome.required', {}, 'form')
                },
                "form[telefono]": {
                    required: Translator.trans('form.error.telefono.required', {}, 'form')
                },
                "form[email]": {
                    required: Translator.trans('form.error.email.required', {}, 'form'),
                    email: Translator.trans('form.error.email.email', {}, 'form')
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
        $("#casa_corebundle_form_reset").click(function(e){
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
                    $('#proprietario-chiudi').click();
                    
                    window.location.href = Routing.generate("gestione-contatti");
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

