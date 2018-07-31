<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>

        <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" id="bootstrap-css">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" type="text/css" href="/assets/css/style.css">

        <script src="/assets/ext/jquery/js/jquery.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="/assets/js/script.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="<?= base_url() ?>">JDR Management</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="<?= base_url() ?>">Accueil</a></li>
              <li><a href="#" id="create">Créer une salle</a></li>
              <li><a href="#" id="join">Rejoindre une salle</a></li>
              <li><a href="Login/logout">Déconnexion</a></li>
            </ul>
          </div>
        </nav>
