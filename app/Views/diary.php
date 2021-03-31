<div class="page-content" style="margin-bottom: 200px">
    <div id="posts-infinite-n">
        <ul style="list-style-type:none; padding: 0">
            <?php $index=0; ?>
            <?php foreach ($uploads as $n_upload):?>
            <?php $n_upload['location_city']=explode(" ",$n_upload['location_city'])[0]; ?>
                <li id="diary_list_item<?php echo $index?>">
                    <div class="diary_post" id="diary_post<?php echo $index?>">
                        <div class="diary_post_info">
                            <div class="diary_post_time"> <p><?= $n_upload['time'] ?></p> </div>
                            <div class="diary_post_location"> <p><?= $n_upload['location_city'] ?></p></div>
                        </div>
                        <div>
                            <button onclick="expand_diary_details(<?php echo $index?>)" id="expand_diary_button<?php echo $index ?>" class="details_button expand_button diary_detail_button button_active">
                                <span class="material-icons view-details-icon">keyboard_arrow_down</span>
                            </button>
                            <button onclick="shrink_diary_details(<?php echo $index?>)" id="shrink_diary_button<?php echo $index ?>"  class="details_button shrink_button diary_detail_button">
                                <span class="material-icons view-details-icon">keyboard_arrow_up</span>
                            </button>
                        </div>
                    </div>

                    <div class="post diary_post_content" id="post<?php echo $index?>">
                        <div class="bg-image-wrapper">
                            <div class="bg-image" style="background-image:url(<?=$n_upload['picture']?>)"></div>
                        </div>
                        <div class="plant_image" style="background-image:url(<?=$n_upload['picture']?>)"></div>
                        <div class="post_information diary_post_information" id="diary_post_information<?php echo $index ?>">
                            <p class="scientific_name"><?=$n_upload['scientific_name']?></p>
                            <p class="common_name"><?=$n_upload['common_name']?></p>
                        </div>
                        <button onclick="expand_details(<?php echo $index?>)" id="expand_button<?php echo $index ?>" class="details_button expand_button">
                            <span class="material-icons view-details-icon">keyboard_arrow_down</span>
                        </button>
                        <button onclick="shrink_details(<?php echo $index?>)" id="shrink_button<?php echo $index ?>"  class="details_button shrink_button">
                            <span class="material-icons view-details-icon">keyboard_arrow_up</span>
                        </button>
                        <div class="post_details" id="post_detail<?php echo $index?>">
                            <p><?=$n_upload['comment']?></p>
                        </div>
                    </div>
                </li>
                <?php $index++; ?>
            <?php endforeach;?>
        </ul>
    </div>
</div>