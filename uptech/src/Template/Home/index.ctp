<?= $this->Html->css('fullcalendar.min.css', ['inline' => false, 'block' => 'css']);?>
<?= $this->Html->script('moment.min.js', ['inline' => false, 'block' => 'script']);?>
<?= $this->Html->script('fullcalendar.min.js', ['inline' => false, 'block' => 'script']);?>
<div class="container">
    <div id='calendar'></div>
</div>
<script>
    $(document).ready(function() {

        $('#calendar').fullCalendar({
            defaultDate: '<?= date('Y-m-d H:i:s')?>',
            // 月名称
            monthNames: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
            // 月略称
            monthNamesShort: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
            // 曜日名称
            dayNames: ['日曜日', '月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '土曜日'],
            // 曜日略称
            dayNamesShort: ['日', '月', '火', '水', '木', '金', '土'],
        });
    });
</script>