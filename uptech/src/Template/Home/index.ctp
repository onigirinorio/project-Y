<?= $this->Html->css('fullcalendar.min.css', ['inline' => false, 'block' => 'css']);?>
<?= $this->Html->script('moment.min.js', ['inline' => false, 'block' => 'script']);?>
<?= $this->Html->script('fullcalendar.min.js', ['inline' => false, 'block' => 'script']);?>
<?= $this->Html->script('calendar.js', ['inline' => false, 'block' => 'script']);?>

<div class="container">
    <div id='calendar'></div>
</div>
<script>
    $(document).ready(function() {
        // 引数がPHPの値を使用するため仮で入れておく。
        showCarendar("<?= date('Y-m-d H:i:s')?>");
    });
</script>
