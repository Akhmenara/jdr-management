$(document).ready(function(){
    $('.nav-chat').on('click', 'li', function(event){
        $("#nav-chat>li>a").removeClass("active");
        $(event.target).addClass("active");
        $('#chat-messages>ul').empty();
        fetch_messages();
    });

    $("#chat-input").keydown(function(event) {
        if (event.keyCode === 13) {
            $("#chat-send").trigger('click');
        }
    });

    $('#chat-send').on('click', function(){
        var message = $('#chat-input').val();
        var recipient = $('#nav-chat').find('.active');
        var room = window.location.pathname.split('/').slice(-1)[0].replace('#', '');

        $.ajax({method: "POST",
            url: "/index.php/Room/ajax_send_private",
            data: { message:message, recipient:+ $(recipient[0]).attr('id'), room:room }
        }).done(function(){
            $('#chat-input').val('');
        });
    });

    window.setInterval(function() {
        fetch_messages();
    }, 1000);

    function fetch_messages(){

        var other = $($('#nav-chat').find('.active')[0]).attr('id');
        var room = window.location.pathname.split('/').slice(-1)[0].replace('#', '');
        var last_message_date = $('#chat-messages>ul li:last-child').data('date');

        $.ajax({method: "POST",
            url: "/index.php/Room/ajax_fetch_messages",
            data: { other: other, room: room, last_message_date: last_message_date }
        }).done(function(data_json){
            var data = JSON.parse(data_json);
            data.forEach(function(element){
                var row = '<li class="list-group-item ' + element.me_type + '" data-date="' + element.me_created + '">' + element.me_content + '</li>';
                $('#chat-messages>ul').append(row);
            });

            var elem = document.getElementById('chat-messages');
            elem.scrollTop = elem.scrollHeight;
        });
    }
});
