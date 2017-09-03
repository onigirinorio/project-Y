<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="container">
    <?= $this->Form->create($user,[
            'class' => 'form-horizontal'
    ]) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->control('name',
                [

                    'label' => '名前',
                    'class' => 'form-control'
                ]
            );
            echo $this->Form->control('name_kana',
                [
                    'label' => '名前（カナ）',
                    'class' => 'form-control'
                ]
            );
            echo $this->Form->control('password',
                [
                    'label' => 'パスワード',
                    'class' => 'form-control'
                ]
            );
            echo $this->Form->control('email',
                [
                    'label' => 'メールアドレス',
                    'class' => 'form-control'
                ]
            );
            echo $this->Form->control('tell',
                [
                    'label' => '電話番号',
                    'class' => 'form-control'
                ]
            );
            echo $this->Form->control('gendar',
                [
                    'label' => '性別',
                    'type' =>'radio',
                    'class' => 'form-control',
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
                        'class' => 'form-control'
                ]
            );
            echo $this->Form->control('zip_code',
                [
                        'label' => '郵便番号',
                        'class' => 'form-control'
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
                    ],
                    'class' => 'form-control'
                ]
            );
            echo $this->Form->control('address',
                [
                    'label' => '都道府県以降',
                    'class' => 'form-control'
                ]
            );
            echo $this->Form->control('address2',
                [
                    'label' => '建物名',
                    'class' => 'form-control'
                ]
            );
            // echo $this->Form->control('work_id', ['options' => $works, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'),[
            'text' => '登録',
            'class' => 'btn btn-default'
    ]) ?>
    <?= $this->Form->end() ?>
</div>
