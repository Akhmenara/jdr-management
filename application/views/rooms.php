<?php if (empty($user_id)) { ?>
    <div class="alert alert-danger">
        <strong>L'accès à cette page vous est refusé.</strong>
        <br>
        <a href="<?= base_url() ?>" class="alert-link">Retourner à l'accueil.</a>
    </div>
<?php } else { ?>
<script>
$(document).ready(function() {
    $('.rooms-table').DataTable({
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button class='btn btn-primary btn-md'>Entrer</button>"
        } ],
        "language": {
            "emptyTable": "Pas de salles trouvées",
            "info": "Affichage de la page _PAGE_ sur _PAGES_",
            "paginate": {
                "first":      "Début",
                "last":       "Fin",
                "next":       "Suivant",
                "previous":   "Précédent"
            },
            "search": "Rechercher:",
            "lengthMenu": "Afficher _MENU_ éléments",
            "zeroRecords":    "Pas d'éléments correspondants"
        }
    });

    $('#rooms-owned tbody').on('click', 'button', function() {
        var share_id = $(this).closest('tr').data('ref');
        window.location = "<?= base_url(); ?>index.php/room/manage/" + share_id;
    });

    $('#rooms-accessed tbody').on('click', 'button', function() {
        var share_id = $(this).closest('tr').data('ref');
        window.location = "<?= base_url(); ?>index.php/room/play/" + share_id;
    });
});
</script>

<div class="row admin">
    <div class="col-md-8 col-md-offset-2">
        <h3>Aventures que vous avez créé</h3>
        <table id="rooms-owned" class="display rooms-table" style="width:100%">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>MJ</th>
                    <th>ID de partage</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($rooms_owned as $room){ ?>
                <tr id='<?= $room['ro_id'] ?>' data-ref='<?= $room['ro_share_id'] ?>'>
                    <td><?= $room['ro_name'] ?></td>
                    <td><?= $room['admin'] ?></td>
                    <td><?= $room['ro_share_id'] ?></td>
                    <td></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<div class="row player">
    <div class="col-md-8 col-md-offset-2">
        <h3>Aventures dont vous faites partie</h3>
        <table id="rooms-accessed" class="display rooms-table" style="width:100%">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>MJ</th>
                    <th>ID de partage</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($rooms_list as $room){ ?>
                <tr id='<?= $room['ro_id'] ?>' data-ref='<?= $room['ro_share_id'] ?>'>
                    <td><?= $room['ro_name'] ?></td>
                    <td><?= $room['admin'] ?></td>
                    <td><?= $room['ro_share_id'] ?></td>
                    <td></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php } ?>