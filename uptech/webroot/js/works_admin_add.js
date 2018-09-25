/**
 * Created by fabian on 2018/09/25.
 */

$(function(){

    var $user_select = $('[name=user_id]'),
        $project_select = $('[name=project_id]'),
        $work_location = $('[name=work_location]'),
        csrf = $('[name=_csrfToken]').val();

    $user_select.on('change', function () {
        var user_id = $user_select.val();
        $.ajax({
            url: '/users/search',
            type: 'POST',
            // csrfトークンをリクエストヘッダーに追加
            beforeSend: function(xhr){
                xhr.setRequestHeader('X-CSRF-Token', csrf);
            },
            dataType: 'json',
            data: { // 送信データを指定(getの場合は自動的にurlの後ろにクエリとして付加される)
                user_id: user_id
            }
        })
        .done(function (response) {
            $project_select.val(response.project_id);
            $work_location.val(response.work_location);
        })
        .fail(function () {
            alert('ユーザー情報の取得に失敗しました。手動で入力するか再読み込みをお試しください。');
        });
    });
});
