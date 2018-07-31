$(document).ready(function () {

    $('#join').on('click', function () {
        swal("Here's a message!");
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
