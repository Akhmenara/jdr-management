$(document).ready(function(){
    $('.nav-room').on('click', 'li', function(event){
        $("#nav-room>li>a").removeClass("active");
        $(event.target).addClass("active");
        $("#dashboard-content").hide();
        $("#chat-content").hide();
        $("#summary-content").hide();
        $('#' + $(event.target).attr('id') + '-content').show();
    });
});
