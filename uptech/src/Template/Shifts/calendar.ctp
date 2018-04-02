<?php
/**
 * @var \App\View\AppView $this
 */
?>
<?= $this->Html->css('fullcalendar.min.css', ['inline' => false, 'block' => 'css']); ?>
<?= $this->Html->script('moment.min.js', ['inline' => false, 'block' => 'script']); ?>
<?= $this->Html->script('fullcalendar.min.js', ['inline' => false, 'block' => 'script']); ?>
<?= $this->Html->script('calendar.js', ['inline' => false, 'block' => 'script']); ?>

<?php if ($admin_flg): ?>
    <div class="calendar_search">
        <?= $this->Form->create('null', ['type' => 'post', 'url' => ['controller' => 'Shifts', 'action' => 'calendar']]) ?>
        <?= $this->Form->select('search_user_id', $select_users,
            [
                'value' => $this->request->getData('search_user_id'),
                'empty' => 'ユーザーを選択してください',
                'class' => 'input form_input'
            ]
        ) ?>
        <?= $this->Form->submit(__('ユーザー切替'), ['class' => 'btn btn-primary']) ?>
        <?= $this->Form->end() ?>
    </div>
<?php endif; ?>

<div id='calendar'></div>

<div class="modal fade" id="sampleModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body container-fluid">
                <?= $this->Form->create(null, ['class' => 'form-horizontal']) ?>
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
                <?= $this->Form->button('修正', ['class' => 'btn btn-default']) ?>
                <?= $this->Form->end() ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        // 引数がPHPの値を使用するため仮で入れておく。
        showCarendar("<?= date('Y-m-d H:i:s')?>", <?= $search_user_id ?>);

        $(document).on('click', '.fc-day', function () {
            var date = $(this).data('date');
            $('.modal').modal('show');
            $('.modal-title').text(date + 'のシフトを修正')
        });
    });
</script>
