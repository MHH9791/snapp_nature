<div class="page-content">
    <div id="posts-infinite-n" class ='observations'>
        <ul class="post_list" style="list-style-type:none; padding: 0">
            <?php $index=0; ?>
            <?php foreach ($n_uploads as $n_upload):?>
                <?php if($session == "0") :?>
                    <?php $link = "/login" ;?>
                <?php else :?>
                    <?php $link = "/profile_page/".$n_upload['user_id'] ;?>
                <?php endif;?>
                <li>
                    <div class="post" id="n_post<?php echo $index?>">
                        <div class="bg-image-wrapper">
                            <div class="bg-image" style="background-image:url(<?=$n_upload['picture']?>)"></div>
                        </div>
                        <div class="plant_image" style="background-image:url(<?=$n_upload['picture']?>)"></div>
                        <a class="posting_user" href=<?=$link?> >
                            <?php if($n_upload['icon'] == null) :?>
                                <img alt="Profile picture" src="<?php echo $profile_picture?>">
                            <?php else :?>
                                <img alt="Plant picture" src="<?php echo $n_upload['icon']?>">
                            <?php endif;?>
                            <p class="posting_user_name" style="margin-left: 5%;"><?=$n_upload['username']?></p>
                        </a>
                        <a target="_blank" href=<?=$n_upload["wiki_url"]?>>
                        <div class="post_information" >
                            <p class="scientific_name" ><?=$n_upload['scientific_name']?></p>
                            <p class="common_name"><?=$n_upload['common_name']?></p>
                        </div>
                        </a>
                        <button onclick="expand_details(<?php echo $index?>)" id="n_expand_button<?php echo $index ?>" class="details_button expand_button button_active">
                            <span class="material-icons view-details-icon">keyboard_arrow_down</span>
                        </button>
                        <button onclick="shrink_details(<?php echo $index?>)" id="n_shrink_button<?php echo $index ?>"  class="details_button shrink_button">
                            <span class="material-icons view-details-icon">keyboard_arrow_up</span>
                        </button>
                        <div class="post_details" id="n_post_detail<?php echo $index?>">
                            <p><?=$n_upload['comment']?></p>
                            <p class="post_time"><?=$n_upload['time']?></p>
                        </div>
                    </div>
                </li>
                <?php $index++; ?>
            <?php endforeach;?>
        </ul>
    </div>
    <input type="hidden" id="all_uploads_count_n" value="<?= $n_total_num ?>">
</div>

