<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Project[]|\Cake\Collection\CollectionInterface $projects
  */
?>
    <h3 class="h3_responsive"><?= __('案件一覧') ?></h3>
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" class="table">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('shop_name', '案件名') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('client_id', 'クライアント') ?></th>
                    <th scope="col" class="hidden-xs"><?= $this->Paginator->sort('payment_status', '支払区分') ?></th>
                    <th scope="col" class="hidden-xs"><?= $this->Paginator->sort('price', '金額') ?></th>
                    <th scope="col" class="actions"><?= __('詳細') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projects as $project): ?>
                    <tr>
                        <td><?= h($project->shop_name) ?></td>
                        <td>
                            <?= $project->has('client') ? $this->Html->link(h($project->client->client_name), [
                                'controller' => 'Clients',
                                'action' => 'view',
                                $project->client->id]) : '' ?>
                        </td>
                        <td class="hidden-xs">
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
                        <td class="hidden-xs"><?= number_format($project->price) ?>円</td>
                        <td class="actions">
                          <?= $this->Html->link(__('詳細'), ['action' => 'view', $project->id]) ?>
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
