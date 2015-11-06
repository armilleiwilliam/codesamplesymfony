var Form = function() {
    var mapInit = function() {

        var map = new GMaps({
            div: '#gmap',
            panControl: false,
            rotateControl: false,
            streetViewControl: false,
            overviewMapControl: false,
            lat: lat,
            lng: lon
        });

        var marker = map.addMarker({
            lat: lat,
            lng: lon,
            title: 'Your position',
            draggable: false
        });

    };

    var triggerDoc = function() {
        $('.add-doc').click(function() {
            $('#casa_corebundle_documento_contratto').val($(this).attr('contratto'));
            $('#casa_corebundle_documento_tipo').val($(this).attr('tipo'));
        });
    };

    var handleForm = function() {

        $('form.documento').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                "casa_corebundle_documento[file]": {
                    required: true
                },
                "casa_corebundle_documento[contratto]": {
                    required: true
                },
                "casa_corebundle_documento[tipo]": {
                    required: true
                }
            },
            messages: {// custom messages for radio buttons and checkboxes
                "casa_corebundle_documento[file]": {
                    required: Translator.trans('documento.error.file.required', {}, 'form')
                },
                "casa_corebundle_documento[contratto]": {
                    required: Translator.trans('documento.error.contratto.required', {}, 'form')
                },
                "casa_corebundle_documento[tipo]": {
                    required: Translator.trans('documento.error.tipo.required', {}, 'form')
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
                console.log('SUBMIT!');
                form.submit();
            }
        });

        $('form.documento input').keypress(function(e) {
            if (e.which == 13) {
                if ($('form.documento').validate().form()) {
                    formSubmit();
                }
                return false;
            }
        });

        $('#addDocumento').click(function(e) {
            if ($('form.documento').validate().form()) {
                formSubmit();
            }
        });

        var submit = false;

        function formSubmit() {
            if (!submit) {
                submit = true;
                $('.modal-footer').toggle();
                $form = $($('form.documento')[0]);
                $form.submit();
            }
        }

    };

    return {
        //main function to initiate map samples
        init: function() {
            mapInit();
            triggerDoc();
            handleForm();
        }

    };

}();

function addDocumento() {
    $('#casa_corebundle_documento_button').click();
}