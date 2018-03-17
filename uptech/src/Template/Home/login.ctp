<?= $this->Html->css('login.css'); ?>

<div class="login" style="display: none;">
    <h1>勤怠管理ツール</h1>
    <?= $this->Form->create()?>
        <?php
        echo $this->Form->control('email',
            [
                'placeholder' => 'メールアドレス',
                'label' => false
            ]
        );
        echo $this->Form->control('password',
            [
                'placeholder' => 'パスワード',
                'label' => false
            ]
        );
        ?>
        <button type="submit" class="btn btn-primary btn-block btn-large">ログイン</button>
    <?= $this->Form->end() ?>
    <?= $this->Html->link('新規登録', ['controller' => 'users', 'action' => 'add']) ?>
</div>


<script>
    $(function() {
        $('.login').fadeIn('slow');
    })
</script>
