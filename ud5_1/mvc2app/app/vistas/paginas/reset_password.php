<?php require RUTA_APP.'/vistas/inc/header.php'; ?>

<section class="card">
  <h2>Nueva Contraseña</h2>
  <p>Introduce tu nueva contraseña para completar el proceso.</p>

  <?php if (!empty($datos['error'])): ?>
    <p class="alert error"><?= h((string)$datos['error']) ?></p>
  <?php endif; ?>

  <form method="post" action="<?= h(RUTA_URL) ?>/Restaurante/procesar_reset" class="form">
    <input type="hidden" name="id" value="<?= h((string)$datos['id']) ?>">
    
    <label>
      Nueva Contraseña
      <input type="password" name="password" minlength="4" required autocomplete="new-password">
    </label>

    <button type="submit">Guardar Nueva Contraseña</button>
  </form>
</section>

<?php require RUTA_APP.'/vistas/inc/footer.php'; ?>
