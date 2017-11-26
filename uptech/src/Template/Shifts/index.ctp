<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Shift[]|\Cake\Collection\CollectionInterface $shifts
  */
?>
<div class="shifts index large-9 medium-8 columns content">
    <h3><?= __('シフト一覧') ?></h3>
    <table cellpadding="0" cellspacing="0" class="table">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id', 'ユーザー名') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date', '日付') ?></th>
                <th scope="col"><?= $this->Paginator->sort('attend', '出勤時間') ?></th>
                <th scope="col"><?= $this->Paginator->sort('clock', '退勤時間') ?></th>
                <th scope="col"><?= $this->Paginator->sort('holiday_flag', '休日フラグ') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($shifts as $shift): ?>
            <tr>
                <td><?= $this->Number->format($shift->id) ?></td>
                <td><?= $shift->has('user') ? $this->Html->link($shift->user->name, ['controller' => 'Users', 'action' => 'view', $shift->user->id]) : '' ?></td>
                <td><?= h($shift->date) ?></td>
                <td><?= date('H:i', strtotime($shift->attend)) ?></td>
                <td><?= date('H:i', strtotime($shift->clock)) ?></td>
                <td>
                  <?php if($shift->holiday_flag == 0): ?>
                  なし
                  <?php else: ?>
                  休日出勤
                  <?php endif; ?>
                </td>
                <td class="actions">
                    <?= $this->Html->link(__('詳細'), ['action' => 'edit', $shift->id]) ?>
                    <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $shift->id], ['confirm' => __('シフト{0}を削除してもよろしいですか？?', $shift->id)]) ?>
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
