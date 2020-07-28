<?php
session_start();
include_once("conexao_cad.php");

$pega = $_SESSION['usuario'];
$result_events = "SELECT id, title, color, start, end FROM " .$pega;
$resultado = mysqli_query($conexao_cad, $result_events);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<link href='css/main.min.css' rel='stylesheet' />
<link href='css/agenda.css' rel='stylesheet' />
<script src='js/main.min.js'></script>
<script src='js/pt-br.js'></script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>

  document.addEventListener('DOMContentLoaded', function() {

    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      locale: 'pt-br', 
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },

      initialDate: new Date(),
      navLinks: true, // can click day/week names to navigate views
      selectable: true,
      selectMirror: true,
      // select: function(arg) {
      //   var title = prompt('vc deseja add algo?');
      //   if (title) {
      //     calendar.addEvent({
      //       title: title,
      //       start: arg.start,
      //       end: arg.end,
      //       allDay: arg.allDay
      //     })
      //   }
      //   calendar.unselect()
     
          
      // },
      select: function(start, end) {
            //alert('Início do evento: ' + info.start.toLocaleString());
            // $('#cadastrar #start').val(info.start.toLocaleString());
            // $('#cadastrar #end').val(info.end.toLocaleString());
            $('#cadastrar').modal('show');
            // $('#cadastrar').dataToggle('modal');
            // $('#cadastrar').dataTarget('myModal');
        },
      eventClick: function(arg) {
        // if (confirm('Are you sure you want to delete this event?')) {
        //   arg.event.remove()
        // }
        $('#cadastrar').modal('show');
      },
      editable: true,
      dayMaxEvents: true, // allow "more" link when too many events
      events: [
        <?php
          while($row = mysqli_fetch_array($resultado)){
            ?>
          {
            id: '<?php echo $row['id']; ?>',
            title: '<?php echo $row['title']; ?>',
            color: '<?php echo $row['color']; ?>',
            start: '<?php echo $row['start']; ?>',
            end: '<?php echo $row['end']; ?>',
          },
            <?php
          }    
        ?>

      ]
    });

    calendar.render();
  });

</script>
        
</head>
<body>

  <div id='calendar'></div>

              <div class="modal fade" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      ...
                    </div>
                  </div>
                </div>
              </div>
</body>
</html>


