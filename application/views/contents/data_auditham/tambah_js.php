<script>
	$('.select2').select2();
</script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.datetimepicker.full.min.js')?>"></script>

<script type="text/javascript">
       $('#datetimepicker6').datetimepicker({
        format:'Y-m-d H:i'
       });
       $('#datetimepicker7').datetimepicker({
        format:'Y-m-d H:i',
   useCurrent: false //Important! See issue #1075
   });
       $("#datetimepicker6").on("dp.change", function (e) {
           $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
       });
       $("#datetimepicker7").on("dp.change", function (e) {
           $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
       });
</script>