function DataHora(evento, objeto) {
    var keypress = (window.event) ? event.keyCode : evento.which;
    campo = eval(objeto);
    if (campo.value == '00/00/0000 00:00:00') {
        campo.value = "";
    }

    caracteres = '0123456789';
    separacao1 = '/';
    separacao2 = ' ';
    separacao3 = ':';
    conjunto1 = 2;
    conjunto2 = 5;
    conjunto3 = 10;
    conjunto4 = 13;
    conjunto5 = 16;
    if ((caracteres.search(String.fromCharCode(keypress)) != -1) && campo.value.length < (19)) {
        if (campo.value.length == conjunto1)
            campo.value = campo.value + separacao1;
        else if (campo.value.length == conjunto2)
            campo.value = campo.value + separacao1;
        else if (campo.value.length == conjunto3)
            campo.value = campo.value + separacao2;
        else if (campo.value.length == conjunto4)
            campo.value = campo.value + separacao3;
        else if (campo.value.length == conjunto5)
            campo.value = campo.value + separacao3;
    } else {
        event.returnValue = false;
    }
}

function cad(event){
    event.preventDefault();
    

    var titulo = $('#title').val();
    var cor = $("#color").val();

    if ( titulo != "" ){
        if ( cor != ""){


                document.getElementById("addevent").submit()
                // header('Location: cad_event.php');

            // $.ajax({
            //     url: "test.html"
            //     // title: $('#title').val(),
            //     // color: $("#color").val(),
            //     // start: $("#start").val(),
            //     // end: $("#end").val(),
            //     // contentType: false,
            //     // processData: false,
            //     // success: function (retorna) {
            //     //     if (retorna['sit']) {
            //     //         //$("#msg-cad").html(retorna['msg']);
            //     //         location.reload();
            //     //     } else {
            //     //         $("#msg-cad").html(retorna['msg']);
            //     //     }
            //     // }
            // })

            // var posting = $.post({
            //     method: "POST",
            //     url: "cad_event.php",
            //     title: $('#title').val(),
            //     color: $("#color").val(),
            //     start: $("#start").val(),
            //     end: $("#end").val()
            // });

            // posting.done(function() {
            //     // location.reload();
            //     alert("Deu certo!!")
            // });

            // posting.fail(function() {
            //     $('#result').text('failed');
            // });
        } else {
            event.preventDefault();
        }
    } else {
        event.preventDefault();
    }
}

// $(document).ready( function() {
//     $('#addevent').on('submit', function(event) {
//         event.preventDefault();
//         $.ajax({
//             method: "POST",
//             url: "cad_event.php",
//             data: new FormData(this),
//             contentType: false,
//             processData: false,
//             success: function (retorna) {
//                 if (retorna['sit']) {
//                     //$("#msg-cad").html(retorna['msg']);
//                     location.reload();
//                 } else {
//                     $("#msg-cad").html(retorna['msg']);
//                 }
//             }
//         })
//     });
