"use strict";

// Class definition
var KTGeneralFullCalendarBasicDemos = function () {
    // Private functions

    var exampleBasic = function () {
        var todayDate = moment().startOf('day');
        var TODAY = todayDate.format('YYYY-MM-DD');

        var calendarEl = document.getElementById('calendar_academic');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },

            height: 800,
            contentHeight: 780,
            aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

            nowIndicator: true,
            now: TODAY + 'T09:25:00', // just for demo

            views: {
                dayGridMonth: { buttonText: 'month' },
                timeGridWeek: { buttonText: 'week' },
                timeGridDay: { buttonText: 'day' }
            },

            initialView: 'dayGridMonth',
            initialDate: TODAY,

            editable: true,
            eventStartEditable: false,
            eventDurationEditable: false,
            dayMaxEvents: true, // allow "more" link when too many events
            navLinks: true,
            events: function (info, successCallback, failureCallback) {

                $.ajax({
                    url: '/api/get-calendar',
                    type: 'GET',
                    success: function (response) {
                        console.log(response);

                        var events = [];
                        $.each(response.calendar, function (index, value) {
                            events.push({
                                id: value.id,
                                title: value.title,
                                start: value.start,
                                end: value.end,
                                description: value.description,
                                location: value.location,
                            });
                        });


                        successCallback(events);
                    },
                    error: function (error) {
                        console.log(error);
                    },

                });
            },
            eventClick: function (info) {

                var event = info.event;
                // console.log(event);

                var event_id = event.id;
                var event_title = event.title;
                var event_start = moment(event.start).format('YYYY-MM-DD HH:mm');
                var event_end = moment(event.end).format('YYYY-MM-DD HH:mm');
                var event_description = event.extendedProps.description;

                $('#id_delete').val(event_id);
                $('#id_edit').val(event_id);
                $('#title_edit').val(event_title);
                $('#location_edit').val(event.extendedProps.location);
                $('#description_edit').val(event_description);
                $('#start_edit').val(event_start);
                $('#end_edit').val(event_end);

                $('#kt_modal_view_event').modal('show');

            },
            eventDidMount: function(info) {
                // Cek apakah event dimulai hari ini
                var eventStart = moment(info.event.start).isSame(todayDate, 'day')
                var eventEnd = moment(info.event.end).isSame(todayDate, 'day')
                if (eventStart) {
                    // Ubah background menjadi orange
                    info.el.style.backgroundColor = 'orange';
                    info.el.style.color = 'white';
                }
                if (eventEnd) {
                    // Ubah background menjadi orange
                    info.el.style.backgroundColor = 'orange';
                    info.el.style.color = 'white';
                }
            },

        });

        calendar.render();
    }

    return {
        // Public Functions
        init: function () {
            exampleBasic();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTGeneralFullCalendarBasicDemos.init();
});
