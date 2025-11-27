<?php $this->layout('template', ['title' => 'Ajouter un élément']); ?>

<?php $this->insert('message', ['message' => $message ?? null]); ?>

<h1 class="center-align">Ajouter un Élément</h1>

<div class="row">
    <form class="col s12 m6 offset-m3" method="post" action="index.php?action=add-element">

        <div class="row">
            <div class="input-field col s12">
                <select name="element-type" id="element-type" required>
                    <option value="" disabled selected>Choisissez un type</option>
                    <option value="element">Élément</option>
                    <option value="origin">Origine</option>
                    <option value="unitclass">Classe</option>
                </select>
                <label for="element-type">Type</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <input id="element-name" name="element-name" type="text" class="validate" required>
                <label for="element-name">Nom</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <input id="element-img" name="element-img" type="url" class="validate" required>
                <label for="element-img">URL de l'icône</label>
            </div>
        </div>

        <div class="row">
            <div class="col s12 center-align">
                <button class="btn waves-effect waves-light blue" type="submit">
                    Ajouter
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
