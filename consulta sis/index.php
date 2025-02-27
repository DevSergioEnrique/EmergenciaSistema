<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Afiliado - SIS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h1 class="mb-4">Consulta de Afiliado</h1>
    <!-- Formulario para ingresar los datos -->
    <form id="consultaForm">
      <div class="form-group">
        <label for="tipoDocumento">Tipo de Documento:</label>
        <select name="tipoDocumento" id="tipoDocumento" class="form-control">
          <option value="1">DNI</option>
          <option value="2">CE</option>
        </select>
      </div>
      <div class="form-group">
        <label for="nroDocumento">Número de Documento:</label>
        <input type="text" name="nroDocumento" id="nroDocumento" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary">Consultar</button>
    </form>
    <!-- Sección para mostrar los resultados -->
    <div id="resultado" class="mt-4"></div>
  </div>
  
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <!-- Script para enviar la consulta vía AJAX -->
  <script>
    $(document).ready(function(){
      $("#consultaForm").submit(function(e){
        e.preventDefault(); // Evita recargar la página
        $.ajax({
          type: "POST",
          url: "consulta-sis.php",
          data: $(this).serialize(),
          success: function(response){
            $("#resultado").html(response);
          },
          error: function(){
            $("#resultado").html("<div class='alert alert-danger'>Ocurrió un error al realizar la consulta.</div>");
          }
        });
      });
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
