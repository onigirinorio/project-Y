<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="users form large-9 medium-8 columns content">
    <h3 class="h3_responsive"><?= __('クライアント詳細') ?></h3>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">クライアント名</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= $client->client_name ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">電話番号</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= $client->tell ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">郵便番号</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= $client->zip_code ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">都道府県</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= $client->pref ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">都道府県以降</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= $client->address ?></div>
    </div>

    <div class="btn_area">
        <?= $this->Html->link(__('編集'), ['action' => 'edit', $client->id], ['class' => 'btn btn-success edit_delete_btn']) ?>
        <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $client->id], ['class' => 'btn btn-danger edit_delete_btn', 'confirm' => __('クライアント「{0}」を削除します。よろしいですか？', $client->client_name)]) ?>
    </div>

</div>
