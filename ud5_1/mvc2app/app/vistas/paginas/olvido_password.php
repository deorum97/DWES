<?php require RUTA_APP.'/vistas/inc/header.php'; ?>

<section class="card">
  <h2>Recuperar Contraseña</h2>
  <p>Introduce tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.</p>

  <?php if (!empty($datos['error'])): ?>
    <p class="alert error"><?= h((string)$datos['error']) ?></p>
  <?php endif; ?>

  <?php if (!empty($datos['exito'])): ?>
    <p class="alert success"><?= h((string)$datos['exito']) ?></p>
  <?php endif; ?>

  <form method="post" action="<?= h(RUTA_URL) ?>/Restaurante/solicitar_reset" class="form">
    <label>
      Correo Electrónico
      <input type="email" name="email" required autocomplete="email">
    </label>

    <button type="submit">Enviar enlace de recuperación</button>
  </form>
  
  <p><a href="<?= h(RUTA_URL) ?>/Paginas/login">Volver al inicio de sesión</a></p>
</section>

<?php require RUTA_APP.'/vistas/inc/footer.php'; ?>
