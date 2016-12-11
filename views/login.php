<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">Connexion</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="<?php echo HOME.'/user/login'; ?>">
                        <div class="form-group">
                            <label for="identifiant" class="col-sm-2 control-label">Identifiant :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="identifiant" name="identifiant">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="motdepasse" class="col-sm-2 control-label">Mot de passe :</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="motdepasse" name="motdepasse">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">S'authentifier</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>