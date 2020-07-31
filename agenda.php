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
<script src='js/agenda.js'></script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>

  var id = 0;
  var titulo = "";
  var dia = "";
  var inicio = "";
  var fim = "";

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

      select: function(info) {
            $('#cadastrar #start').val(info.start.toLocaleString());
            $('#cadastrar #end').val(info.end.toLocaleString());
            $('#cadastrar').modal('show');
            // $('#cadastrar').dataToggle('modal');
            // $('#cadastrar').dataTarget('myModal');
        },
      eventClick: function(arg){

        voltar(this);

        var selec = arg.event.startStr;
        var selec_end = arg.event.endStr;

        dia = selec.substring(0, selec.indexOf("T"));

        inicio = selec.substring((selec.indexOf("T") + 1), (selec.indexOf("T") + 9));

        if (fim == "" || fim == 0){

          fim = "00:00:00";

        } else {
         
          fim = selec_end.substring((selec_end.indexOf("T") + 1), (selec_end.indexOf("T") + 9));

        }

        id = arg.event.id;

        titulo = arg.event.title;

        $(".row #id").html(id);
        $(".row #title").html(titulo);
        $(".row #start").html(inicio);
        $(".row #end").html(fim);

        $("#editevent #id").val(id);
        $("#editevent #title").val(titulo);

        selec = selec.replace("T", " ");
        
        var ano = selec.substring(0, 4);
        var mes = selec.substring(5, 7);
        var dia = selec.substring(8, 10);

        selec = dia + "/" + mes + "/" + ano + " " + inicio;
        $("#editevent #start").val(selec);

        if (selec_end == "" || selec_end == 0){

          dia = parseInt(dia);
          dia++;
          if (mes == "01" && dia == 32 || mes == "03" && dia == 32 || mes == "05" && dia == 32 || mes == "07" && dia == 32 || mes == "08" && dia == 32 || mes == "10" && dia == 32 || mes == "12" && dia == 32){
            dia = 01;
            dia = "0" + dia.toString();
            mes = parseInt(mes);
            mes++;
            if (mes == 13){
              mes = 01;
              mes = "0" + mes.toString();
              ano = parseInt(ano);
              ano++;
              ano = ano.toString();
            }
          } else if (mes == "02" && dia == 31 || mes == "04" && dia == 31 || mes == "06" && dia == 31 || mes == "09" && dia == 31 || mes == "11" && dia == 31){
            dia = 01;
            dia = "0" + dia.toString();
            mes = parseInt(mes);
            mes++;
            if (mes == 13){
              mes = 01;
              mes = "0" + mes.toString();
              ano = parseInt(ano);
              ano++;
              ano = ano.toString();
            }

          } else {
            dia = "0" + dia.toString();
          }

        } else {
          var ano_fim = selec.substring(0, 4);
          var mes_fim = selec.substring(5, 7);
          var dia_fim = selec.substring(8, 10);

          selec_end = dia_fim + "/" + mes_fim + "/" + ano_fim + " " + fim;
        }

        if (fim == "00:00:00"){
          selec_end = dia + "/" + mes + "/" + ano + " 00:00:00";
          $("#editevent #end").val(selec_end);
        } else {
          selec_end = dia_fim + "/" + mes_fim + "/" + ano_fim + " " + fim;
        }

        

        $('#visualizar').modal('show');

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
                      <h5 class="modal-title" id="exampleModalLabel">Cadastrar Evento</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <span id="msg-cad"></span>
                        <form id="addevent" method="POST" action="cad_event.php" onsubmit="cad(event)">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Título</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Título do evento">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Color</label>
                                <div class="col-sm-10">
                                    <select name="color" class="form-control" id="color">
                                        <option value="">Selecione</option>         
                                        <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                                        <option style="color:#0071c5;" value="#0071c5">Azul Turquesa</option>
                                        <option style="color:#FF4500;" value="#FF4500">Laranja</option>
                                        <option style="color:#8B4513;" value="#8B4513">Marrom</option>  
                                        <option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
                                        <option style="color:#436EEE;" value="#436EEE">Royal Blue</option>
                                        <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                                        <option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>
                                        <option style="color:#228B22;" value="#228B22">Verde</option>
                                        <option style="color:#8B0000;" value="#8B0000">Vermelho</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Início do evento</label>
                                <div class="col-sm-10">
                                    <input type="text" name="start" class="form-control" id="start" placeholder="dd/mm/aaaa hh:mm:ss" onkeypress="DataHora(event, this)">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Final do evento</label>
                                <div class="col-sm-10">
                                    <input type="text" name="end" class="form-control" id="end" placeholder="dd/mm/aaaa hh:mm:ss" onkeypress="DataHora(event, this)">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" name="CadEvent" id="CadEvent" value="CadEvent" class="btn btn-success">Cadastrar</button>                                    
                                </div>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detalhes do Evento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="visevent">
                            <dl class="row">
                                <dt class="col-sm-3">ID do evento</dt>
                                <dd class="col-sm-9" id="id"></dd>

                                <dt class="col-sm-3">Título do evento</dt>
                                <dd class="col-sm-9" id="title"></dd>

                                <dt class="col-sm-3">Início do evento</dt>
                                <dd class="col-sm-9" id="start"></dd>

                                <dt class="col-sm-3">Fim do evento</dt>
                                <dd class="col-sm-9" id="end"></dd>
                            </dl>
                            <button class="btn btn-warning btn-canc-vis" onclick="editar(this)">Editar</button>
                            <a href="apagar_event.php" id="apagar_evento" class="btn btn-danger">Apagar</a>
                        </div>
                        <div class="formedit" style="display: none;">
                            <span id="msg-edit"></span>
                            <form id="editevent" method="POST" enctype="multipart/form-data" action="edit_event.php" onsubmit="edit(event)">
                                <input type="hidden" name="id" id="id" >
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Título</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="title" class="form-control" id="titulo" placeholder="Título do evento">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Color</label>
                                    <div class="col-sm-10">
                                        <select name="color" class="form-control" id="cor">
                                            <option value="">Selecione</option>         
                                            <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                                            <option style="color:#0071c5;" value="#0071c5">Azul Turquesa</option>
                                            <option style="color:#FF4500;" value="#FF4500">Laranja</option>
                                            <option style="color:#8B4513;" value="#8B4513">Marrom</option>  
                                            <option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
                                            <option style="color:#436EEE;" value="#436EEE">Royal Blue</option>
                                            <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                                            <option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>
                                            <option style="color:#228B22;" value="#228B22">Verde</option>
                                            <option style="color:#8B0000;" value="#8B0000">Vermelho</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Início do evento</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="start" class="form-control" id="start" onkeypress="DataHora(event, this)">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Final do evento</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="end" class="form-control" id="end"  onkeypress="DataHora(event, this)">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="button" class="btn btn-primary btn-canc-edit" onclick="voltar(this)">Cancelar</button>
                                        <button type="submit" name="EditEvent" id="EditEvent" value="EditEvent" class="btn btn-warning">Salvar</button>                                    
                                    </div>
                                </div>
                            </form>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>