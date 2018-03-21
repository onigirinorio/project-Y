<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
  */
?>
<div class="container">
    <h3><?= __('ユーザー一覧') ?></h3>
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" class="table">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('name','ユーザー名') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('name_kana','ユーザー名(カナ)') ?></th>
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
                    <td><?= h($user->name) ?></td>
                    <td><?= h($user->name_kana) ?></td>
                    <td><?= h($user->email) ?></td>
                    <td><?= h($user->tell) ?></td>
                    <td>
                        <?php if($user->gender === 0 || empty($user->gender)):?>
                            <?= '男' ?>
                        <?php else : ?>
                            <?= '女' ?>
                        <?php endif ?>
                    </td>
                    <td><?= h($user->birth) ?></td>
                    <td><?= substr_replace(h($user->zip_code),'-',3,0) ?></td>
                    <td><?= h($user->pref) ?></td>
                    <td><?= h($user->address) ?></td>
                    <td><?= $user->has('work') ? $this->Html->link($user->work->id, ['controller' => 'Works', 'action' => 'view', $user->work->id]) : '' ?></td>
                    <td class="actions">
<!--                        --><?//= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                        <?= $this->Html->link(__('編集'), ['action' => 'edit', $user->id]) ?>
                        <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $user->id], ['confirm' => __('ユーザーを削除します。よろしいですか？ # {0}?', $user->id)]) ?>
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
</div>
