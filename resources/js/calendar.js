document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth'
    });
    calendar.render();
});

    document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    events: '/appointments',
    selectable: true,
    editable: true,
    height: 400,
    });
    calendar.render();
});


/*
    var calendar = new Calendar(calendarEl,{
        timezone: 'UTC',
        events: [
        {
        id: '1',
        title: 'podologue',
        start: '2025-02-23',
        end: '2025-02-25'
        }
      ]
    });
var event = calendar.getEventById('a');
var start = event.start;
var end = event.end;
console.log(start.toISOString);
*/
