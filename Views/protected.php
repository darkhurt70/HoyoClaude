<?php $this->layout('template', ['title' => 'Zone Protégée']); ?>

<h1 class="center-align">Zone Protégée</h1>

<div class="row">
    <div class="col s12">
        <div class="card green lighten-4">
            <div class="card-content">
                <span class="card-title">
                    <i class="material-icons">lock_open</i>
                    Accès autorisé !
                </span>
                <p>Félicitations ! Vous êtes connecté et avez accès à cette page protégée.</p>
                <p>Utilisateur connecté: <strong><?= $_SESSION['username'] ?? 'Inconnu' ?></strong></p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col s12">
        <p>Cette page est un exemple de route protégée. Elle ne peut être accessible que si vous êtes authentifié.</p>
        <p>Dans un projet réel, vous pourriez afficher ici :</p>
        <ul class="collection">
            <li class="collection-item">La collection personnelle de l'utilisateur</li>
            <li class="collection-item">Les statistiques du compte</li>
            <li class="collection-item">Les paramètres utilisateur</li>
            <li class="collection-item">Toute autre information privée</li>
        </ul>
    </div>
</div>
