<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Works'), ['controller' => 'Works', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Work'), ['controller' => 'Works', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->control('name',
                [
                    'label' => '名前'
                ]
            );
            echo $this->Form->control('name_kana',
                [
                    'label' => '名前（カナ）'
                ]
            );
            echo $this->Form->control('password',
                [
                    'label' => 'パスワード'
                ]
            );
            echo $this->Form->control('email',
                [
                    'label' => 'メールアドレス'
                ]
            );
            echo $this->Form->control('tell',
                [
                    'label' => '電話番号'
                ]
            );
            echo $this->Form->control('gendar',
                [
                    'label' => '性別',
                    'type' =>'radio',
                    'options' =>[
                        0 =>'男',
                        1 =>'女'
                    ]
                ]
            );
            echo $this->Form->control('birth',
                [
                        'label' => '生年月日',
                        'empty' => false,
                        'monthNames' => false,
                        'maxYear' => date('Y'),
                        'minYear' => date('Y') - 40,
                ]
            );
            echo $this->Form->control('zip_code',
                [
                        'label' => '郵便番号'
                ]
            );
            echo $this->Form->control('pref',
                [
                    'label' =>'都道府県',
                    'type' => 'select',
                    'options' =>
                    [
                        '北海道' => "北海道",
                        '青森県' => "青森県",
                        '岩手県' => "岩手県",
                        '宮城県' => "宮城県",
                        '秋田県' => "秋田県",
                        '山形県' => "山形県",
                        '福島県' => "福島県",
                        '茨城県' => "茨城県",
                        '栃木県' => "栃木県",
                        '群馬県' => "群馬県",
                        '埼玉県' => "埼玉県",
                        '千葉県' => "千葉県",
                        '東京都' => "東京都",
                        '神奈川県' => "神奈川県",
                        '新潟県' => "新潟県",
                        '富山県' => "富山県",
                        '石川県' => "石川県",
                        '福井県' => "福井県",
                        '山梨県' => "山梨県",
                        '長野県' => "長野県",
                        '岐阜県' => "岐阜県",
                        '静岡県' => "静岡県",
                        '愛知県' => "愛知県",
                        '三重県' => "三重県",
                        '滋賀県' => "滋賀県",
                        '京都府' => "京都府",
                        '大阪府' => "大阪府",
                        '兵庫県' => "兵庫県",
                        '奈良県' => "奈良県",
                        '和歌山県' => "和歌山県",
                        '鳥取県' => "鳥取県",
                        '島根県' => "島根県",
                        '岡山県' => "岡山県",
                        '広島県' => "広島県",
                        '山口県' => "山口県",
                        '徳島県' => "徳島県",
                        '香川県' => "香川県",
                        '愛媛県' => "愛媛県",
                        '高知県' => "高知県",
                        '福岡県' => "福岡県",
                        '佐賀県' => "佐賀県",
                        '長崎県' => "長崎県",
                        '熊本県' => "熊本県",
                        '大分県' => "大分県",
                        '宮崎県' => "宮崎県",
                        '鹿児島県' => "鹿児島県",
                        '沖縄県' => "沖縄県"
                    ]
                ]
            );
            echo $this->Form->control('address',
                [
                    'label' => '都道府県以降'
                ]
            );
            echo $this->Form->control('address2',
                [
                    'label' => '建物名'
                ]
            );
            // echo $this->Form->control('work_id', ['options' => $works, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
