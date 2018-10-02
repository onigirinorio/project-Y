<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Shift[]|\Cake\Collection\CollectionInterface $shifts
 */

$this->assign('title', 'シフト一覧');

// フォームヘルパーのdiv要素を調整
$this->Form->templates([
    'inputContainer' => '{{content}}',
    'inputContainerError' => '{{content}}{{error}}',
    'submitContainer' => '{{content}}',
]);
?>
<div class="shifts index large-9 medium-8 columns content">
    <?php if ($admin_flg === true): ?>
        <div class="search_works_area">
            <h3 class="h3_responsive"><?= __('シフト検索') ?></h3>
            <?= $this->Form->create('null', ['type' => 'get', 'url' => ['controller' => 'shifts', 'action' => 'index']]) ?>
            <ul>
                <li>
                    <?= $this->Form->select('search_user_id', $select_users,
                        [
                            'value' => $this->request->getQuery('search_user_id'),
                            'empty' => 'ユーザーを選択してください',
                            'class' => 'input form_input ',
                        ]
                    ) ?>
                </li>
                <li>
                    <?= $this->Form->year('search_date',
                        [
                            'value' => $this->request->getQuery('search_date.year'),
                            'class' => 'input form_input input_inline',
                            'empty' => '年',
                        ]
                    ) ?>

                    <?= $this->Form->month('search_date',
                        [
                            'monthNames' => false,
                            'value' => $this->request->getQuery('search_date.month'),
                            'class' => 'input form_input input_inline',
                            'empty' => '月',
                        ]
                    ) ?>


                    <?= $this->Form->day('search_date',
                        [
                            'value' => $this->request->getQuery('search_date.day'),
                            'class' => 'input form_input input_inline',
                            'empty' => '日',
                        ]
                    ) ?>
                </li>

                <?php //$this->Form->input('date', ['type' => 'datetime', 'dateFormat' => 'YM', 'default' => date('Y-m'), 'monthNames' => false,]) ?>
                <li>
                    <?= $this->Form->submit(__('検索'),
                        [
                            'class' => 'btn btn-primary',
                        ]
                    ) ?>

                    <?= $this->Form->submit(__('全日付データ取得'),
                        [
                            'class' => 'btn btn-primary',
                            'name' => 'all_date',
                        ]
                    ) ?>
                </li>

            </ul>
            <?= $this->Form->end() ?>
        </div>
    <?php endif; ?>

    <h3><?= __('シフト一覧') ?></h3>
    <table cellpadding="0" cellspacing="0" class="table">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('date', '日付') ?></th>
            <th scope="col"><?= $this->Paginator->sort('user_id', 'ユーザー') ?></th>
            <th scope="col">出勤状態</th>
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
                <?php // 遅刻判定
                $lateness_flg = false;
                if (!$shift->has('work') && strtotime($shift->attend) < strtotime(date('H:i:s')) && strtotime($shift->date) <= strtotime(date('Y-m-d')) || $shift->has('work') && strtotime($shift->attend) < strtotime($shift->work->attend_time)) {
                    $lateness_flg = true;
                }
                ?>
                <td class="<?= $lateness_flg ? 'text_red' : 'text_green' ?>">
                    <?php if ($shift->has('work')): ?>
                        出勤済
                    <?php elseif (!$shift->has('work') && $lateness_flg): ?>
                        遅刻
                    <?php else: ?>
                        未出勤
                    <?php endif; ?>
                </td>
                <td class="hidden-xs"><?= date('H:i', strtotime($shift->attend)) ?></td>
                <td class="hidden-xs"><?= date('H:i', strtotime($shift->clock)) ?></td>
                <td class="hidden-xs">
                    <?php if ($shift->holiday_flag == 0): ?>
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
            <?= $this->Paginator->numbers(['modulus' => 4]) ?>
            <?= $this->Paginator->next(__('次へ') . ' >') ?>
            <?= $this->Paginator->last(__('最後へ') . ' >>') ?>
        </ul>
    </div>
</div>
