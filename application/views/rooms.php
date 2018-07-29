<script>
$(document).ready(function() {
    $('.rooms-table').DataTable();
} );
</script>

<div class="row admin">
    <div class="col-md-8 col-md-offset-2">
        <h3>Liste de vos salles</h3>
        <table id="rooms" class="display rooms-table" style="width:100%">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>MJ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($rooms_owned as $room){ ?>
                <tr>
                    <td><?= $room['ro_name'] ?></td>
                    <td><?= $room['admin'] ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<div class="row player">
    <div class="col-md-8 col-md-offset-2">
        <h3>Aventures dont vous faites partie</h3>
        <table id="rooms" class="display rooms-table" style="width:100%">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>MJ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($rooms_list as $room){ ?>
                <tr>
                    <td><?= $room['ro_name'] ?></td>
                    <td><?= $room['admin'] ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>