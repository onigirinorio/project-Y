function showCarendar(date){
    var shift = [];
    $.each(['shift'],function (i,obj) {
        var json = $.ajax({
            url: "/ajax/calender/shift/",
            type : "GET",
            dataType: "json",
            async:false
        }).done(function (val) {
            return val;
        });

        if(obj === 'shift'){
            shift.push(json.responseJSON);
        }
    });
    var shiftEvent =[];
    if(shift.length !== 0){
        $.each(shift[0], function (i, obj) {
            var event = [];
            event['start'] = obj['date'] +' '+ obj['shift_attend'];
            event['end'] = obj['date'] +' '+ obj['shift_clock'];
            if(obj['shift_attend'] <= obj['attend_time'] && obj['shift_clock'] >= obj['leave_time']){
                event['color'] = 'green'
            }
            shiftEvent.push(event);
        });
    }

    $('#calendar').fullCalendar({
        defaultDate: date,
        // 月名称
        monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
        // 月略称
        monthNamesShort: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
        // 曜日名称
        dayNames: ['日曜日', '月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '土曜日'],
        // 曜日略称
        dayNamesShort: ['日', '月', '火', '水', '木', '金', '土'],
        timeFormat: 'H:mm',
        displayEventEnd:true
    });

    $.each(shiftEvent,function(i,obj){
        $('#calendar').fullCalendar('renderEvent', obj, true);
    })
}
