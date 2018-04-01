<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="shifts form large-9 medium-8 columns content">
    <h3 class="h3_responsive"><?= __('シフト詳細') ?></h3>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">日付</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= $shift->date ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">名前</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= $shift->user->name ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">出勤時間</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= $shift->attend ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">退勤時間</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= $shift->clock ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">休日出勤フラグ</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= $shift->holiday_flag ?></div>
    </div>

    <div class="btn_area">
        <?= $this->Html->link(__('編集'), ['action' => 'edit', $shift->id], ['class' => 'btn btn-success edit_delete_btn']) ?>
        <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $shift->id], ['class' => 'btn btn-danger edit_delete_btn', 'confirm' => __('{0}のシフトを削除します。よろしいですか？', $shift->date)]) ?>
    </div>

</div>



