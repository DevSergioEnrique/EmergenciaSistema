<?php
    getHeader();
?>

<link rel="stylesheet" <?php echo 'href="' . APP_URL . '/assets/css/pages/registro_emergencia.css"'; ?>>

<div class="dash-content">
    <div class="activity">
        <div class="title">
            <i class="uil uil-file-search-alt"></i>
            <span class="text">Resumen de pacientes</span>
        </div>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex align-items-center gap-2">
                    <i class="fas fa-clipboard-list"></i>
                    Resumen de Pacientes
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-5" id="pacientes-table">
                            <thead>
                                <tr>
                                    <th>Documento</th>
                                    <th>Número</th>
                                    <th>Paciente</th>
                                    <th>Médico</th>
                                    <th>Diagnóstico</th>
                                    <th>Usuario</th>
                                    <th>Registro</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Los datos se cargarán mediante AJAX -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hidden iframe for print target -->
<iframe name="printIframe" style="display:none;"></iframe>

</section>

<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<!-- jQuery (asegurarse de que solo se carga una vez) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Estilos adicionales para que coincida con la imagen de referencia -->

<script>
    $(document).ready(function() {
        // Cargamos los datos con AJAX
        fetchDataAndInitTable();
    });
    
    // Función para obtener los datos de la API y llenar la tabla
    async function fetchDataAndInitTable() {
        try {
            const response = await fetch('<?= APP_URL ?>/api/getPaciente');
            const data = await response.json();
            
            // Inicializamos la tabla con los datos obtenidos
            const dataTable = $('#pacientes-table').DataTable({
                data: data,
                columns: [
                    { 
                        data: 'Documento',
                        render: function(data) {
                            return `<span class="document-badge">${data}</span>`;
                        }
                    },
                    { data: 'Nro' },
                    { data: 'Paciente' },
                    { data: 'Medico' },
                    { 
                        data: 'DescripcionDiagnostico',
                        render: function(data) {
                            let className = '';
                            
                            if (data.toLowerCase().includes('asma')) {
                                className = 'asma';
                            } else if (data.toLowerCase().includes('diabetes')) {
                                className = 'diabetes';
                            } else if (data.toLowerCase().includes('hipertension')) {
                                className = 'hipertension';
                            }
                            
                            return `<span class="diagnosis-badge ${className}">${data}</span>`;
                        }
                    },
                    { data: 'Usuario' },
                    { 
                        data: 'FechaHora',
                        render: function(data) {
                            return `<div class="timestamp"><i class="fas fa-calendar-alt"></i> ${data}</div>`;
                        }
                    },
                    { 
                        data: 'IdTriajeEmergencia',
                        render: function(data) {
                            return `
                                <div class="d-flex gap-2">
                                    <a href="<?= APP_URL ?>/pacientes/editar/${data}" class="action-btn" data-bs-toggle="tooltip" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="action-btn print-btn" data-id="${data}" data-bs-toggle="tooltip" title="Imprimir">
                                        <i class="fas fa-print"></i>
                                    </button>
                                </div>
                            `;
                        },
                        orderable: false
                    }
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                    paginate: {
                        previous: 'Anterior',
                        next: 'Siguiente'
                    }
                },
                responsive: true,
                lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]],
                pageLength: 5,
                order: [[6, 'desc']], // Ordenar por fecha de registro (descendente)
                dom: '<"d-flex justify-content-between align-items-center mb-3"lf>rt<"d-flex justify-content-between align-items-center mt-3"ip>',
                initComplete: function() {
                    // Inicializamos los tooltips después de que la tabla esté lista
                    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                        return new bootstrap.Tooltip(tooltipTriggerEl);
                    });
                    
                    // Añadimos el manejador para los botones de impresión
                    $('.print-btn').click(function() {
                        const idPaciente = $(this).data('id');
                        
                        var form = document.createElement('form');
                        form.setAttribute('target', 'printIframe');
                        form.setAttribute('action', '<?= APP_URL ?>/includes/_reimprimir_pdf.php');
                        form.setAttribute('method', 'post');
                        
                        var input = document.createElement('input');
                        input.setAttribute('type', 'hidden');
                        input.setAttribute('name', 'id_paciente');
                        input.setAttribute('value', idPaciente);
                        
                        form.appendChild(input);
                        document.body.appendChild(form);
                        form.submit();
                        
                        // Esperamos a que el PDF se cargue en el iframe
                        const iframe = document.getElementsByName('printIframe')[0];
                        iframe.onload = function() {
                            iframe.contentWindow.print();
                        };
                        
                        document.body.removeChild(form);
                    });
                    
                    // Personalizamos el estilo del paginador para que coincida con la imagen de referencia
                    $('.dataTables_paginate .paginate_button').addClass('page-item');
                    $('.dataTables_paginate .paginate_button a').addClass('page-link');
                    $('.dataTables_paginate .paginate_button.current').addClass('active');
                }
            });
            
        } catch (error) {
            console.error('Error al obtener los datos:', error);
        }
    }
</script>