<?php require RUTA_APP.'/vistas/inc/header.php'; ?>

<section class="card">
  <h2>Acceso</h2>

  <?php if (!empty($datos['error'])): ?>
    <p class="alert error"><?= h((string)$datos['error']) ?></p>
  <?php endif; ?>

  <?php if (!empty($datos['exito'])): ?>
    <p class="alert success"><?= h((string)$datos['exito']) ?></p>
  <?php endif; ?>

  <form method="post" action="<?= h(RUTA_URL) ?>/Restaurante/login" class="form">
    <label>
      Correo
      <input type="email" name="user" required autocomplete="username">
    </label>

    <label>
      Clave
      <input type="password" name="password" minlength="1" required autocomplete="current-password">
    </label>

    <button type="submit">Entrar</button>
  </form>
  <p><a href="<?= h(RUTA_URL) ?>/Paginas/registro">¿No tienes cuenta? Regístrate aquí</a></p>
</section>

<?php require RUTA_APP.'/vistas/inc/footer.php'; ?>
