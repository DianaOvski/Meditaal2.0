<!doctype html>
<html lang="en">
    <head>
        <title>Agenda Paciente</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        
        <!-- Bootstrap CSS v5.2.1 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales-all.js"></script>  <!--Hacer Pruebas y ver si funciona sin este  -->
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/locales-all.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/main.css" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <style>
            /* Estilo para las celdas del calendario */
            .fc-daygrid-day {
                /*height: 120px;  Aumenta la altura de las celdas para dar más espacio */
                 width: 100px;  /* Ajusta este valor para hacerlo más ancho o más estrecho */
                padding: 5px;  /* Agrega un poco de espacio interno */
            }

            /* Estilo para los eventos en el calendario */
            .fc-event {
                font-size: 12px;  /* Ajusta el tamaño de la fuente */
                white-space: normal;  /* Permite que el texto se ajuste a varias líneas */
                overflow: visible;  /* Asegúrate de que el evento no se corte */
            }

            /* Estilo adicional para los eventos (si deseas cambiar más cosas) */
            .fc-event-title {
                font-weight: bold;
            }

            .event-content {
                font-size: 12px;  /* Ajusta el tamaño de fuente */
                color: black;  /* Cambia el color del texto */
                padding: 5px;  /* Añade un poco de espacio dentro del evento */
                background-color: lightgray;  /* Puedes cambiar el color de fondo */
                border-radius: 3px;  /* Redondear los bordes */
            }
            .highlighted-day {
                background-color: blue !important;
            }
            .cancelado {
                background-color: red !important;
            }
            .atendido {
                background-color: #003366 !important;
            }
            .fallo {
                background-color: gray !important;
            }
            .agendado {
                background-color: lightblue !important;
            }
        </style>
    </head>

    <body>
        <div class="container mt-4">
            <!-- <div class="col-md-8 offset-md-2"> -->
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
                                    <option value="" disabled selected>Seleccione un paciente</option> <!-- Primer espacio vacío -->
                                    <!-- Pacientes Activos aquí -->
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="hora" class="form-label">Hora</label>
                                <input type="time" id="hora" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="doctor" class="form-label">Doctor</label>
                                <select id="doctor" class="form-select">
                                    <!-- Doctores aquí -->
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <select id="estado" class="form-select">
                                    <option value="">Seleccione estado</option>
                                    <option value="Agendado">Agendado</option>
                                    <option value="Atendido">Atendido</option>
                                    <option value="Cancelado">Cancelado</option>
                                    <option value="Fallo">Fallo</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cancelar</button> <!-- Botón de Cancelar -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            let selectedDate = ''; // Variable global para almacenar la fecha seleccionada

            document.addEventListener("DOMContentLoaded", function () {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    locale: 'es',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
events: function(info, successCallback, failureCallback) {
    fetch('../controllers/agendaController.php')
        .then(response => response.json())
        .then(data => {
            console.log("Eventos recibidos:", data);

            if (!Array.isArray(data)) {
                throw new Error("La respuesta no es un array.");
            }

            const events = data.map(event => {
                console.log("Start:", event.start);  // Verifico que sea tipo "2025-09-17T13:00:00"

                return {
                    id: event.id,
                    title: event.title,
                    start: event.start,  //  Convertir a Date
                    color: event.color || 'lightblue',
                    extendedProps: {
                        estado: event.estado,
                        doctor: event.doctor,
                        doctor_id: event.doctor_id,
                        paciente_documento: event.paciente_documento
                    }
                };
            });

            successCallback(events);
        })
        .catch(error => {
            console.error('Error al cargar los eventos:', error);
            failureCallback(error);
        });
},
                    dateClick: function (info) {
                        selectedDate = info.dateStr; // Asigna la fecha seleccionada
                        loadPatients(selectedDate);
                        loadDoctors();
                        // Mostrar modal
                        var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
                        myModal.show();
                    },
                    eventContent: function(info) {
                        // Personalizar el contenido del evento
                        let patientName = info.event.title; // Nombre del paciente
                        let eventTime = info.event.start.toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'}); // Hora del evento
                        let patientAndTime = `${patientName} - ${eventTime}`; // Nombre del paciente + hora

                        return { html: `<div class="event-content">${patientAndTime}</div>` }; // El HTML que quieres mostrar
                    },

eventClick: function(info) {
    const event = info.event;
    console.log(event.extendedProps); 

    const myModal = new bootstrap.Modal(document.getElementById('exampleModal'));

    // Cambiar el título del modal a "Actualizar Agendamiento"
    document.getElementById("exampleModalLabel").textContent = "Actualizar Agendamiento";

    // Llenar los campos del modal con la información del evento
 Promise.all([loadPatients(), loadDoctors()])
        .then(() => {
            document.getElementById("paciente").value = event.extendedProps.paciente_documento;
            document.getElementById("hora").value = event.start.toISOString().substring(11, 16); // hh:mm
            document.getElementById("doctor").value = event.extendedProps.doctor_id;
            document.getElementById("estado").value = event.extendedProps.estado;

            document.getElementById("exampleModalLabel").textContent = "Actualizar Agendamiento";
            myModal.show();
        });

    // Mostrar modal para editar
    // var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
    // myModal.show();

    // Añadir lógica para la actualización o eliminación de la cita
    document.getElementById('agendarForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const paciente = document.getElementById("paciente").value;
        const hora = document.getElementById("hora").value;
        const estado = document.getElementById("estado").value;

        // Verificar que todos los campos estén llenos
        if (!paciente || !hora || !estado) {
            Swal.fire('Error', 'Por favor complete todos los campos', 'error');
            return;
        }

        // Enviar la actualización de los datos al servidor (actualizar la cita)
        fetch('../controllers/agendaController.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                action: 'update',
                paciente_nombre: paciente,
                hora: hora,
                estado: estado,
                event_id: event.id  // El ID del evento para actualizar
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire('Éxito', 'Cita actualizada con éxito', 'success');
                myModal.hide();  // Cierra el modal
                calendar.refetchEvents();  // Refresca los eventos en el calendario
            } else {
                Swal.fire('Error', data.message, 'error');
            }
        });
    });

    // Eliminar la cita
    const modalFooter = document.querySelector('.modal-footer');
    
    // Verifico si el botón de eliminar ya está presente
    const deleteButton = modalFooter.querySelector('.btn-danger');
    if (!deleteButton) {
        const deleteButton = document.createElement("button");
        deleteButton.classList.add("btn", "btn-danger");
        deleteButton.textContent = "Eliminar cita";
        deleteButton.addEventListener("click", function () {
            // Enviar la solicitud de eliminación
            fetch('../controllers/agendaController.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'delete',
                    event_id: event.id  // El ID del evento para eliminar
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Éxito', 'Cita eliminada con éxito', 'success');
                    myModal.hide();  // Cierra el modal
                    calendar.refetchEvents();  // Refresca el calendario
                } else {
                    Swal.fire('Error', data.message, 'error');
                }
            });
        });

        // Añadir el botón de eliminar al modal
        modalFooter.appendChild(deleteButton);
    }
}



                });
                calendar.render();
            });

            // Cargar pacientes activos
            function loadPatients(date) {
               return  fetch('../controllers/patientController.php?op=listarPacientes') // Cambia la ruta por la de tu controlador
                    .then(response => response.json())
                    .then(data => {
                        const pacienteSelect = document.getElementById("paciente");
                        pacienteSelect.innerHTML = ''; // Limpiar las opciones previas
                        const defaultOption = document.createElement("option");
                        defaultOption.value = "";
                        defaultOption.disabled = true;
                        defaultOption.selected = true;
                        defaultOption.textContent = "Seleccione un paciente";
                        pacienteSelect.appendChild(defaultOption);

                        data.forEach(patient => {
                            const option = document.createElement("option");
                            option.value = patient.Documento;
                            option.textContent = `${patient.Nombres} ${patient.Apellidos}`;
                            pacienteSelect.appendChild(option);
                        });
                    });
            }

            // Cargar doctores
                function loadDoctors() {
                  return  fetch('../controllers/doctorController.php?op=listarDoctores')
                        .then(response => response.json())
                        .then(data => {
                            const doctorSelect = document.getElementById("doctor");
                            doctorSelect.innerHTML = '';  // Limpiar las opciones previas
                            const defaultOption = document.createElement("option");
                            defaultOption.value = "";
                            defaultOption.disabled = true;
                            defaultOption.selected = true;
                            defaultOption.textContent = "Seleccione un doctor";
                            doctorSelect.appendChild(defaultOption);

                            data.forEach(doctor => {
                                const option = document.createElement("option");
                                option.value = doctor.id;
                                option.textContent = `${doctor.name} ${doctor.lastName}`;
                                doctorSelect.appendChild(option);
                            });
                        });
                }

            // Enviar los datos al guardar
            document.getElementById('agendarForm').addEventListener('submit', function (e) {
                e.preventDefault();
                const paciente = document.getElementById("paciente").value;
                const hora = document.getElementById("hora").value;
                const doctor = document.getElementById("doctor").value;
                const estado = document.getElementById("estado").value;

                if (!paciente || !hora || !doctor || !estado) {
                    Swal.fire('Error', 'Por favor complete todos los campos', 'error');
                    return;
                }

                // Aquí envías el formulario para guardarlo
                fetch('../controllers/agendaController.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        paciente_nombre: paciente,
                        hora: hora,
                        doctor: doctor,
                        estado: estado,
                        fecha_agenda: selectedDate
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data); 
                    if (data.success) {
                        Swal.fire('Éxito', data.message, 'success').then(() => {
                            var myModal = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
                            myModal.hide();
                            location.reload(); 
                        });
                    } else {
                        Swal.fire('Error', data.message, 'error');
                    }
                });
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    </body>
</html>
