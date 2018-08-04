<!DOCTYPE html>
<html>
    <head>
        <title>JDR management</title>

        <link href="/assets/ext/datatable/css/datatables.min.css" rel="stylesheet">
        <link href="/assets/ext/bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" type="text/css" href="/assets/css/style.css">

        <script src="/assets/ext/jquery/js/jquery.js"></script>
        <script src="/assets/ext/bootstrap/js/bootstrap.min.js"></script>
        <script src="/assets/ext/datatable/js/datatables.min.js"></script>
        <script src="/assets/ext/sweetalert/js/sweetalert.min.js"></script>
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
