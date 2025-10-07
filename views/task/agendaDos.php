<!doctype html>
<html lang="es">
<head>
    <title>Agenda Paciente</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- FullCalendar -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/main.css" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/locales-all.js"></script>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .fc-daygrid-day {
            width: 100px;
            padding: 5px;
        }
        .fc-event {
            font-size: 12px;
            white-space: normal;
            overflow: visible;
            border-radius: 5px;
            padding: 3px;
            color: white !important;
            border: none !important;
        }
        .fc-event-title {
            font-weight: bold;
        }
        .event-content {
            font-size: 12px;
            color: white;
            padding: 5px;
            border-radius: 5px;
        }
        .highlighted-day { background-color: blue !important; }

    </style>
</head>

<body>
<div class="container mt-4">
    <div class="col-md-10 offset-md-1">
        <h2 class="text-center mb-4">Agenda de Pacientes</h2>
        <div id="calendar"></div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Agendar Paciente</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="agendarForm">
                    <div class="mb-3">
                        <label for="paciente" class="form-label">Paciente</label>
                        <select id="paciente" class="form-select">
                            <option value="" disabled selected>Seleccione un paciente</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="hora" class="form-label">Hora</label>
                        <input type="time" id="hora" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="doctor" class="form-label">Doctor</label>
                        <select id="doctor" class="form-select"></select>
                    </div>
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <select id="estado" class="form-select">
                            <option value="" disabled selected hidden>Seleccione estado</option>
                            <option value="Agendado">Agendado</option>
                            <option value="Atendido">Atendido</option>
                            <option value="Cancelado">Cancelado</option>
                            <option value="Fallo">Fallo</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
let selectedDate = '';
let isEditMode = false;
let editingEventId = null;

document.addEventListener("DOMContentLoaded", function () {
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: function (info, successCallback, failureCallback) {
            fetch('../controllers/agendaController.php')
                .then(res => res.json())
                .then(data => {
                    const events = data.map(event => ({
                        id: event.id,
                        title: event.title,
                        start: event.start,
                        backgroundColor: event.color,   //  color de fondo
                        borderColor: event.color,       //  color del borde
                        textColor: 'white',             //  color del texto (para contraste)
                        extendedProps: {
                            estado: event.estado,
                            doctor: event.doctor,
                            doctor_id: event.doctor_id,
                            paciente_documento: event.paciente_documento,
                            paciente_nombre: event.title 
                        }
                    }));
                    successCallback(events);
                })
                .catch(error => {
                    console.error('Error al cargar los eventos:', error);
                    failureCallback(error);
                });
        },
        dateClick: function (info) {
            isEditMode = false;
            editingEventId = null;
            selectedDate = info.dateStr;

            document.getElementById("paciente").value = "";
            document.getElementById("hora").value = "";
            document.getElementById("doctor").value = "";
            document.getElementById("estado").value = "";
            document.getElementById("exampleModalLabel").textContent = "Agendar Paciente";

            Promise.all([loadPatients(), loadDoctors()]).then(() => {
                new bootstrap.Modal(document.getElementById('exampleModal')).show();
            });
        },
        eventContent: function (info) {
            const patientName = info.event.title;
            const horaFormateada = info.event.startStr.split("T")[1].substring(0, 5);
            const color = info.event.backgroundColor;

            return { html: `<div class="event-content" style="background-color:${color}; color:white;">
                ${patientName} - ${horaFormateada}
            </div>` };
        },
        eventClick: function (info) {
            isEditMode = true;
            const event = info.event;
            editingEventId = event.id;
            const horaFormateada = event.startStr.split("T")[1].substring(0, 5);
            selectedPacienteNombre = event.extendedProps.paciente_nombre;

            Promise.all([loadPatients(), loadDoctors()]).then(() => {
                // Asignar el valor correcto al paciente (documento) y estado (string exacto)
                document.getElementById("paciente").value = event.extendedProps.paciente_documento || "";
                document.getElementById("hora").value = horaFormateada;
                document.getElementById("doctor").value = event.extendedProps.doctor_id || "";
                document.getElementById("estado").value = event.extendedProps.estado || "";
                document.getElementById("exampleModalLabel").textContent = "Actualizar Agendamiento";

                    const modalEl = document.getElementById('exampleModal');
                    const modal = new bootstrap.Modal(modalEl, {
                        backdrop: 'static',
                        keyboard: false
                    });
                modal.show();

                // Añadir botón de eliminar solo si no existe ya
                const modalFooter = document.querySelector('.modal-footer');
                if (!modalFooter.querySelector('.btn-danger')) {
                    const deleteButton = document.createElement("button");
                    deleteButton.className = "btn btn-danger";
                    deleteButton.textContent = "Eliminar cita";
                    deleteButton.onclick = function () {
                        fetch('../controllers/agendaController.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ action: 'delete', event_id: editingEventId })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire('Éxito', 'Cita eliminada con éxito', 'success').then(() => {
                                    modal.hide();
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Error', data.message, 'error');
                            }
                        });
                    };
                    modalFooter.appendChild(deleteButton);
                }
            });
        }
    });

    calendar.render();

    // Manejo del formulario (crear o actualizar)
    document.getElementById('agendarForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const paciente = document.getElementById("paciente").value;
        const hora = document.getElementById("hora").value;
        const doctor = document.getElementById("doctor").value;
        const estado = document.getElementById("estado").value;

        if (!paciente || !hora || (!isEditMode && !doctor) || !estado || estado === "") {
            Swal.fire('Error', 'Por favor complete todos los campos', 'error');
            return;
        }

        const payload = isEditMode
            ? { action: 'update',
                event_id: editingEventId, 
                paciente_nombre: selectedPacienteNombre,
                hora, 
                estado }
            : { action: 'create',
                 paciente_documento: paciente, 
                 hora, 
                 doctor, 
                 estado, 
                 fecha_agenda: selectedDate 
                };
            
        console.log("Payload enviado:", payload); 
        fetch('../controllers/agendaController.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                Swal.fire('Éxito', data.message, 'success').then(() => {
                    bootstrap.Modal.getInstance(document.getElementById('exampleModal')).hide();
                    location.reload();
                });
            } else {
                Swal.fire('Error', data.message, 'error');
            }
        });
    });
});

function loadPatients() {
    return fetch('../controllers/patientController.php?op=listarPacientes')
        .then(res => res.json())
        .then(data => {
            const pacienteSelect = document.getElementById("paciente");
            pacienteSelect.innerHTML = '<option value="" disabled selected>Seleccione un paciente</option>';
            data.forEach(patient => {
                const option = document.createElement("option");
                option.value = patient.Documento;
                option.textContent = `${patient.Nombres} ${patient.Apellidos}`;
                pacienteSelect.appendChild(option);
            });
        });
}

function loadDoctors() {
    return fetch('../controllers/doctorController.php?op=listarDoctores')
        .then(res => res.json())
        .then(data => {
            const doctorSelect = document.getElementById("doctor");
            doctorSelect.innerHTML = '<option value="" disabled selected>Seleccione un doctor</option>';
            data.forEach(doc => {
                const option = document.createElement("option");
                option.value = doc.id;
                option.textContent = `${doc.name} ${doc.lastName}`;
                doctorSelect.appendChild(option);
            });
        });
}
</script>
</body>
</html>
