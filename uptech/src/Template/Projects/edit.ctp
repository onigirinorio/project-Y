<?php
/**
  * @var \App\View\AppView $this
  */
$this->assign('title', '案件編集');
?>

<div class="projects form large-9 medium-8 columns content">
    <?= $this->Form->create($project) ?>

    <h3 class="h3_responsive"><?= __('案件編集') ?></h3>

    <?= $this->element('Projects/form', ['project' => $project, 'clientList' => $clientList]) ?>

    <div class="btn_area">
        <?= $this->Form->button('登録', ['class' => 'btn btn-primary submit_btn']) ?>
    </div>

    <?= $this->Form->end() ?>
</div>
