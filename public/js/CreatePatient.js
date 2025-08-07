function init() {
    $("#pacienteForm").on("submit", function(e) {
        guardarPaciente(e);
    });
}

function guardarPaciente(e) {
    e.preventDefault();
    var formData = new FormData($("#pacienteForm")[0]);
    $.ajax({
        url: "../controllers/patientController.php?op=guardarPaciente",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            if (response.trim() === "success") {
                Swal.fire({
                    title: "¡Completado!",
                    text: "Se creó el paciente correctamente.",
                    icon: "success",
                    customClass: {
                        confirmButton: "btn-success"
                    }
                });
                document.getElementById("pacienteForm").reset();
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
    init();  // Inicializamos el evento submit
});
