<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro</title>
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

  <div class="card shadow p-4" style="max-width: 500px; width: 100%;">
    <h3 class="text-center mb-4">Crear Cuenta</h3>
    <form method="POST" action="register_process.php">
      <div class="mb-3">
        <label for="name" class="form-label">Nombre de usuario</label>
        <input type="text" placeholder="Nombre de usuario" class="form-control" id="name" name="name" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Correo electrónico</label>
        <input type="email" placeholder="email" class="form-control" id="email" name="email" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" placeholder="contraseña" class="form-control" id="password" name="password" required>
      </div>

      <div class="mb-3">
        <label for="confirmPassword" class="form-label">Confirmar Contraseña</label>
        <input type="password" placeholder="Confirmar contraseña" class="form-control" id="confirmPassword" name="confirmPassword" required>
      </div>

      <button type="submit" class="btn btn-success w-100">Registrarse</button>

      <p class="text-center mt-3">
        ¿Ya tienes cuenta? <a href="/index.php?url=login">Inicia sesión aquí</a>
      </p>
    </form>
  </div>

</body>
</html>