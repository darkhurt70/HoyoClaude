<?php $this->layout('template', ['title' => 'Logs de l\'application']); ?>

<h1 class="center-align">Journal des Logs</h1>

<?php if (!empty($logFiles)): ?>
    <div class="row">
        <div class="col s12">
            <h5>Fichiers de log disponibles :</h5>
            <div class="collection">
                <?php foreach ($logFiles as $file): ?>
                    <a href="index.php?action=logs&file=<?= urlencode($file) ?>"
                       class="collection-item <?= ($currentFile == $file) ? 'active' : '' ?>">
                        <?= $this->e($file) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <?php if ($logContent !== null): ?>
        <div class="row">
            <div class="col s12">
                <h5>Contenu de <?= $this->e($currentFile) ?> :</h5>
                <div class="card-panel">
                    <pre style="white-space: pre-wrap; font-family: monospace; font-size: 12px;"><?= $this->e($logContent) ?></pre>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php else: ?>
    <p class="center-align">Aucun fichier de log disponible</p>
<?php endif; ?>
