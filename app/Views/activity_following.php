<div class="page-content">
    <div id="posts-infinite-f" class ='observations'>
        <ul class="post_list" style="list-style-type:none; padding: 0">
            <?php $index=0; ?>
                <?php foreach ($f_uploads as $f_upload):?>
                    <?php if($session == "0") :?>
                        <?php $link = "/login" ;?>
                    <?php else :?>
                        <?php $link = "/profile_page/".$f_upload['user_id'] ;?>
                    <?php endif;?>
                    <li>
                        <div class="post" id="f_post<?php echo $index?>">
                            <div class="bg-image-wrapper">
                                <div class="bg-image" style="background-image:url(<?=$f_upload['picture']?>)"></div>
                            </div>
                            <div class="plant_image" style="background-image:url(<?=$f_upload['picture']?>)"></div>
                            <a class="posting_user" href=<?=$link?> >
                                <?php if($f_upload['icon'] == null) :?>
                                    <img alt="Profile picture" src="<?php echo $profile_picture?>">
                                <?php else :?>
                                    <img alt="Plant picture" src="<?php echo $f_upload['icon']?>">
                                <?php endif;?>
                                <p class="posting_user_name" style="margin-left: 5%;"><?=$f_upload['username']?></p>
                            </a>
                            <a target="_blank" href=<?=$f_upload["wiki_url"]?> >
                            <div class="post_information">
                                <p class="scientific_name"><?=$f_upload['scientific_name']?></p>
                                <p class="common_name"><?=$f_upload['common_name']?></p>
                            </div>
                            </a>
                            <button onclick="expand_details(<?php echo $index?>)" id="f_expand_button<?php echo $index ?>" class="details_button expand_button button_active">
                                <span class="material-icons view-details-icon">keyboard_arrow_down</span>
                            </button>
                            <button onclick="shrink_details(<?php echo $index?>)" id="f_shrink_button<?php echo $index ?>"  class="details_button shrink_button">
                                <span class="material-icons view-details-icon">keyboard_arrow_up</span>
                            </button>
                            <div class="post_details" id="f_post_detail<?php echo $index?>">
                                <p><?=$f_upload['comment']?></p>
                                <p class="post_time"><?=$f_upload['time']?></p>
                            </div>
                        </div>
                    </li>
                    <?php $index++; ?>
                <?php endforeach;?>
        </ul>
    </div>
    <input type="hidden" id="all_uploads_count_f" value="<?= $f_total_num ?>">
</div>
