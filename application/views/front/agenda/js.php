
<script src='<?=base_url()?>assets_front/calendar/lib/main.js'></script>
<script src='<?=base_url()?>assets_front/calendar/js/theme-chooser.js'></script>
<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar;

    initThemeChooser({

      init: function(themeSystem) {
        calendar = new FullCalendar.Calendar(calendarEl, {
          themeSystem: themeSystem,
          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
          },
          initialDate: '<?=date('Y-m-d')?>',
          locale : 'id',
          weekNumbers: true,
          navLinks: true, // can click day/week names to navigate views
          editable: false,
          selectable: true,
          nowIndicator: true,
          dayMaxEvents: true, // allow "more" link when too many events
          // showNonCurrentDates: false,
          events: [
            <?php foreach ($agenda as $key => $value) { ?>
                { 
                  title: '<?=$value->judul?>',
                  url: '<?=base_url('home/detail_agenda/'.encode_id($value->id_event))?>',
                  start: '<?=$value->start?>',
                  end: '<?=$value->end?>',
                },
            <?php } ?>
          ]
        });
        calendar.render();
      },

      change: function(themeSystem) {
        calendar.setOption('themeSystem', themeSystem);
      }

    });

  });

</script>