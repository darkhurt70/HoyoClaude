<?php $this->layout('template', ['title' => ($isEdit ? 'Modifier' : 'Ajouter') . ' un personnage']); ?>

<?php $this->insert('message', ['message' => $message ?? null]); ?>

<h1 class="center-align"><?= $isEdit ? 'Modifier' : 'Ajouter' ?> un personnage</h1>

<div class="row">
    <form class="col s12 m8 offset-m2" method="post" action="index.php?action=<?= $isEdit ? 'edit-perso' : 'add-perso' ?>">

        <?php if ($isEdit && $personnage): ?>
            <input type="hidden" name="perso-id" value="<?= $this->e($personnage->getId()) ?>">
        <?php endif; ?>

        <div class="row">
            <div class="input-field col s12">
                <input id="perso-nom" name="perso-nom" type="text" class="validate" required
                       value="<?= $personnage ? $this->e($personnage->getName()) : '' ?>">
                <label for="perso-nom" class="<?= $personnage ? 'active' : '' ?>">Nom du personnage</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12 m6">
                <select name="perso-element" id="perso-element" required>
                    <option value="" disabled <?= !$personnage ? 'selected' : '' ?>>Choisissez un élément</option>
                    <?php foreach ($elements as $elem): ?>
                        <option value="<?= $elem['id'] ?>"
                                <?= ($personnage && $personnage->getElement() && $personnage->getElement()->getId() == $elem['id']) ? 'selected' : '' ?>>
                            <?= $this->e($elem['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label for="perso-element">Élément</label>
            </div>

            <div class="input-field col s12 m6">
                <select name="perso-unitclass" id="perso-unitclass" required>
                    <option value="" disabled <?= !$personnage ? 'selected' : '' ?>>Choisissez une classe</option>
                    <?php foreach ($unitclasses as $uc): ?>
                        <option value="<?= $uc['id'] ?>"
                                <?= ($personnage && $personnage->getUnitclass() && $personnage->getUnitclass()->getId() == $uc['id']) ? 'selected' : '' ?>>
                            <?= $this->e($uc['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label for="perso-unitclass">Classe</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12 m6">
                <select name="perso-origin" id="perso-origin">
                    <option value="" <?= !$personnage ? 'selected' : '' ?>>Aucune</option>
                    <?php foreach ($origins as $orig): ?>
                        <option value="<?= $orig['id'] ?>"
                                <?= ($personnage && $personnage->getOrigin() && $personnage->getOrigin()->getId() == $orig['id']) ? 'selected' : '' ?>>
                            <?= $this->e($orig['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label for="perso-origin">Origine</label>
            </div>

            <div class="input-field col s12 m6">
                <select name="perso-rarity" id="perso-rarity" required>
                    <option value="" disabled <?= !$personnage ? 'selected' : '' ?>>Choisissez une rareté</option>
                    <option value="4" <?= ($personnage && $personnage->getRarity() == 4) ? 'selected' : '' ?>>4 étoiles</option>
                    <option value="5" <?= ($personnage && $personnage->getRarity() == 5) ? 'selected' : '' ?>>5 étoiles</option>
                </select>
                <label for="perso-rarity">Rareté</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <input id="perso-img" name="perso-img" type="url" class="validate" required
                       value="<?= $personnage ? $this->e($personnage->getUrlImg()) : '' ?>">
                <label for="perso-img" class="<?= $personnage ? 'active' : '' ?>">URL de l'image</label>
            </div>
        </div>

        <div class="row">
            <div class="col s12 center-align">
                <button class="btn waves-effect waves-light blue" type="submit">
                    <?= $isEdit ? 'Modifier' : 'Ajouter' ?>
                    <i class="material-icons right">send</i>
                </button>
                <a href="index.php" class="btn waves-effect waves-light grey">Annuler</a>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    M.FormSelect.init(elems);
});
</script>
