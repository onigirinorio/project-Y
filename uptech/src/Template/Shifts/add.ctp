<?php
/**
  * @var \App\View\AppView $this
  */
$this->assign('title', 'シフト登録');
?>
<div class="shifts form large-9 medium-8 columns content">
    <?= $this->Form->create($shift) ?>

    <h3 class="h3_responsive"><?= __('シフト登録') ?></h3>

    <?= $this->element('Shifts/form') ?>

    <div class="btn_area">
        <?= $this->Form->button('登録', ['class' => 'btn btn-primary submit_btn']) ?>
    </div>

    <?= $this->Form->end() ?>
</div>
