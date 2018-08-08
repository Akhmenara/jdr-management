<script src="/assets/js/chat.js"></script>
<?php if(empty($room_users)){ ?>
    <div id="chat-content" class="col-xs-12 col-sm-9">
        <h4>Pas de joueurs trouvés</h4>
    </div>
<?php }else{ ?>
<div class="container-fluid">
    <div class="row row-offcanvas row-offcanvas-left">
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
            <div class="sidebar-nav">
                <ul id="nav-chat" class="nav nav-chat">
                    <?php foreach($room_users as $index => $user){ ?>
                        <li><a id="<?= $user['us_id'] ?>" href="#" <?php if($index === 0) echo 'class="active"'; ?>><?= $user['us_displayed_name'] ?> (<?= $user['us_name'] ?>)</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div id="chat-content" class="col-xs-12 col-sm-9">
            <div id="chat-messages" class="row">
                <ul class="list-group">
                    <!--<li class="list-group-item sent" data-date="1533679156">Messages</li>
                    <li class="list-group-item sent" data-date="1533679393">Messages</li>
                    <li class="list-group-item received" data-date="1533715420">Messages</li>-->
                </ul>
            </div>
            <div id="chat-form" class="form-group">
                <input type="text" id="chat-input" class="form-control" placeholder="Écrivez un message"/>
                <input id="chat-send" class="form-control" type="submit" value="Envoyer"/>
            </div>
        </div>
    </div>
</div>
<div style='clear:both'></div>
<?php } ?>
