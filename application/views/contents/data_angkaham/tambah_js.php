<script>
	$('.select2').select2();

    $("#propinsi").change(function(){
           var id_provinces = $(this).val(); 
           $.ajax({
              type: "POST",
              dataType: "html",
              url: "<?php echo base_url('data_lembaga/getkab')?>",
              data: "idprop="+id_provinces,
              success: function(msg){
                 $("select#kabkota").html(msg);                                                  
              }
           });                    
         });  
</script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
       $('#datetimepicker6').datetimepicker();
       $('#datetimepicker7').datetimepicker({
   useCurrent: false //Important! See issue #1075
   });
       $("#datetimepicker6").on("dp.change", function (e) {
           $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
       });
       $("#datetimepicker7").on("dp.change", function (e) {
           $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
       });
</script>