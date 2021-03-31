
<ul style="list-style-type:none; padding: 0">
    <?php if(is_array($posts)) :?>
    <?php if(isset($offset)) :?>
    <?php $index = $offset;?>
    <?php endif; ?>

    <?php if(!isset($post_type)): ?>
    <?php $post_type=""; ?>
    <?php endif; ?>

    <?php foreach ($posts as $post):?>
            <?php if($session == "0") :?>
                <?php $link = "/login" ;?>
            <?php else :?>
                <?php $link = "/profile_page/".$post['user_id'] ;?>
            <?php endif;?>
        <li>
                <div class="post" id=<?php echo $post_type."post".$index?>>
                <div class="bg-image-wrapper">
                    <div class="bg-image" style="background-image:url(<?=$post['picture']?>)"></div>
                </div>
                <input type="hidden" id="person_id" value="<?=$post['user_id']?>">
                <div class="plant_image" style="background-image:url(<?=$post['picture']?>)"></div>
                <a class="posting_user" href=<?= $link?> >
                    <?php if($post['icon'] == null) :?>
                        <img alt="Profile picture" src="<?php echo $profile_picture?>">
                    <?php else :?>
                        <img alt="Plant picture" src="<?php echo $post['icon']?>">
                    <?php endif;?>
                    <p class="posting_user_name" style="margin-left: 5%;"><?=$post['username']?></p>
                </a>
                    <a target="_blank" href=<?=$post["wiki_url"]?>>
                        <div class="post_information">
                            <p class="scientific_name"><?=$post['scientific_name']?></p>
                            <p class="common_name"><?=$post['common_name']?></p>
                        </div>
                    </a>
                <button onclick="expand_details(<?php echo $index?>)" id=<?php echo $post_type."expand_button".$index?> class="details_button expand_button button_active">
                    <span class="material-icons view-details-icon">keyboard_arrow_down</span>
                </button>
                <button onclick="shrink_details(<?php echo $index?>)" id=<?php echo $post_type."shrink_button".$index ?> class="details_button shrink_button">
                    <span class="material-icons view-details-icon">keyboard_arrow_up</span>
                </button>
                <div class="post_details" id=<?php echo $post_type."post_detail".$index ?>>
                    <p><?=$post['comment']?></p>
                    <p class="post_time"><?=$post['time']?></p>
                </div>
            </div>
        </li>
            <?php $index++; ?>
    <?php endforeach;?>
    <?php endif;?>
</ul>
