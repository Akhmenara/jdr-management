<script src="/assets/js/room.js"></script>

<?php if (empty($has_rights)) { ?>
    <div class="alert alert-danger">
        <strong>L'accès à cette page vous est refusé.</strong>
        <br>
        <a href="<?= base_url() ?>" class="alert-link">Retourner à l'accueil.</a>
    </div>
<?php } else { ?>
    <div class="container-fluid">
        <div class="row row-offcanvas row-offcanvas-left">
            <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                <div class="sidebar-nav">
                    <ul id="nav-room" class="nav nav-room">
                        <li><a id="dashboard" href="#" class="active">Tableau de bord</a></li>
                        <li><a id="chat" href="#">Chat</a></li>
                        <li><a id="summary" href="#">Résumé</a></li>
                        <li class="nav-divider"></li>
                    </ul>
                </div>
            </div>
            <div id="dashboard-content" class="col-xs-12 col-sm-9">
                <div class="row">
                    <div class="panel-group" id="accordion">
                        <?php if(empty($categories)){ ?>
                        <div class="panel panel-default"><h4>Aucune catégorie trouvée pour cette salle</h4></div>
                        <?php }else{?>
                        <?php foreach ($categories as $category) { ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-<?= $category['cat_id'] ?>">
                                            <?= $category['cat_name'] ?></a>
                                        <!--<span id="glyphicon-<?= $category['cat_id'] ?>" class="glyphicon pull-right"><?= $category['cat_id'] === '1'? '&#x2b;': '&#x2212;' ?></span>-->
                                    </h4>
                                </div>
                                <div id="collapse-<?= $category['cat_id'] ?>" class="panel-collapse collapse <?php if ($category['cat_id'] === '1') echo 'in'; ?>">
                                    <div class="panel-body">
                                        <?php foreach ($category['content'] as $content) { ?>
                                            <?php if($content['type'] === "message"){ ?>
                                                <p><?= $content['me_content'] ?></p>
                                                <hr>
                                            <?php } ?>
                                            <?php if($content['type'] === "image"){ ?>
                                                <div class="img-wrap">
                                                    <img src="/assets/images/<?= $content['im_path'] ?>"/>
                                                    <hr>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php }} ?>
                    </div>
                </div>
            </div>
            <div id="chat-content" class="col-xs-12 col-sm-9" hidden>
                <div class="row">

                </div>
            </div>
            <div id="summary-content" class="col-xs-12 col-sm-9" hidden>
                <div class="row">

                </div>
            </div>
        </div>
    </div>
<?php } ?>
