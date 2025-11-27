<?php $this->layout('template', ['title' => 'Connexion']); ?>

<?php $this->insert('message', ['message' => $message ?? null]); ?>

<h1 class="center-align">Connexion</h1>

<div class="row">
    <form class="col s12 m6 offset-m3" method="post" action="index.php?action=login">

        <div class="row">
            <div class="input-field col s12">
                <input id="username" name="username" type="text" class="validate" required>
                <label for="username">Nom d'utilisateur</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <input id="password" name="password" type="password" class="validate" required>
                <label for="password">Mot de passe</label>
            </div>
        </div>

        <div class="row">
            <div class="col s12 center-align">
                <button class="btn waves-effect waves-light blue" type="submit">
                    Se connecter
                    <i class="material-icons right">send</i>
                </button>
                <a href="index.php" class="btn waves-effect waves-light grey">Annuler</a>
            </div>
        </div>
    </form>
</div>

<div class="row">
    <div class="col s12 m6 offset-m3">
        <div class="card blue lighten-4">
            <div class="card-content">
                <span class="card-title">Utilisateurs de test</span>
                <p>Username: <strong>admin</strong> / Password: <strong>admin</strong></p>
                <p>Username: <strong>test</strong> / Password: <strong>test</strong></p>
            </div>
        </div>
    </div>
</div>
