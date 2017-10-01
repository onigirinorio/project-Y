<?php
?>
<div class="center-block">
<?= $this->Html->image('jamp_logo.png'); ?>
</div>
<div class="container">
    <?= $this->Form->create(null,['class' => 'form-horizontal'])?>
    <fieldset>
        <legend><?= __('ログイン') ?></legend>
        <?php
        echo $this->Form->control('email',
            [
                'label' => 'メールアドレス',
                'class' => 'form-control'
            ]
        );
        echo $this->Form->control('password',
            [
                'label' => 'パスワード',
                'class' => 'form-control'
            ]
        );
        ?>
    </fieldset>
        <?= $this->Form->button('ログイン',['class' => 'btn btn-default']) ?>
    <?= $this->Form->end() ?>

    <div class="center-block">
        <a href="/users/add/">新規登録</a>
    </div>
</div>
