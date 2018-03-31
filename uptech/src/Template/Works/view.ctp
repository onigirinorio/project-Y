<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="users form large-9 medium-8 columns content">
    <h3 class="h3_responsive"><?= __('勤怠詳細') ?></h3>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">日付</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= date('Y/m/d', strtotime($work->create_at)) ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">ユーザー</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= $work->user->name ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">プロジェクト</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= $work->project->shop_name ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">出勤時間</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= date('H:i',strtotime($work->attend_time)) ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">退勤時間</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= date('H:i',strtotime($work->leave_time)) ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">休憩時間</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= date('H:i',strtotime($work->break_time)) ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">残業時間</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= date('H:i',strtotime($work->overtime)) ?></div>
    </div>

    <?php if ($admin_flg): ?>
    <div class="btn_area">
        <?= $this->Html->link(__('編集'), ['action' => 'edit', $work->id], ['class' => 'btn btn-success edit_delete_btn']) ?>
        <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $work->id], ['class' => 'btn btn-danger edit_delete_btn', 'confirm' => __('勤怠データ１件を削除します。よろしいですか？')]) ?>
    </div>
    <?php endif; ?>

</div>

