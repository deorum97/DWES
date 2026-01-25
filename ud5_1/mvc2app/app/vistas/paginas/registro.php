<?php require RUTA_APP.'/vistas/inc/header.php'; ?>

<section class="card">
  <h2>Registro de Nuevo Restaurante</h2>

  <?php if (!empty($datos['error'])): ?>
    <p class="alert error"><?= h((string)$datos['error']) ?></p>
  <?php endif; ?>

  <?php if (!empty($datos['exito'])): ?>
    <p class="alert success"><?= h((string)$datos['exito']) ?></p>
  <?php endif; ?>

  <form method="post" action="<?= h(RUTA_URL) ?>/Restaurante/registrar" class="form">
    <label>
      Correo Electrónico
      <input type="email" name="email" required autocomplete="email">
    </label>

    <label>
      Contraseña
      <input type="password" name="password" minlength="4" required autocomplete="new-password">
    </label>

    <button type="submit">Registrar</button>
  </form>
  
  <p><a href="<?= h(RUTA_URL) ?>/Paginas/login">¿Ya tienes cuenta? Inicia sesión aquí</a></p>
</section>

<?php require RUTA_APP.'/vistas/inc/footer.php'; ?>
