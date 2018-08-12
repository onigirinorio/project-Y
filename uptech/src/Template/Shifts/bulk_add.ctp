<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="shifts form large-9 medium-8 columns content">
    <?= $this->Form->create('null', ['type' => 'get', 'url' => ['controller' => 'shifts', 'action' => 'bulkAdd']]) ?>
    <h3 class="h3_responsive"><?= __('シフト一括登録') ?></h3>

    <ul>
        <li>
            <label class="col-md-2 col-sm-2 col-xs-12 form_label">ユーザー</label>
            <div class="col-md-10 col-sm-10 col-xs-12 form_radio">
                <?= $user_name ?>
                <?=
                $this->Form->hidden('user_id',
                    [
                        'value' => $user_id,
                    ]
                );
                ?>
            </div>
        </li>
        <li>
            <label class="col-md-2 col-sm-2 col-xs-12 form_label">登録年月</label>
            <?= $this->Form->year('search_date',
                [
                    'value' => $year,
                    'class' => 'input form_input input_inline',
                    'empty' => '年',
                ]
            ) ?>年
            <?= $this->Form->month('search_date',
                [
                    'monthNames' => false,
                    'value' => $month,
                    'class' => 'input form_input input_inline',
                    'empty' => '月',
                ]
            ) ?>月
        </li>
    </ul>

    <div class="btn_area">
        <?= $this->Form->button('年月選択', ['class' => 'btn btn-primary submit_btn']) ?>
    </div>

    <?= $this->Form->end() ?>

    <? if (isset($last_day)): ?>
        <?= $this->Form->create() ?>
        <div class="table-responsive">
            <table cellpadding="0" cellspacing="0" class="table">
                <thead>
                <tr>
                    <th scope="col">日付</th>
                    <th scope="col">出勤有無</th>
                    <th scope="col">出勤時間</th>
                    <th scope="col">退勤時間</th>
<!--                    <th scope="col">休日出勤フラグ</th>-->
                </tr>
                </thead>
                <tbody>
                <?php for ($i = 1; $i <= $last_day; $i++): ?>
                    <tr>
                        <td>
                            <?= $i ?>日
                        </td>
                        <td>
                            <?=
                            $this->Form->checkbox('shifts_list[' . $i. '][effective]', [
                                'label' => false,
                                'default' => 1,
                            ])
                            ?>
                        </td>
                        <td>
                            <?=
                            $this->Form->time('shifts_list[' . $i. '][attend]',     [
                                'label' => false,
                                'empty' => false,
                                'default' => '10:00',
                            ])
                            ?>
                        </td>
                        <td>
                            <?=
                            $this->Form->time('shifts_list[' . $i. '][clock]',     [
                                'label' => false,
                                'empty' => false,
                                'default' => '19:00',
                            ])
                            ?>
                        </td>
<!--                        <td>a</td>-->
                    </tr>
                <?php endfor; ?>
                </tbody>
            </table>
            <div class="btn_area">
                <?= $this->Form->button('一括登録', ['class' => 'btn btn-primary submit_btn']) ?>
            </div>
        </div>
        <?= $this->Form->end() ?>
    <? endif; ?>
</div>
