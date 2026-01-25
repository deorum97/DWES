<?php require RUTA_APP.'/vistas/inc/header.php'; ?>

<section class="card">
  <h2>Categorías</h2>

  <?php if (!empty($_SESSION['flash'])) { ?>
    <?php $f = $_SESSION['flash']; unset($_SESSION['flash']); ?>
    <p class="alert <?php echo ($f['type'] ?? '') === 'ok' ? 'ok' : 'error'; ?>">
      <?php echo (($f['type'] ?? '') === 'ok') ? '✅' : '❌'; ?> <?php echo h((string) ($f['msg'] ?? '')); ?>
    </p>
  <?php } ?>

  <?php if (empty($datos['categorias'])): ?>
    <p>No hay categorías.</p>
  <?php else: ?>
    <ul class="list">
      <?php foreach ($datos['categorias'] as $c): ?>
        <?php $id = (string)($c['CodCat'] ?? ''); $nombre = (string)($c['Nombre'] ?? $id); ?>
        <li>
          <a href="<?= h(RUTA_URL) ?>/Categoria/listar/<?= h(urlencode($id)) ?>">
            <?= h($nombre) ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</section>

<?php require RUTA_APP.'/vistas/inc/footer.php'; ?>
