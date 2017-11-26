<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Work[]|\Cake\Collection\CollectionInterface $works
  */
?>
<div class="container">
    <h3><?= __('勤怠登録') ?></h3>
    <table cellpadding="0" cellspacing="0" class="table">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id', 'ユーザーID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('project_id', 'プロジェクトID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('attend_time', '出勤時間') ?></th>
                <th scope="col"><?= $this->Paginator->sort('leave_time', '退勤時間') ?></th>
                <th scope="col"><?= $this->Paginator->sort('break_time', '休憩時間') ?></th>
                <th scope="col"><?= $this->Paginator->sort('overtime', '残業時間') ?></th>
                <th scope="col"><?= $this->Paginator->sort('create_at', '作成日時') ?></th>
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
                <td><?= date('H:i', strtotime($work->break_time)) ?></td>
                <td><?= date('H:i', strtotime($work->overtime)) ?></td>
                <td><?= h($work->create_at) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('詳細'), ['action' => 'edit', $work->id]) ?>
                    <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $work->id], ['confirm' => __('Are you sure you want to delete # {0}?', $work->id)]) ?>
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
