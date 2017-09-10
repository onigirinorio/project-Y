<?php
/**
  * @var \App\View\AppView $this
  */
?>

<div class="clients form large-9 medium-8 columns content">
    <?= $this->Form->create($client) ?>
    <fieldset>
        <legend><?= __('Add Client') ?></legend>
        <?php
            echo $this->Form->control('client_id');
            echo $this->Form->control('client_name');
            echo $this->Form->control('tell');
            echo $this->Form->control('zip_code');
            echo $this->Form->control('pref');
            echo $this->Form->control('address');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
