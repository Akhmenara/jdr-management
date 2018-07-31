<?php if(empty($has_rights)){?>
    <div class="alert alert-danger">
        <strong>L'accès à cette page vous est refusé.</strong>
        <br>
        <a href="<?= base_url() ?>" class="alert-link">Retourner à l'accueil.</a>
    </div>
<?php }else { ?>
    L'ID de la salle est : <?= $share_id ?>
<?php }?>