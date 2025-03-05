export async function obtenerDatos(url, selectId, valueKey, textKey) {
    try {
        const response = await fetch(url);
        if (!response.ok) throw new Error("Error en la solicitud.");

        const data = await response.json();
        llenarSelect(data, selectId, valueKey, textKey);
    } catch (error) {
        console.error("Error:", error);
    }
}

export async function obtenerDatosSelect2(url, selectId, valueKey, textKey) {
    try {
        const response = await fetch(url);
        if (!response.ok) throw new Error("Error en la solicitud.");

        const data = await response.json();
        llenarSelect(data, selectId, valueKey, textKey);
        
        // Initialize Select2 after data is loaded
        $(`#${selectId}`).select2({
            theme: 'bootstrap-5',
        });
    } catch (error) {
        console.error("Error:", error);
    }
}

function llenarSelect(datos, selectId, valueKey, textKey) {
    const select = document.getElementById(selectId);
    if (!select) {
        alert(`No se encontró el select con ID: ${selectId}`);
        return;
    }

    // Limpiar el select y agregar la opción por defecto
    select.innerHTML = '<option value="" selected disabled>Seleccione</option>';

    datos.forEach(item => {
        const option = document.createElement('option');
        option.value = item[valueKey];
        option.textContent = item[textKey];
        select.appendChild(option);
    });
}
