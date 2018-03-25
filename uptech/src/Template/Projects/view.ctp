<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="users form large-9 medium-8 columns content">
    <h3 class="h3_responsive"><?= __('案件詳細') ?></h3>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">店舗名</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= $project->shop_name ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">クライアント名</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= $project->has('client') ? $project->client->client_name : '' ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">支払区分</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= PAYMENT_STATUS[$project->payment_status] ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">金額</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= $project->price ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">分単位</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= IN_MINUTES[$project->in_minutes] ?>分</div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">開始日</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= $project->start_date ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">終了日</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= $project->end_date ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">交通費区分</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= $project->expense_status ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">交通費</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= $project->expense ?></div>
    </div>

    <div class="btn_area">
        <?= $this->Html->link(__('編集'), ['action' => 'edit', $project->id], ['class' => 'btn btn-success edit_delete_btn']) ?>
        <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $project->id], ['class' => 'btn btn-danger edit_delete_btn', 'confirm' => __('案件「{0}」を削除します。よろしいですか？', $project->shop_name)]) ?>
    </div>

</div>
