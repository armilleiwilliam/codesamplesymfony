var _indirizzo = null;
var _localita = null;
var _cap = null;
var _latitudine = null;
var _longitudine = null;

var Form = function() {
    var mapInit = function() {

        var map = new GMaps({
            div: '#gmap',
            panControl: false,
            rotateControl: false,
            streetViewControl: false,
            overviewMapControl: false,
            lat: $('#form_lat').val(),
            lng: $('#form_lon').val()
        });

        var marker = map.addMarker({
            lat: $('#form_lat').val(),
            lng: $('#form_lon').val(),
            title: 'Your position',
            draggable: true,
            dragend: function(event) {
                var pos = this.getPosition();
                GMaps.geocode({
                    location: pos,
                    callback: function(results, status) {
                        $('#form_lat').val(pos.lat());
                        $('#form_lon').val(pos.lng());
                        map.setCenter(pos.lat(), pos.lng());
                        if (status == 'OK') {
                            var indirizzo = '';
                            var localita = '';
                            var cap = '';
                            $.each(results[0].address_components, function(index, element) {
                                if (element.types[0] == 'street_number') {
                                    indirizzo += ', ' + element.long_name;
                                }
                                if (element.types[0] == 'route') {
                                    indirizzo = element.long_name + indirizzo;
                                }
                                if (element.types[0] == 'locality') {
                                    localita = element.long_name + localita;
                                }
                                if (element.types[0] == 'administrative_area_level_2' && localita != element.long_name) {
                                    localita += ' (' + element.short_name + ')';
                                }
                                if (element.types[0] == 'postal_code') {
                                    cap = element.long_name;
                                }
                            });
                            if (confirm('Il nuovo indirizzo risulta ' + results[0].formatted_address + '. Vuoi cambiare?')) {
                                $('#form_indirizzo').val(indirizzo);
                                $('#form_localita').val(localita);
                                $('#form_cap').val(cap);
                            }
                        }
                    }
                });
                App.scrollTo($('#gmap'));
            },
            click: function(e) {
                if (console.log)
                    console.log(e);
                alert('You clicked in this marker');
            }
        });



        var handleAction = function() {
            if ($.trim($('#form_indirizzo').val()) !== '' && $.trim($('#form_localita').val()) !== '') {
                var text = $.trim($('#form_indirizzo').val() + ' ' + $('#form_localita').val());
                GMaps.geocode({
                    address: text,
                    callback: function(results, status) {
                        if (status == 'OK') {
                            var cap = '';
                            $.each(results[0].address_components, function(index, element) {
                                if (element.types[0] == 'postal_code') {
                                    cap = element.long_name;
                                }
                            });
                            $('#form_cap').val(cap);
                            var latlng = results[0].geometry.location;
                            var pos = new google.maps.LatLng(latlng.lat(), latlng.lng());
                            marker.setPosition(pos);
                            map.setCenter(latlng.lat(), latlng.lng());
                            $('#form_lat').val(latlng.lat());
                            $('#form_lon').val(latlng.lng());
//                            App.scrollTo($('#gmap'));
                        }
                    }
                });
            }
        };

        $('#form_indirizzo').blur(function(e) {
            e.preventDefault();
            handleAction();
        });

        $("#form_localita").blur(function(e) {
            e.preventDefault();
            handleAction();
        });

    }();

    var handleForm = function() {

        $('.form-scheda').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                "form[indirizzo]": {
                    required: true
                },
                "form[localita]": {
                    required: true
                },
                "form[cap]": {
                    required: true
                },
            },
            messages: {// custom messages for radio buttons and checkboxes
                "form[indirizzo]": {
                    required: Translator.trans('scheda.error.indirizzo.required', {}, 'form')
                },
                "form[localita]": {
                    required: Translator.trans('scheda.error.localita.required', {}, 'form')
                },
                "form[cap]": {
                    required: Translator.trans('scheda.error.cap.required', {}, 'form')
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
                form.submit();
            }
        });

        $('.form-scheda input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.form-scheda').validate().form()) {
                    formSubmit();
                }
                return false;
            }
        });

        $('#form_button').click(function(e) {
            if ($('.form-scheda').validate().form()) {
                formSubmit();
            }
        });
        
        function formSubmit() {
            $('#form_button').toggle();
            $form = $($('.form-scheda')[0]);
            $form.submit();
        }
    }();

    return {
        //main function to initiate map samples
        init: function() {
            mapInit();
            handleForm();
        }

    };

}();