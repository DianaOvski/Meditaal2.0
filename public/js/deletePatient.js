function eliminarPaciente(documento) {
    // Mostrar la alerta de confirmación de SweetAlert2
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esta acción!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Si el usuario confirma, hacer la solicitud AJAX para eliminar el paciente
            $.ajax({
                url: "../controllers/patientController.php?op=eliminarPaciente",
                type: "POST",
                data: { documento: documento },
                success: function(response) {
                    if (response === "success") {
                        Swal.fire(
                            'Eliminado!',
                            'El paciente ha sido eliminado.',
                            'success'
                        );
                        cargarPacientes(); // Recargar la lista de pacientes después de la eliminación
                    } else {
                        Swal.fire(
                            'Error',
                            'Hubo un error al eliminar el paciente.',
                            'error'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error al eliminar paciente: " + error);
                    Swal.fire(
                        'Error',
                        'Hubo un problema con la eliminación.',
                        'error'
                    );
                }
            });
        } else {
            // Si el usuario cancela
            Swal.fire(
                'Cancelado',
                'El paciente no ha sido eliminado.',
                'info'
            );
        }
    });
}
