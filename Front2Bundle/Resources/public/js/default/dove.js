var Form = function() {

    var handleForm = function() {

        $('.form_classe_dove').validate({
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
                    required: function() { return $('#form_email').val() == '';}
                },
                "form[testo]": {
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
                "form[testo]": {
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
                $('.form_classe_dove')[0].submit();
            }
        });

 

        $("#form_invia_ora").click(function(e) {
            if ($('.form_classe_dove').validate().form()) {
                $('.form_classe_dove')[0].submit();
            }
        });
        

    }();
    


    return {
        //main function to initiate map samples
        init: function() {
            handleForm();
        }

    };

}();