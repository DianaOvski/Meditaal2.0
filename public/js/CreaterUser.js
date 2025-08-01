function init() {
    $("#usuarioForm").on("submit", function(e) {
        guardaryeditar(e);
    });
}

function guardaryeditar(e) {
    e.preventDefault(); 
    var formData = new FormData($("#usuarioForm")[0]);
    $.ajax({
        url: "../controllers/userController.php?op=guardaryEditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            if (response.trim() === "success") {  
                Swal.fire({
                    title: "¡Completado!",
                    text: "Se creó el usuario correctamente.",
                    icon: "success",
                    customClass: {
                        confirmButton: "btn-success"
                    }
                });
                document.getElementById("usuarioForm").reset();
            } else {
                Swal.fire({
                    title: "Error",
                    text: "Hubo un problema al guardar los datos. " + response,  
                    icon: "error",
                    customClass: {
                        confirmButton: "btn-danger"
                    }
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({
                title: "Error",
                text: "Hubo un problema con la solicitud. Inténtalo nuevamente.",
                icon: "error",
                confirmButtonClass: "btn-danger"
            });
        }
    });
}

$(document).ready(function() {
    init();  // Llamar la función para inicializar el evento submit
});

