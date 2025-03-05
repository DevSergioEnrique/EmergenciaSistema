<?php
    getHeader();
?>

<style>
    :root {
        --primary-color: #2563eb;
        --primary-hover: #1d4ed8;
        --accent-color: #f59e0b;
        --success-color: #10b981;
        --danger-color: #ef4444;
        --background-light: #f8fafc;
        --border-radius: 12px;
        --transition-speed: 0.3s;
    }

    body {
        background-color: var(--background-light);
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        padding: 1.5rem;
    }

    .card {
        border-radius: var(--border-radius);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        border: none;
        overflow: hidden;
    }

    .card-header {
        background: var(--primary-color);
        color: white;
        padding: 1.5rem;
        font-size: 1.25rem;
        font-weight: 600;
        position: relative;
    }

    .card-header:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color) 0%, var(--accent-color) 100%);
    }

    .btn-outline-primary {
        color: var(--primary-color);
        border-color: var(--primary-color);
        transition: all var(--transition-speed) ease;
    }

    .btn-outline-primary:hover {
        background-color: var(--primary-color);
        color: white;
        transform: translateY(-2px);
    }
    
    .table {
        width: 100%;
        margin-bottom: 0;
    }
    
    .table thead th {
        font-weight: 600;
        color: #1e293b;
        padding: 1rem 0.75rem;
        background-color: #f1f5f9;
        border-bottom: 2px solid #e2e8f0;
    }
    
    .table tbody td {
        vertical-align: middle;
        padding: 1rem 0.75rem;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(37, 99, 235, 0.05);
    }
    
    .diagnosis-badge {
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
    }
    
    .diagnosis-asma {
        background-color: #dbeafe;
        color: #1e40af;
    }
    
    .diagnosis-diabetes {
        background-color: #fef3c7;
        color: #92400e;
    }
    
    .diagnosis-hipertension {
        background-color: #fee2e2;
        color: #b91c1c;
    }
    
    .action-btn {
        width: 36px;
        height: 36px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.2s ease;
    }
    
    .action-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .section-title {
        color: var(--primary-color);
        font-weight: 600;
        margin-bottom: 1.5rem;
        position: relative;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .section-title i {
        font-size: 1.25rem;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: var(--primary-color) !important;
        color: white !important;
        border: 1px solid var(--primary-color) !important;
        border-radius: 6px;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button:not(.current):hover {
        background: #e0e7ff !important;
        color: var(--primary-color) !important;
        border: 1px solid #e0e7ff !important;
    }
    
    .dataTables_wrapper .dataTables_filter input {
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        transition: all 0.3s ease;
    }
    
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        outline: none;
    }
    
    .dataTables_wrapper .dataTables_length select {
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        padding: 0.5rem;
        transition: all 0.3s ease;
    }
    
    .dataTables_wrapper .dataTables_length select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        outline: none;
    }
    
    .dataTables_wrapper .dataTables_info {
        font-size: 0.9rem;
        color: #64748b;
        padding-top: 1rem;
    }
    
    .document-badge {
        display: inline-block;
        padding: 0.35rem 0.75rem;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 500;
        background-color: #f1f5f9;
        color: #475569;
    }
    
    .timestamp {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #64748b;
        font-size: 0.9rem;
    }
    
    .timestamp i {
        font-size: 0.85rem;
    }
    
    .table-responsive {
        overflow-x: auto;
        border-radius: var(--border-radius);
    }
    
    .card-body {
        padding: 1.5rem;
    }
    
    .table-header-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    .btn-add-patient {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.25rem;
        background-color: var(--primary-color);
        color: white;
        border-radius: 8px;
        font-weight: 500;
        transition: all var(--transition-speed) ease;
    }
    
    .btn-add-patient:hover {
        background-color: var(--primary-hover);
        transform: translateY(-2px);
        color: white;
    }
</style>

<div class="dash-content">
    <div class="activity">
        <div class="title">
            <i class="uil uil-file-search-alt"></i>
            <span class="text">Resumen de pacientes</span>
        </div>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex align-items-center gap-2">
                    <!-- <i class="fas fa-user-injured"></i> -->
                    <i class="fas fa-clipboard-list"></i>
                    Resumen de Pacientes
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-5" id="pacientes">
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<iframe name="printIframe" style="display:none;"></iframe>
</section>

<script src="<?= APP_URL ?>/assets/js/pacientes.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    // Función para obtener los datos de la API y llenar la tabla
    async function fetchDataAndFillTable() {
        try {
            const response = await fetch('http://localhost/emergencia/api/getPaciente');
            const data = await response.json();

            const tbody = document.querySelector('#pacientes tbody');

            // Limpiar el contenido actual de la tabla
            tbody.innerHTML = '';

            // Recorrer los datos y crear las filas de la tabla
            data.forEach(paciente => {
                const row = document.createElement('tr');

                row.innerHTML = `
                    <td><span$ class="document-badge">${paciente.TipoDocumento}</span></td>
                    <td>${paciente.NroDocumento}</td>
                    <td>${paciente.Paciente}</td>
                    <td>${paciente.Medico}</td>
                    <td>${paciente.Diagnostico}</td>
                    <td>${paciente.Usuario}</td>
                    <td><div class="timestamp"><i class="fas fa-calendar-alt"></i>${paciente.Fecha_Hora}</div></td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="_update_paciente.php?id_paciente=22" class="btn btn-outline-primary action-btn" data-bs-toggle="tooltip" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-outline-primary action-btn" data-bs-toggle="tooltip" title="Imprimir">
                                <i class="fas fa-print"></i>
                            </button>
                        </div>
                    </td>
                `;

                tbody.appendChild(row);
            });
        } catch (error) {
            console.error('Error al obtener los datos:', error);
        }
    }

    // Llamar a la función para llenar la tabla cuando la página se cargue
    document.addEventListener('DOMContentLoaded', fetchDataAndFillTable);
</script>