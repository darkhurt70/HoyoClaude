<?php if ($message): ?>
<div class="card-panel <?= is_string($message) ? 'blue lighten-2' : '' ?> white-text">
    <p><?= $this->e($message) ?></p>
</div>
<?php endif; ?>
