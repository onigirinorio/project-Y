<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="users form large-9 medium-8 columns content">
    <h3 class="h3_responsive"><?= __('ユーザー詳細') ?></h3>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">名前</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= h($user->name) ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">名前(カナ)</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= h($user->name_kana) ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">メールアドレス</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= h($user->email) ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">電話番号</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= h($user->tell) ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">性別</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= h(GENDER[$user->gender]) ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">生年月日</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= h($user->birth) ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">郵便番号</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= h($user->zip_code) ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">都道府県</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= h($user->pref) ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">都道府県以降</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= h($user->address) ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">開始日</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= date('Y/m/d', strtotime($user->start_date)) ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">終了日</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= date('Y/m/d', strtotime($user->end_date)) ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">交通経路</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= h($user->expense_route) ?></div>
    </div>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">交通費</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= h($user->expense_price) ?></div>
    </div>

    <?php if ($admin_flg): ?>
    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">案件名</div>
        <div
            class="col-md-10 col-sm-10 col-xs-12 view_input"><?= $user->has('project') ? h($user->project->shop_name) : '' ?></div>
    </div>
    <?php endif; ?>

    <div class="view_row_wrapper clearfix">
        <div class="col-md-2 col-sm-2 col-xs-12 form_label">勤務先</div>
        <div class="col-md-10 col-sm-10 col-xs-12 view_input"><?= h($user->work_location) ?></div>
    </div>

    <div class="btn_area">
        <?= $this->Html->link(__('編集'), ['action' => 'edit', $user->id], ['class' => 'btn btn-success edit_delete_btn']) ?>
        <?php if ($admin_flg): ?>
            <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $user->id], ['class' => 'btn btn-danger edit_delete_btn', 'confirm' => __('{0}を削除します。よろしいですか？', $user->name)]) ?>
        <?php endif; ?>
    </div>

</div>
