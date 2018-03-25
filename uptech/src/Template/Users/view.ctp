<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="users form large-9 medium-8 columns content">
    <h3 class="legend_responsive"><?= __('ユーザー詳細') ?></h3>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">名前</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= $user->name ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">名前(カナ)</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= $user->name_kana ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">メールアドレス</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= $user->email ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">電話番号</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= $user->tell ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">性別</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= GENDER[$user->gender] ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">生年月日</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= $user->birth ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">郵便番号</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= $user->zip_code ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">都道府県</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= $user->pref ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">都道府県以降</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= $user->address ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">プロジェクト</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= $user->project->shop_name ?></div>
    </div>

    <div class="btn_area">
        <?= $this->Html->link(__('編集'), ['action' => 'edit', $user->id], ['class' => 'btn btn-success edit_delete_btn']) ?>
        <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $user->id], ['class' => 'btn btn-danger edit_delete_btn', 'confirm' => __('ユーザーを削除します。よろしいですか？ # {0}?', $user->id)]) ?>
    </div>

</div>
