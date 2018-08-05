$(document).ready(function () {

    $('#join').on('click', function () {
        var room_name;
        var room_id;
        swal({
            title: "Entrer l'ID de la salle",
            content: "input",
            button: {
                text: "Continuer",
                closeModal: false
            }
        }).then(share_id => {
            if (!share_id)
                throw null;

            room_id = share_id;
            $.ajax({method: "POST",
                url: "Rooms/ajax_check_room_exists",
                data: { room_share_id: share_id }
            }).done(function(room_exists_json){
                var room_exists = JSON.parse(room_exists_json);
                console.log(room_exists);
                console.log(room_id);
                room_name = room_exists.name;
                if(room_exists.exists === 0){
                    swal("Oopsie", "Cette salle n'existe pas", "error");
                }else{
                    swal({
                        title: "Entrer votre nom de personnage",
                        text: "Vous allez rejoindre " + room_name,
                        content: "input",
                        button: {
                            text: "Rejoindre",
                            closeModal: false
                        }
                    }).then(player_name => {
                        if(!player_name)
                            throw null;

                        $.ajax({method: "POST",
                            url: "Rooms/ajax_join_room",
                            data: { room_share_id: room_id, player_name: player_name }
                        }).done(function(success_json){
                            var success = JSON.parse(success_json);
                            if(success.success === "SUCCESS"){
                                swal({
                                    icon: "success",
                                    title: success.message
                                }).then(value => {
                                    location.reload();
                                });
                            }else {
                                swal("Oopsie", success.message, "error");
                            }
                        });
                    });
                }
            });
        }).catch(err => {
            if (err) {
                swal("Oopsie", "Une erreur inconnue a été rencontrée", "error");
            } else {
                swal.stopLoading();
                swal.close();
            }
        });
    });

    $('#create').on('click', function () {
        swal({
            text: "Entrer le nom de la salle",
            content: "input",
            button: {
                text: "Créer",
                closeModal: false
            }
        }).then(name => {
            if (!name)
                throw null;

            $.ajax({method: "POST",
                url: "Rooms/ajax_create_room",
                data: { room_name: name }
            }).done(function(share_id){
                swal({
                    title: "Votre salle a bien été créée",
                    text: "ID de partage : " + share_id
                }).then(value => {
                    location.reload();
                });
            });
        }).catch(err => {
            if (err) {
                swal("Oopsie", "Une erreur inconnue a été rencontrée", "error");
            } else {
                swal.stopLoading();
                swal.close();
            }
        });
    });
});
