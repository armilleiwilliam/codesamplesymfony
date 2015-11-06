$(document).ready(function(){

/* questa funzione serve per mostrare le immagini */
$('.mix-grid').mixitup();


    var handleForm = function() {


        $('form.foto').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                "casa_corebundle_foto[file]": {
                    required: true
                },
                "casa_corebundle_foto[contratto]": {
                    required: true
                },
            },
            messages: {// custom messages for radio buttons and checkboxes
                "casa_corebundle_foto[file]": {
                    required: Translator.trans('foto.error.file.required', {}, 'form')
                },
                "casa_corebundle_foto[contratto]": {
                    required: Translator.trans('foto.error.contratto.required', {}, 'form')
                },
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
                console.log('SUBMIT!');
                form.submit();
            }
        });

        $('form.foto input').keypress(function(e) {
            if (e.which == 13) {
                if ($('form.foto').validate().form()) {
                    formSubmit();
                }
                return false;
            }
        });

        $('#addFoto').click(function(e) {
            if ($('form.foto').validate().form()) {
                formSubmit();
            }
        });

        var submit = false;

        function formSubmit() {
            if (!submit) {
                submit = true;
                $('.modal-footer').toggle();
                $form = $($('form.foto')[0]);
                $form.submit();
                 $('.mix-grid').mixitup();
            }
        }

    }();



});
function addDocumento() {
    $('#casa_corebundle_foto_button').click();
}