<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Client[]|\Cake\Collection\CollectionInterface $clients
  */
?>

<div class="container">
    <h3><?= __('クライアント一覧') ?></h3>
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" class="table">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('クライアント') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('電話') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('郵便番号') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('都道府県') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('都道府県以降') ?></th>
                    <th scope="col" class="actions"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clients as $client): ?>
                <tr>
                    <td><?= $this->Number->format($client->id) ?></td>
                    <td><?= h($client->client_name) ?></td>
                    <td><?= h($client->tell) ?></td>
                    <td><?= $this->Number->format($client->zip_code) ?></td>
                    <td><?= h($client->pref) ?></td>
                    <td><?= h($client->address) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('編集'), ['action' => 'edit', $client->id]) ?>
                        <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $client->id], ['confirm' => __('{0}を削除してもよろしいですか？', $client->client_name)]) ?>
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
