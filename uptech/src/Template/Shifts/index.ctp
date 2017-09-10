<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Shift[]|\Cake\Collection\CollectionInterface $shifts
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Shift'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="shifts index large-9 medium-8 columns content">
    <h3><?= __('Shifts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('attend') ?></th>
                <th scope="col"><?= $this->Paginator->sort('clock') ?></th>
                <th scope="col"><?= $this->Paginator->sort('holiday_flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('create_user') ?></th>
                <th scope="col"><?= $this->Paginator->sort('create_at') ?></th>
                <th scope="col"><?= $this->Paginator->sort('update_user') ?></th>
                <th scope="col"><?= $this->Paginator->sort('upteda_at') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($shifts as $shift): ?>
            <tr>
                <td><?= $this->Number->format($shift->id) ?></td>
                <td><?= $shift->has('user') ? $this->Html->link($shift->user->name, ['controller' => 'Users', 'action' => 'view', $shift->user->id]) : '' ?></td>
                <td><?= h($shift->date) ?></td>
                <td><?= h($shift->attend) ?></td>
                <td><?= h($shift->clock) ?></td>
                <td><?= h($shift->holiday_flag) ?></td>
                <td><?= h($shift->create_user) ?></td>
                <td><?= h($shift->create_at) ?></td>
                <td><?= h($shift->update_user) ?></td>
                <td><?= h($shift->upteda_at) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $shift->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $shift->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $shift->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shift->id)]) ?>
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
