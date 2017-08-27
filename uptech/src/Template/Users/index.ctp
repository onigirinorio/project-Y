<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Works'), ['controller' => 'Works', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Work'), ['controller' => 'Works', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Users') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name','名前') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name_kana','カナ') ?></th>
                <th scope="col"><?= $this->Paginator->sort('password','パスワード') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email','メールアドレス') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tell','電話番号') ?></th>
                <th scope="col"><?= $this->Paginator->sort('gendar','性別') ?></th>
                <th scope="col"><?= $this->Paginator->sort('birth','生年月日') ?></th>
                <th scope="col"><?= $this->Paginator->sort('zip_code','郵便番号') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pref','都道府県') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address','都道府県以降') ?></th>
                <th scope="col"><?= $this->Paginator->sort('work_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $this->Number->format($user->id) ?></td>
                <td><?= h($user->name) ?></td>
                <td><?= h($user->name_kana) ?></td>
                <td><?= h($user->password) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?= $this->Number->format($user->tell) ?></td>
                <td><?= h($user->gendar) ?></td>
                <td><?= h($user->birth) ?></td>
                <td><?= $this->Number->format($user->zip_code) ?></td>
                <td><?= h($user->pref) ?></td>
                <td><?= h($user->address) ?></td>
                <td><?= $user->has('work') ? $this->Html->link($user->work->id, ['controller' => 'Works', 'action' => 'view', $user->work->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
