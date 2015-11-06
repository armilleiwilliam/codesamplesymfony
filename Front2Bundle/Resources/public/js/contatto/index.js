var Form = function () {

    return {
        //main function to initiate the module
        init: function () {
            Form.initCalendar();
        },
        initCalendar: function () {

            if (!jQuery().fullCalendar) {
                return;
            }

            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            var h = {};

            if (App.isRTL()) {
                if ($('#calendar').parents(".portlet").width() <= 720) {
                    $('#calendar').addClass("mobile");
                } else {
                    $('#calendar').removeClass("mobile");
                }
                h = {
                    right: 'prev,next',
                    center: '',
                    left: 'agendaDay,agendaWeek,month,today'
                };
            } else {
                if ($('#calendar').parents(".portlet").width() <= 720) {
                    $('#calendar').addClass("mobile");
                } else {
                    $('#calendar').removeClass("mobile");
                }
                h = {
                    left: 'prev,next',
                    center: '',
                    right: 'today,month,agendaWeek,agendaDay'
                };
            }

            $('#calendar').fullCalendar('destroy'); // destroy the calendar
            $('#calendar').fullCalendar({//re-initialize the calendar
                defaultView: 'agendaDay',
                header: h,
                slotMinutes: 15,
                firstDay: 1,
                editable: true,
                timeFormat: 'H:mm',
                droppable: true, // this allows things to be dropped onto the calendar !!!
                events: event_list
            });

        }
    };
}();