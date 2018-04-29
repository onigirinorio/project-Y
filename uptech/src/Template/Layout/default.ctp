<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$title = '勤怠管理ツール';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $title ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->script('jquery.min.js'); ?>
    <?= $this->Html->script('jquery-ui.min.js'); ?>
    <?= $this->Html->css('reset.css'); ?>
    <?= $this->Html->css('bootstrap.min'); ?>
    <?= $this->Html->css('custom.css'); ?>
    <?= $this->Html->script('bootstrap.js'); ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <?= $this->fetch('js-element') ?>
</head>
<body>
<?php if ($is_login): ?>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#navbar-header1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="/"><?= $this->html->image('jamp_logo_min.png') ?></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-header1">
                <ul class="nav navbar-nav">
                    <?php if ($admin_flg === true): ?>
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                                ユーザー管理
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li role="presentation"><?= $this->Html->link(__('ユーザー一覧'), ['controller' => 'Users', 'action' => 'index']) ?></li>
                                <li role="presentation"><?= $this->Html->link(__('ユーザー登録'), ['controller' => 'Users', 'action' => 'add']) ?></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                                案件管理
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li role="presentation"><?= $this->Html->link(__('案件一覧'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
                                <li role="presentation"><?= $this->Html->link(__('案件登録'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                                クライアント管理
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li role="presentation"><?= $this->Html->link(__('クライアント一覧'), ['controller' => 'Clients', 'action' => 'index']) ?></li>
                                <li role="presentation"><?= $this->Html->link(__('クライアント登録'), ['controller' => 'Clients', 'action' => 'add']) ?></li>
                            </ul>
                        </li>
                    <?php endif ?>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                            シフト管理
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation"><?= $this->Html->link(__('シフト一覧'), ['controller' => 'Shifts', 'action' => 'index']) ?></li>
                            <li role="presentation"><?= $this->Html->link(__('シフト登録'), ['controller' => 'Shifts', 'action' => 'add']) ?></li>

                            <?php if ($user_agent === 'pc'): // カレンダー表示はPCのみ?>
                                <li role="presentation"><?= $this->Html->link(__('カレンダー'), ['controller' => 'Shifts', 'action' => 'calendar']) ?></li>
                            <?php endif; ?>

                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                            出退勤管理
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation"><?= $this->Html->link(__('出退勤一覧'), ['controller' => 'Works', 'action' => 'index']) ?></li>
                            <?php if ($admin_flg === false): ?>
                                <li role="presentation"><?= $this->Html->link(__('出退勤登録'), ['controller' => 'Works', 'action' => 'add']) ?></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right" style="padding-left: 15px;">
                    <li class="nav navbar-nav">
                        <?= $this->Html->link(__($user_name . 'さん'), ['controller' => 'Users', 'action' => 'view', $user_id]) ?>
                    </li>
                    <li class="nav navbar-nav">
                        <?= $this->Html->link(__('ログアウト'), ['controller' => 'Home', 'action' => 'logout']) ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php else: ?>

<?php endif ?>
<?= $this->Flash->render() ?>
<div class="container clearfix">
    <?= $this->fetch('content') ?>
</div>
<footer>
</footer>
</body>
</html>
