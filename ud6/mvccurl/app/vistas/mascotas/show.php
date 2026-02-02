<?php require_once RUTA_APP.'/vistas/inc/header.php'; ?>

<?php
// Endpoint REST apuntando al servidor API (mvcapi)
$API_mascotaS_ENDPOINT = rtrim(API_BASE_URL, '/') . '/api/mascota';
?>

<h1><?php echo $datos['titulo'] ?? 'Ficha'; ?></h1>

<?php if (!empty($datos['error'])): ?>
    <pre>
Error HTTP <?php echo (int)$datos['http']; ?>:
<?php echo htmlspecialchars(json_encode($datos['error'], JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)); ?>
  </pre>

    <p><a href="<?php echo rtrim(RUTA_URL,'/'); ?>/mascotas/index">Volver al listado</a></p>

    <?php require_once RUTA_APP.'/vistas/inc/footer.php'; ?>
    <?php return; ?>
<?php endif; ?>

<?php $mascota = $datos['mascota'] ?? []; ?>

<ul>
    <li><strong>ID:</strong> <?php echo htmlspecialchars($mascota['id'] ?? ''); ?></li>
    <li><strong>nombre:</strong> <?php echo htmlspecialchars($mascota['nombre'] ?? ''); ?></li>
    <li><strong>Tipo:</strong> <?php echo htmlspecialchars($mascota['tipo'] ?? ''); ?></li>
    <li><strong>Nacimiento:</strong> <?php echo htmlspecialchars($mascota['fecha_nacimiento'] ?? ''); ?></li>
    <li><strong>Foto:</strong></li>
    <img src="<?php echo RUTA_URL?>/..<?php echo $mascota['foto_url'] ?? ''; ?>" alt="<?php echo $c['foto_url'] ?? ''; ?>">
    <li><strong>Id de persona:</strong> <?php echo htmlspecialchars($mascota['id_persona'] ?? ''); ?></li>
</ul>


<button id="btnBorrar">Borrar mascota</button>

<p id="out"></p>

<p><a href="<?php echo rtrim(RUTA_URL,'/'); ?>/mascotas/index">Volver al listado</a></p>

<script>
    const endpoint = <?php echo json_encode($API_mascotaS_ENDPOINT); ?>;
    const basicAuth = <?php echo json_encode('Basic ' . base64_encode(API_BASIC_USER . ':' . API_BASIC_PASS)); ?>;

    document.getElementById('btnBorrar').addEventListener('click', async (e) => {
        e.preventDefault();

        const out = document.getElementById('out');
        out.textContent = 'Enviando petición a la API...';

        const fd = new FormData();
        const payload = Object.fromEntries(fd.entries());

        try {
            const res = await fetch(endpoint + "/<?php echo (int)($mascota['id'] ?? 0); ?>", {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json; charset=utf-8',
                    'Accept': 'application/json',
                    'Authorization': basicAuth
                },
                body: JSON.stringify(payload)
            });

            const text = await res.text();
            let data;
            try { data = JSON.parse(text); }
            catch { data = { raw: text }; }

            out.textContent =
                `HTTP ${res.status} ${res.statusText}\n\n` +
                JSON.stringify(data, null, 2);

            if (res.ok) window.location.href = '<?php echo rtrim(RUTA_URL,'/'); ?>/mascotas/index';

        } catch (err) {
            out.textContent = 'Error de red:\n' + String(err);
        }
    });
</script>

<?php require_once RUTA_APP.'/vistas/inc/footer.php'; ?>
