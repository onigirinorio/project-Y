<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Project[]|\Cake\Collection\CollectionInterface $projects
  */
?>
<div class="container">
    <h3><?= __('案件一覧') ?></h3>
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" class="table">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('shop_name', '店舗名') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('client_id', 'クライアント名') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('payment_status', '支払い区分') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('price', '金額') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('start_date', '開始日') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('end_date', '終了日') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projects as $project): ?>
                    <tr>
                        <td><?= $this->Number->format($project->id) ?></td>
                        <td><?= h($project->shop_name) ?></td>
                        <td><?= h($project->client->client_name) ?></td>
                        <td>
                            <?php if($project->payment_status==0): ?>
                            月給
                            <?php elseif($project->payment_status==1): ?>
                            日給
                            <?php elseif($project->payment_status==2): ?>
                            時給
                            <?php else: ?>
                            その他
                            <?php endif; ?>
                        </td>
                        <td><?= number_format($project->price) ?>円</td>
                        <td><?= date('Y/m/d', strtotime($project->start_date)) ?></td>
                        <td><?= date('Y/m/d', strtotime($project->end_date)) ?></td>
                        <td class="actions">
                          <?= $this->Html->link(__('詳細'), ['action' => 'edit', $project->id]) ?>
                          <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $project->id],['confirm' => __('プロジェクト{0}を削除してもよろしいですか？', $project->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

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
