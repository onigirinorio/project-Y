/**
 * Created by fabian on 2018/05/26.
 */

$(function(){

    // Geolocation APIに対応している
    if (navigator.geolocation) {

    } else { // Geolocation APIに対応していない
        alert("この端末では位置情報が取得できません");
    }

    $("#btn_work_add").on('click', function () {
        var input_name = '[name=location_add]',
            target = document.getElementById("form_add");
        setLocation(input_name, target);
        //target.submit();
    });

    $("#btn_work_leave").on('click', function () {
        var input_name = '[name=location_leave]',
            target = document.getElementById("form_leave");
        setLocation(input_name, target);
        //target.submit();
    });

    function setLocation(input_name, target) {
        // 現在地を取得
        navigator.geolocation.getCurrentPosition(
            // 取得成功した場合
            function(position) {
                var lat = position.coords.latitude,
                    lon = position.coords.longitude;

                $.ajax({
                    url: 'https://www.finds.jp/ws/rgeocode.php',
                    type: 'get',
                    dataType: 'json',
                    data: { // 送信データを指定(getの場合は自動的にurlの後ろにクエリとして付加される)
                        json: '',
                        lr: 1000,
                        ar: 1000,
                        lat: lat,
                        lon: lon,
                    },
                })
                // ・ステータスコードは正常で、dataTypeで定義したようにパース出来たとき
                    .done(function (response) {
                        // 取得したデータをinputにセットしsubmitする
                        var result = response.result;
                        var location = generateAddress(result);
                        $(input_name).val(location);
                        target.submit();
                    })
                    // ・サーバからステータスコード400以上が返ってきたとき
                    // ・ステータスコードは正常だが、dataTypeで定義したようにパース出来なかったとき
                    // ・通信に失敗したとき
                    .fail(function () {
                        alert('位置情報の取得に失敗しました、再度お試しください。');
                    });

            },
            // 取得失敗した場合
            function(error) {
                switch(error.code) {
                    case 1: //PERMISSION_DENIED
                        alert("位置情報の利用が許可されていません");
                        break;
                    case 2: //POSITION_UNAVAILABLE
                        alert("現在位置が取得できませんでした");
                        break;
                    case 3: //TIMEOUT
                        alert("タイムアウトになりました");
                        break;
                    default:
                        alert("その他のエラー(エラーコード:"+error.code+")");
                        break;
                }
            }
        );
    }

    function generateAddress(data) {
        var address = '';
        if (data.prefecture.pname) {
            address += data.prefecture.pname;
        }
        if (data.municipality.mname) {
            address += data.municipality.mname;
        }
        if (data.local[0].section) {
            address += data.local[0].section;
        }
        if (data.local[0].homenumber) {
            address += data.local[0].homenumber;
        }

        return address;
    }
});
