<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="row">
                <div class="col-lg-12">
                    <div id="avertissement"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="text-center">Ajout d'utilisateur</h1>
                    <p class="text-center">
                        Ici, vous pouvez ajouter un utilisateur.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form method="POST" action="<?php echo HOME.'/user/add'; ?>">
                        <div class="form-group">
                            <label for="prenom" class="control-label">Prénom :</label>
                            <input type="text" class="form-control" id="prenom" name="prenom">
                        </div>
                        <div class="form-group">
                            <label for="nom" class="control-label">Nom :</label>
                            <input type="text" class="form-control" id="nom" name="nom">
                        </div>
                        <div class="form-group">
                            <label for="courriel" class="control-label">Courriel :</label>
                            <input type="email" class="form-control" id="courriel" name="courriel">
                        </div>
                        <div class="form-group">
                            <label for="nationalite" class="control-label">Nationalité :</label>
                            <select class="form-control" id="nationalite" name="nationalite">
                                <option>France</option>
                                <option>Allemagne</option>
                                <option>Slovaquie</option>
                                <option>République Tcheque</option>
                                <option>Royaume Uni</option>
                                <option>Pologne</option>
                                <option>Hongrie</option>
                                <option>Autriche</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="groupe" class="control-label">Groupe :</label>
                            <select class="form-control" id="groupe" name="groupe">
                                <option>Utilisateur standard</option>
                                <option>Administrateur</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="datedenaissance" class="control-label">Date de naissance :</label>
                            <input type="text" class="form-control" id="datedenaissance" name="datedenaissance">
                        </div>
                        <div class="form-group">
                            <label for="identifiant" class="control-label">Identifiant :</label>
                            <input type="text" class="form-control" id="identifiant" name="identifiant">
                        </div>
                        <div class="form-group">
                            <label for="motdepasse" class="control-label">Mot de passe :</label>
                            <input type="password" class="form-control" id="motdepasse" name="motdepasse">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="submit" id="creer" class="btn btn-success">Sauvegarder</button>
                            </div>
                            <div class="col-lg-6 text-right">
                                <a href="<?php echo HOME.'/user/manage'; ?>" class="btn btn-warning">Abandon</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#creer").on("click", function (e) {
            e.preventDefault();
            if($("#nom").val().length == 0 || $("#prenom").val().length == 0 || $("#courriel").val().length == 0 || $("#nationalite").val().length == 0 || $("#datedenaissance").val().length == 0 || $("#identifiant").val().length == 0 || $("#motdepasse").val().length == 0) {
                $("#avertissement").html('<div class="alert alert-warning">Veuillez saisir tout les informations demandées!</div>').show().delay(1000).hide(500);
            }
            else {
                $(this).unbind("click");
            }
        });
    });
    $('#datedenaissance').datepicker({
        dateFormat: 'dd/mm/yy'
    });

</script>