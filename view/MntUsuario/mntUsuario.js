var tabla;

function init(){
    $("#usuario_form").on("submit", function(e){
        guardaryeditar(e);
    });
}

$(document).ready(function(){
    tabla = $('#usuario_data').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        "ajax": {
            url: '../../controller/usuario.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e){
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength": 10,
        "order": [[0, "desc"]],
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            }
        }
    }).DataTable();
});

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#usuario_form")[0]);

    $.ajax({
        url: "../../controller/usuario.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){
            $('#usuario_form')[0].reset();
            $("#modalmantenimiento").modal('hide');
            $('#usuario_data').DataTable().ajax.reload();

            Swal.fire(
                'Registro!',
                'El registro se guardó correctamente.',
                'success'
            );
        }
    });
}

function editar(usu_id){
    $("#label_clave").text("");                 // quitar el * de obligatorio
    $("#ayuda_clave").show();                   // mostrar ayuda

    $.post("../../controller/usuario.php?op=mostrar", {usu_id : usu_id}, function(data){
        data = JSON.parse(data);
        $("#usu_id").val(data.usu_id);
        $("#usu_nom").val(data.usu_nom);
        $("#usu_sesion").val(data.usu_sesion);
        $("#usu_clave").val("");                // nunca mostrar la clave
    });

    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $("#mdltitulo").text("Editar Usuario");
    $("#modalmantenimiento").modal("show");
}

function eliminar(usu_id){
    Swal.fire({
        title: "¿Estás seguro?",
        text: "El usuario será eliminado de forma lógica",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminarlo!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("../../controller/usuario.php?op=eliminar", {usu_id : usu_id}, function(data){
                $('#usuario_data').DataTable().ajax.reload();
                Swal.fire("Eliminado!", "El usuario ha sido eliminado.", "success");
            });
        }
    });
}

$(document).on("click", "#btnNuevo", function(){
    $("#usuario_form")[0].reset();
    $("#usu_id").val("");
    $("#label_clave").text("*");                // obligatorio al crear
    $("#ayuda_clave").hide();                   // ocultar ayuda

    $(".modal-header").css("background-color", "#28a745");
    $(".modal-header").css("color", "white");
    $("#mdltitulo").text("Nuevo Registro");
    $("#modalmantenimiento").modal("show");
});

init();