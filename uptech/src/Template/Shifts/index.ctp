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
                <th scope="col"><?= $this->Paginator->sort('date', '日付') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id', 'ユーザー') ?></th>
                <th scope="col" class="hidden-xs"><?= $this->Paginator->sort('attend', '出勤時間') ?></th>
                <th scope="col" class="hidden-xs"><?= $this->Paginator->sort('clock', '退勤時間') ?></th>
                <th scope="col" class="hidden-xs"><?= $this->Paginator->sort('holiday_flag', '休日フラグ') ?></th>
                <th scope="col" class="actions"><?= __('詳細') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($shifts as $shift): ?>
            <tr>
                <td><?= h($shift->date) ?></td>
                <td><?= $shift->has('user') ? $this->Html->link(h($shift->user->name), ['controller' => 'Users', 'action' => 'view', $shift->user->id]) : '' ?></td>
                <td class="hidden-xs"><?= date('H:i', strtotime($shift->attend)) ?></td>
                <td class="hidden-xs"><?= date('H:i', strtotime($shift->clock)) ?></td>
                <td class="hidden-xs">
                  <?php if($shift->holiday_flag == 0): ?>
                  なし
                  <?php else: ?>
                  休日出勤
                  <?php endif; ?>
                </td>
                <td class="actions">
                    <?= $this->Html->link(__('詳細'), ['action' => 'view', $shift->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('最初へ')) ?>
            <?= $this->Paginator->prev('< ' . __('前へ')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('次へ') . ' >') ?>
            <?= $this->Paginator->last(__('最後へ') . ' >>') ?>
        </ul>
    </div>
</div>
