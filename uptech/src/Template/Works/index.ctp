<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Work[]|\Cake\Collection\CollectionInterface $works
  */
?>
<div class="container">
    <?php if ($admin_flg === true): ?>
        <div class="search_works_area">
            <h3><?= __('勤怠検索') ?></h3>
            <?= $this->Form->create('null', ['type' => 'get', 'url' => ['controller' => 'works', 'action' => 'index']]) ?>
                <ul>
                    <li>
                        <?= $this->Form->select('search_user_id', $select_users,
                            [
                                'value' => $this->request->getQuery('search_user_id'),
                                'empty' => 'ユーザーを選択してください',
                                'class' => 'input'
                            ]
                        ) ?>
                    </li>
                    <li>
                        <?= $this->Form->year('search_date',
                            [
                                'default' => '年',
                                'value' => $this->request->getQuery('search_date.year'),
                                'class' => 'input'
                            ]
                        ) ?>

                        <?= $this->Form->month('search_date',
                            [
                                'monthNames' => false,
                                'default' => '月',
                                'value' => $this->request->getQuery('search_date.month'),
                                'class' => 'input'
                            ]
                        ) ?>
                    </li>

                    <?php //$this->Form->input('date', ['type' => 'datetime', 'dateFormat' => 'YM', 'default' => date('Y-m'), 'monthNames' => false,]) ?>
                    <li><?= $this->Form->submit(__('検索'), ['class' => 'btn btn-primary']) ?></li>
                </ul>
            <?= $this->Form->end() ?>

            <?= $this->Form->create('null', ['type' => 'post', 'url' => ['controller' => 'Works', 'action' => 'download_excel']]) ?>
                <?= $this->Form->hidden('user_id', ['value' => $this->request->getQuery('search_user_id')]) ?>
                <?= $this->Form->hidden('date_y', ['value' => $this->request->getQuery('search_date.year')]) ?>
                <?= $this->Form->hidden('date_m', ['value' => $this->request->getQuery('search_date.month')]) ?>
                <?= $this->Form->submit(__('Excel出力'), ['class' => 'btn btn-primary']) ?>
            <?= $this->Form->end() ?>
        </div>
    <?php endif; ?>

    <?php //$this->Html->link(__('Excel出力'), ['controller' => 'Works', 'action' => 'download_excel'], ['class' => 'btn btn-primary']) ?>
    <h3><?= __('勤怠一覧') ?></h3>
    <table cellpadding="0" cellspacing="0" class="table">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('create_at', '日付') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id', 'ユーザーID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('project_id', 'プロジェクトID') ?></th>
                <th scope="col"><?= $this->Paginator->sort('attend_time', '出勤時間') ?></th>
                <th scope="col"><?= $this->Paginator->sort('leave_time', '退勤時間') ?></th>
                <th scope="col"><?= $this->Paginator->sort('break_time', '休憩時間') ?></th>
                <th scope="col"><?= $this->Paginator->sort('overtime', '残業時間') ?></th>
                <th scope="col" class="actions"><?= __('作業') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($works as $work): ?>
            <tr>
                <td><?= date('Y/m/d', strtotime($work->create_at)) ?></td>
                <td><?= $work->has('user') ? $this->Html->link($work->user->name, ['controller' => 'Users', 'action' => 'view', $work->user->id]) : '' ?></td>
                <td><?= $work->has('project') ? $this->Html->link($work->project->shop_name, ['controller' => 'Projects', 'action' => 'edit', $work->project->id]) : '' ?></td>
                <td><?= date('H:i', strtotime($work->attend_time)) ?></td>
                <td><?php if ($work->leave_time) { echo date('H:i', strtotime($work->leave_time)); } ?></td>
                <td><?= date('H:i', strtotime($work->break_time)) ?></td>
                <td><?= date('H:i', strtotime($work->overtime)) ?></td>
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
