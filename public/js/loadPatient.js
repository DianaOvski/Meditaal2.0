function cargarPacientes() {
    $.ajax({
        url: "../controllers/patientController.php?op=listarPacientes",
        type: "GET",
        dataType: "json",
        success: function(response) {
            // Verificar si la respuesta contiene un error
            if (response.error) {
                console.error("Error: " + response.error);
                alert("Hubo un error al obtener los pacientes.");
            } else {
                if (response.length > 0) {
                    var tbody = $(".styled-table tbody");
                    tbody.empty(); // Limpiar la tabla antes de agregar nuevos pacientes
                    response.forEach(function(patient) {
                        var row = `<tr>
                            <td data-label="Nombres">${patient.Nombres}</td>
                            <td data-label="Apellidos">${patient.Apellidos}</td>
                            <td data-label="Tipo de Documento">${patient.Tipo_identificacion}</td>
                            <td data-label="Número de Documento">${patient.Documento}</td>
                            <td data-label="Teléfono">${patient.Telefono}</td>
                            <td data-label="Editar">
                                <button class="btn-edit" title="Editar"><i class="ri-pencil-line"></i></button>
                            </td>
                            <td data-label="Eliminar">
                                <button class="btn-delete" title="Eliminar" onclick="eliminarPaciente(${patient.Documento})">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </td>
                        </tr>`;
                        tbody.append(row);
                    });
                } else {
                    alert("No se encontraron pacientes.");
                }
            }
        },
        error: function(xhr, status, error) {
            console.error("Error al cargar los pacientes: " + error);
            alert("Hubo un error al cargar los pacientes.");
        }
    });
}

$(document).ready(function() {
    cargarPacientes();  // Cargar pacientes cuando la página esté lista
});
