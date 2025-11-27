<?php $this->layout('template', ['title' => 'Collection Mihoyo']); ?>

<?php $this->insert('message', ['message' => $message ?? null]); ?>

<h1 class="center-align">Collection de Personnages</h1>

<?php if (empty($personnages)): ?>
    <p class="center-align">Aucun personnage dans la collection</p>
<?php else: ?>
    <div class="row">
        <?php foreach ($personnages as $perso): ?>
            <div class="col s12 m6 l4">
                <div class="card character-card" data-element="<?= $perso->getElement() ? strtolower($this->e($perso->getElement()->getName())) : 'none' ?>" data-rarity="<?= $this->e($perso->getRarity()) ?>">
                    <div class="card-image">
                        <img src="<?= $this->e($perso->getUrlImg()) ?>" alt="<?= $this->e($perso->getName()) ?>" style="height: 300px; object-fit: cover;">
                        <span class="card-title" style="background: rgba(0,0,0,0.5); width: 100%; padding: 10px;">
                            <?= $this->e($perso->getName()) ?>
                        </span>
                    </div>
                    <div class="card-content">
                        <p><strong>Rareté:</strong> <?= str_repeat('⭐', $perso->getRarity()) ?></p>
                        <p><strong>Élément:</strong> <?= $perso->getElement() ? $this->e($perso->getElement()->getName()) : 'N/A' ?></p>
                        <p><strong>Classe:</strong> <?= $perso->getUnitclass() ? $this->e($perso->getUnitclass()->getName()) : 'N/A' ?></p>
                        <p><strong>Origine:</strong> <?= $perso->getOrigin() ? $this->e($perso->getOrigin()->getName()) : 'N/A' ?></p>
                    </div>
                    <div class="card-action">
                        <a href="index.php?action=edit-perso&id=<?= $this->e($perso->getId()) ?>">
                            <i class="material-icons">edit</i> Modifier
                        </a>
                        <a href="index.php?action=del-perso&id=<?= $this->e($perso->getId()) ?>" onclick="return confirm('Supprimer ce personnage ?')">
                            <i class="material-icons">delete</i> Supprimer
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
