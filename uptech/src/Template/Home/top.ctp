<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Project[]|\Cake\Collection\CollectionInterface $projects
  */
?>
<div class="container">
    <div class="row">
        <div class="col-sm-4 col-xs-6 card-wrapper">
            <a href="<?= $this->Url->build(['controller'=>'Users', 'action'=>'index']); ?>">
                <?= $this->Card->card('user', 'ユーザー管理') ?>
            </a>
        </div>
        <div class="col-sm-4 col-xs-6 card-wrapper">
            <a href="<?= $this->Url->build(['controller'=>'Projects', 'action'=>'index']); ?>">
                <?= $this->Card->card('folder-close', '案件管理') ?>
            </a>
        </div>
        <div class="col-sm-4 col-xs-6 card-wrapper">
            <a href="<?= $this->Url->build(['controller'=>'Clients', 'action'=>'index']); ?>">
                <?= $this->Card->card('home', 'クライアント管理') ?>
            </a>
        </div>
        <div class="col-sm-4 col-xs-6 card-wrapper">
            <a href="<?= $this->Url->build(['controller'=>'Shifts', 'action'=>'index']); ?>">
                <?= $this->Card->card('calendar', 'シフト管理') ?>
            </a>
        </div>
        <div class="col-sm-4 col-xs-6 card-wrapper">
            <a href="<?= $this->Url->build(['controller'=>'Works', 'action'=>'index']); ?>">
                <?= $this->Card->card('retweet', '勤怠管理') ?>
            </a>
        </div>
        <div class="col-sm-4 col-xs-6 card-wrapper">
            <a href="<?= $this->Url->build(['controller'=>'Users', 'action'=>'index']); ?>">
                <?= $this->Card->card('export', 'エンジニア管理<br>システム') ?>
            </a>
        </div>
    </div>
</div>
