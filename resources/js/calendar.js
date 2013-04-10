/**
 * Created with JetBrains PhpStorm.
 * User: makcummd
 * Date: 4/9/13
 * Time: 3:27 PM
 * To change this template use File | Settings | File Templates.
 */
$( document ).ready(function() {
    $( "#calendar" ).fullCalendar({
        firstDay: 1,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        weekNumbers: 'true',
        timeFormat: 'H:(mm)',
        dayClick: function() {
            alert("Add new task");
        }
    })
});