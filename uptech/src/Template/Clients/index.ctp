<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Client[]|\Cake\Collection\CollectionInterface $clients
 */
$this->assign('title', 'クライアント一覧');
?>

<h3 class="h3_responsive"><?= __('クライアント一覧') ?></h3>
<div class="table-responsive">
    <table cellpadding="0" cellspacing="0" class="table">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('クライアント') ?></th>
            <th scope="col"><?= $this->Paginator->sort('電話番号') ?></th>
            <th scope="col" class="hidden-xs"><?= $this->Paginator->sort('郵便番号') ?></th>
            <th scope="col" class="hidden-xs"><?= $this->Paginator->sort('都道府県') ?></th>
            <th scope="col" class="hidden-xs"><?= $this->Paginator->sort('都道府県以降') ?></th>
            <th scope="col" class="actions"><?= __('詳細') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($clients as $client): ?>
            <tr>
                <td><?= h($client->client_name) ?></td>
                <td><?= h($client->tell) ?></td>
                <td class="hidden-xs"><?= $this->Display->zip_code(h($client->zip_code)) ?></td>
                <td class="hidden-xs"><?= h($client->pref) ?></td>
                <td class="hidden-xs"><?= h($client->address) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('詳細'), ['action' => 'view', $client->id]) ?>
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
