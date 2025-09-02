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

<script>
   function addUpload() {
       const imageUploads = document.getElementById('imageUploads');

       const newDiv = document.createElement('div');
       newDiv.className = 'col-md-10';

       const input = document.createElement('input');
       input.type = 'file';
       input.className = 'form-control';
       input.name = 'poster[]';
       input.multiple = true;

       const deleteBtn = document.createElement('button');
       deleteBtn.textContent = 'Hapus';
       deleteBtn.classList.add("btn");
       deleteBtn.classList.add("btn-danger");
       deleteBtn.classList.add("mt-3");
       deleteBtn.onclick = function () {
           imageUploads.removeChild(newDiv);
       };

       newDiv.appendChild(input);
       newDiv.appendChild(deleteBtn);
       imageUploads.appendChild(newDiv);
   }


</script>