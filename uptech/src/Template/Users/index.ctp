<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<h3 class="legend_responsive"><?= __('ユーザー一覧') ?></h3>
<div class="table-responsive">
    <table cellpadding="0" cellspacing="0" class="table">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('name', '名前') ?></th>
            <th scope="col" class="hidden-xs"><?= $this->Paginator->sort('name_kana', '名前(カナ)') ?></th>
            <th scope="col" class="hidden-xs"><?= $this->Paginator->sort('gendar', '性別') ?></th>
            <th scope="col" class="hidden-xs"><?= $this->Paginator->sort('birth', '生年月日') ?></th>
            <th scope="col"><?= $this->Paginator->sort('project_id', 'プロジェクト') ?></th>
            <th scope="col" class="actions"><?= __('詳細') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= h($user->name) ?></td>
                <td class="hidden-xs"><?= h($user->name_kana) ?></td>
                <td class="hidden-xs">
                    <?php if ($user->gender === 0 || empty($user->gender)): ?>
                        <?= '男' ?>
                    <?php else : ?>
                        <?= '女' ?>
                    <?php endif ?>
                </td>
                <td class="hidden-xs"><?= h($user->birth) ?></td>
                <td><?= $user->has('project') ? $this->Html->link($user->project->shop_name, ['controller' => 'Projects', 'action' => 'view', $user->project->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('詳細'), ['action' => 'view', $user->id]) ?>
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
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('次へ') . ' >') ?>
        <?= $this->Paginator->last(__('最後へ') . ' >>') ?>
    </ul>
</div>
