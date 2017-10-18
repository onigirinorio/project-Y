<?php
/**
  * @var \App\View\AppView $this
  */
?>
<?= $this->Html->css('fullcalendar.min.css', ['inline' => false, 'block' => 'css']);?>
<?= $this->Html->script('moment.min.js', ['inline' => false, 'block' => 'script']);?>
<?= $this->Html->script('fullcalendar.min.js', ['inline' => false, 'block' => 'script']);?>
<div class="container">
    <div id='calendar'></div>
</div>
<div class="modal fade" id="sampleModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body container-fluid">
                <?= $this->Form->create(null,['class' => 'form-horizontal'])?>
                <fieldset>
                    <?php
                    echo $this->Form->control(
                        'attend_time',
                        [
                            'label' => '出勤時間',
                            'class' => 'form-control'
                        ]
                    );
                    echo $this->Form->control(
                        'leave_time',
                        [
                            'label' => '退勤時間',
                            'class' => 'form-control'
                        ]
                    );
                    echo $this->Form->control('break_time',
                        [
                            'label' => '休憩時間',
                            'class' => 'form-control'
                        ]
                    );
                    echo $this->Form->control('overtime',
                        [
                            'label' => '残業時間	',
                            'class' => 'form-control'
                        ]
                    );
                    ?>
                </fieldset>
            </div>
            <div class="modal-footer">
                <?= $this->Form->button('修正',['class' => 'btn btn-default']) ?>
                <?= $this->Form->end() ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        $('#calendar').fullCalendar({
            defaultDate: '<?= date('Y-m-d H:i:s')?>',
            // 月名称
            monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
            // 月略称
            monthNamesShort: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
            // 曜日名称
            dayNames: ['日曜日', '月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '土曜日'],
            // 曜日略称
            dayNamesShort: ['日', '月', '火', '水', '木', '金', '土'],
        });
        $(document).on('click','.fc-day',function(){
            var date  = $(this).data('date');
            $('.modal').modal('show');
            $('.modal-title').text(date + 'のシフトを修正')
        });
    });
</script>