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

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->script('jquery.min.js'); ?>
    <?= $this->Html->css('bootstrap.min'); ?>
    <?= $this->Html->script('bootstrap.js'); ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <?php if($is_login): ?>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-header1">
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
                    <?php if($admin_flg === true): ?>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                            ユーザー管理
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation"><?= $this->Html->link(__('一覧'), ['controller'=>'Users','action' => 'index']) ?></li>
                            <li role="presentation"><?= $this->Html->link(__('新規追加'), ['controller'=>'Users','action' => 'add']) ?></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                            案件管理
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation"><?= $this->Html->link(__('案件一覧'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
                            <li role="presentation"><?= $this->Html->link(__('新規案件'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                            クライアント管理
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation"><?= $this->Html->link(__('クライアント一覧'), ['controller' => 'Clients', 'action' => 'index']) ?></li>
                            <li role="presentation"><?= $this->Html->link(__('クライアント追加'), ['controller' => 'Clients', 'action' => 'add']) ?></li>
                        </ul>
                    </li>
                    <?php endif ?>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                            出退勤管理
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation"><?= $this->Html->link(__('出退勤一覧'), ['controller' => 'Works', 'action' => 'index']) ?></li>
                            <li role="presentation"><?= $this->Html->link(__('出退勤追加'), ['controller' => 'Works', 'action' => 'add']) ?></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                            ようこそ、<?=$user_name?>さん
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation"><?= $this->Html->link(__('情報変更'), ['controller' => 'Users', 'action' => 'edit',$user_id]) ?></li>
                        </ul>
                    </li>
                    <li class="nav navbar-nav navbar-right">
                        <a href="/home/logout/">ログアウト</a>
                    </li>
<!--          勤怠は後回し         -->
<!--                    <li class="dropdown">-->
<!--                        <a href="#" data-toggle="dropdown" role="button" aria-expanded="false">-->
<!--                            勤怠-->
<!--                            <span class="caret"></span>-->
<!--                        </a>-->
<!--                        <ul class="dropdown-menu" role="menu">-->
<!--                            <li role="presentation">--><?//= $this->Html->link(__('List Works'), ['controller' => 'Works', 'action' => 'index']) ?><!--</li>-->
<!--                            <li role="presentation">--><?//= $this->Html->link(__('New Work'), ['controller' => 'Works', 'action' => 'add']) ?><!--</li>-->
<!--                        </ul>-->
<!--                    </li>-->
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
