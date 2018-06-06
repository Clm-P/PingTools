<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Connexion</title>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" />

        <script src="js/jquery.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <style type="text/css">
        #form{
            width:550px;
            margin: auto;
        }
    </style>
    </head>
    <body>
        <div id="form">
            <form action="login.php" method="post">
                <div class="form-group">
                    <label>Identifiant</label>
                    <input type="text" name="user" class="form-control"/>
                </div>
                <div class="form-group">
                    <label>Mot de passe</label>
                    <input type="password" name="mdp" class="form-control"/>
                </div>

                <center><input type="submit" value="Connexion" class="btn btn-primary"/></center>
            </form>
        </div>
    </body>
</html>