<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="projects form large-9 medium-8 columns content">
    <?= $this->Form->create($project) ?>
    <h3 class="h3_responsive"><?= __('案件登録') ?></h3>

    <?= $this->element('Projects/form', ['project' => $project, 'clientList' => $clientList]) ?>

    <div class="btn_area">
        <?= $this->Form->button(__('登録'), [
            'text' => '登録',
            'class' => 'btn btn-primary submit_btn'
        ]) ?>
    </div>

    <?= $this->Form->end() ?>
</div>
