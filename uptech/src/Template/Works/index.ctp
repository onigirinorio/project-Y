<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Work[]|\Cake\Collection\CollectionInterface $works
 */

$this->assign('title', '出退勤一覧');

// フォームヘルパーのdiv要素を調整
$this->Form->templates([

    'inputContainer' => '{{content}}',
    'inputContainerError' => '{{content}}{{error}}',
    'submitContainer' => '{{content}}',
]);
?>
<?php if ($admin_flg === true): ?>
    <div class="search_works_area">
        <h3 class="h3_responsive"><?= __('勤怠データ検索') ?></h3>
        <?= $this->Form->create('null', ['type' => 'get', 'url' => ['controller' => 'works', 'action' => 'index']]) ?>
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
            <li>
                <label>交通費データを含める</label>
                <?= $this->Form->checkbox('transport_expenses_flg',
                    [
                        'class' => '',
                        'checked' => !empty($this->request->getQuery('transport_expenses_flg')),
                    ]
                ) ?>
            </li>

            <?php //$this->Form->input('date', ['type' => 'datetime', 'dateFormat' => 'YM', 'default' => date('Y-m'), 'monthNames' => false,]) ?>
            <li>
                <?= $this->Form->submit(__('検索'),
                    [
                        'class' => 'btn btn-primary',
                    ]
                )?>

                <?php //if ($user_agent === 'pc'): // excel出力表示はPCのみ?>
                <?= $this->Form->submit(__('Excel出力'),
                    [
                        'class' => 'btn btn-primary',
                        'name' => 'export_excel',
                    ]
                ) ?>
                <p>※Excel出力をする際はユーザー・年・月を設定した状態で出力してください。</p>
                <?php //endif; ?>
            </li>

        </ul>
        <?= $this->Form->end() ?>

    </div>
<?php endif; ?>

<?php //$this->Html->link(__('Excel出力'), ['controller' => 'Works', 'action' => 'download_excel'], ['class' => 'btn btn-primary']) ?>
<h3 class="h3_responsive"><?= __('勤怠データ一覧') ?></h3>
<div class="table-responsive">
    <table cellpadding="0" cellspacing="0" class="table">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('create_at', '日付') ?></th>
            <th scope="col"><?= $this->Paginator->sort('user_id', 'ユーザー') ?></th>
            <th scope="col"><?= $this->Paginator->sort('work_location', '勤務先') ?></th>
            <th scope="col" class="hidden-xs"><?= $this->Paginator->sort('attend_time', '出勤時間') ?></th>
            <th scope="col" class="hidden-xs"><?= $this->Paginator->sort('leave_time', '退勤時間') ?></th>
            <th scope="col" class="hidden-xs"><?= $this->Paginator->sort('break_time', '休憩時間') ?></th>
            <th scope="col" class="hidden-xs"><?= $this->Paginator->sort('overtime', '残業時間') ?></th>
            <th scope="col" class="hidden-xs"><?= $this->Paginator->sort('remarks', '備考有無') ?></th>
            <th scope="col" class="hidden-xs"><?= $this->Paginator->sort('transport_expenses', '交通費') ?></th>
            <th scope="col" class="actions"><?= __('詳細') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($works as $work): ?>
            <tr>
                <td><?= date('Y/m/d', strtotime($work->create_at)) ?></td>
                <td><?= $work->has('user') ? $this->Html->link($work->user->name, ['controller' => 'Users', 'action' => 'view', $work->user->id]) : '' ?></td>
                <td><?= h($work->work_location) ?></td>
                <td class="hidden-xs"><?= date('H:i', strtotime($work->attend_time)) ?></td>
                <td class="hidden-xs"><?php if ($work->leave_time) {
                        echo date('H:i', strtotime($work->leave_time));
                    } ?></td>
                <td class="hidden-xs"><?= date('H:i', strtotime($work->break_time)) ?></td>
                <td class="hidden-xs"><?= date('H:i', strtotime($work->overtime)) ?></td>
                <td class="hidden-xs"><?= !empty($work->remarks) ? '有' : '無' ?></td>
                <td class="hidden-xs"><?= $work->transport_expenses ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('詳細'), ['action' => 'view', $work->id]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('<< ' . __('最初へ')) ?>
        <?= $this->Paginator->prev('< ' . __('前へ')) ?>
        <?= $this->Paginator->numbers(['modulus' => 4]) ?>
        <?= $this->Paginator->next(__('次へ') . ' >') ?>
        <?= $this->Paginator->last(__('最後へ') . ' >>') ?>
    </ul>
</div>
