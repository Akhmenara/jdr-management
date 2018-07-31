<script>
$(document).ready(function() {
    $('.rooms-table').DataTable({
        "columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<button class='btn btn-primary btn-md'>Entrer</button>"
        } ],
        "language": {
          "emptyTable": "Pas de salles trouvées"
        }
    });

    $('.rooms-table tbody').on('click', 'button', function() {
        var share_id = $(this).closest('tr').data('ref');
        window.location = "<?= base_url(); ?>index.php/room/see/" + share_id;
    });
});
</script>

<div class="row admin">
    <div class="col-md-8 col-md-offset-2">
        <h3>Liste de vos salles</h3>
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