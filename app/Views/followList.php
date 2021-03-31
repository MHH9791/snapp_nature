<div id="user_info_list" class="follow_users_list">
    <ul>
        <?php $index = 0; ?>
        <?php foreach ($users as $user):?>
            <li class="follow_users_list_user_item">
                <?php if($user['icon'] == null) :?>
                    <a class="profile-picture"><img alt="profile picture" src="<?php echo $profile_picture?>"></a>
                <?php else :?>
                    <a class="profile-picture"><img alt="profile picture" src="<?php echo $user['icon']?>"></a>
                <?php endif;?>
                <a class="follow_users_list_username" href="/profile_page/<?=$user['iduser']?>"><?=$user['username']?></a>
            </li>
        <?php $index = $index+1; ?>
        <?php endforeach;?>
    </ul>
    <?php if($index == 0):?>
    <h3 style="margin-left:20px; color: darkslategrey; font-size: 20px;">This page seems to be empty <br><br> You can discover new people on the Activity page!</h3>
    <?php endif; ?>
</div>
