<?php if(empty($has_rights)){?>
    <?php if(!empty($redirect_play)){ ?>
        <script>window.location = "<?= base_url() ?>index.php/room/play/" + "<?= $room_details['ro_share_id'] ?>";</script>
    <?php }else {?>
        <div class="alert alert-danger">
            <strong>L'accès à cette page vous est refusé.</strong>
            <br>
            <a href="<?= base_url() ?>" class="alert-link">Retourner à l'accueil.</a>
        </div>
    <?php } ?>
<?php }else { ?>
        ADMIN
<?php } ?>
