function showCarendar(date, search_user_id){
    var shift = [];
    $.each(['shift'],function (i,obj) {
        var json = $.ajax({
            url: "/ajax/calender/" + search_user_id,
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
            console.log(obj);
            var event = [];
            event['start'] = obj['date'] +' '+ obj['shift_attend'];
            event['end'] = obj['date'] +' '+ obj['shift_clock'];
            var date = new Date(event['start']);
            var now  = new Date();
            var attended = null;
            if(obj['attend_time'] !== null){
                attended = new Date(obj['attend_time']);
            }
            if((date < now && attended === null)　|| (attended !== null && date < attended)){
                event['color'] = 'red';
            }
            if(obj['shift_attend'] <= obj['attend_time'] && obj['shift_clock'] >= obj['leave_time']){
                event['color'] = 'green';
            }
            console.log(new Date(event['start']));
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
