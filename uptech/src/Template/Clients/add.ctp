<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="clients form large-9 medium-8 columns content">
    <?= $this->Form->create($client) ?>

    <h3 class="h3_responsive"><?= __('クライアント登録') ?></h3>

    <?= $this->element('Clients/form', ['client' => $client]) ?>

    <div class="btn_area">
        <?= $this->Form->button(__('登録'), ['class' => 'btn btn-primary submit_btn']) ?>
    </div>
    <?= $this->Form->end() ?>
</div>
