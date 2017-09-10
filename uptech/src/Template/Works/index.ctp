<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Work[]|\Cake\Collection\CollectionInterface $works
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Work'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="works index large-9 medium-8 columns content">
    <h3><?= __('Works') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('project_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('attend_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('leave_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('break_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('overtime') ?></th>
                <th scope="col"><?= $this->Paginator->sort('create_at') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($works as $work): ?>
            <tr>
                <td><?= $this->Number->format($work->id) ?></td>
                <td><?= $work->has('user') ? $this->Html->link($work->user->name, ['controller' => 'Users', 'action' => 'view', $work->user->id]) : '' ?></td>
                <td><?= $work->has('project') ? $this->Html->link($work->project->id, ['controller' => 'Projects', 'action' => 'view', $work->project->id]) : '' ?></td>
                <td><?= h($work->attend_time) ?></td>
                <td><?= h($work->leave_time) ?></td>
                <td><?= h($work->break_time) ?></td>
                <td><?= h($work->overtime) ?></td>
                <td><?= h($work->create_at) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $work->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $work->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $work->id], ['confirm' => __('Are you sure you want to delete # {0}?', $work->id)]) ?>
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
