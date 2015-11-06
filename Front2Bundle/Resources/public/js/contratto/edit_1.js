var map;
$(document).ready(function(){

        map = new GMaps({
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

    });

var Form = function() {

    var handleForm = function() {
        $('form.contratto').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
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
                $form = $($('form.contratto'));
                $.post($form.attr('action'), $form.serialize(), function(url) {
                    window.location = url;
                }).error(function() {
                    $('#casa_corebundle_contratto_button').toggle();
                    submit = false;
                });
            }
        }
    }();
    var initCharts = function() {
        if (!jQuery.plot) {
            return;
        }

        function showTooltip(giorno, euro, uumm, x, y) {
            $('<div id="tooltip" class="chart-tooltip"><div class="date">' + giorno + '<\/div><div class="label label-success">Prezzo:<br/>' + euro + uumm +'<\/div><\/div>').css({
                position: 'absolute',
                display: 'none',
                top: y - 100,
                width: 80,
                left: x - 40,
                border: '0px solid #ccc',
                padding: '2px 6px',
                'background-color': '#fff',
            }).appendTo("body").fadeIn(200);
        }

        if ($('#site_statistics').size() != 0) {

            $('#site_statistics_loading').hide();
            $('#site_statistics_content').show();

            var plot_statistics = $.plot($("#site_statistics"), [{
                    data: affitto,
                    label: "Prezzo d'affitto"
                }, {
                    data: vendita,
                    label: "Prezzo di vendita (x 1000)"
                }
            ], {
                series: {
                    lines: {
                        show: true,
                        lineWidth: 2,
                        fill: true,
                        fillColor: {
                            colors: [{
                                    opacity: 0.05
                                }, {
                                    opacity: 0.01
                                }
                            ]
                        }
                    },
                    points: {
                        show: true
                    },
                    shadowSize: 2
                },
                grid: {
                    hoverable: true,
                    clickable: true,
                    tickColor: "#eee",
                    borderWidth: 0
                },
                colors: ["#d12610", "#37b7f3", "#52e136"],
                xaxis: {
                    ticks: 11,
                    tickDecimals: 0
                },
                yaxis: {
                    ticks: 11,
                    tickDecimals: 0
                }
            });

            var previousPoint = null;
            $("#site_statistics").bind("plothover", function(event, pos, item) {
                $("#x").text(pos.x.toFixed(2));
                $("#y").text(pos.y.toFixed(2));
                if (item) {
                    if (previousPoint != item.dataIndex) {
                        previousPoint = item.dataIndex;

                        $("#tooltip").remove();
                        var x = item.datapoint[0].toFixed(2),
                                y = item.datapoint[1].toFixed(2);
                        var time = Date.create(parseInt(item.datapoint[0] + '001'));
                        showTooltip(time.format('{dow} {dd} {mon}', 'it'), item.seriesIndex === 0 ? item.datapoint[1] : item.datapoint[1] * 1000,' €', item.pageX, item.pageY);
                    }
                } else {
                    $("#tooltip").remove();
                    previousPoint = null;
                }
            });
        }

        $('.flot-x-axis').children('div').each(function() {
            var time = Date.create(parseInt($(this).html() + '000'));
            $(this).html(time.format('short', 'it'));
        });
    };

    return {
        //main function to initiate map samples
        init: function() {
            handleForm();
            initCharts();
        }
    };

}();
