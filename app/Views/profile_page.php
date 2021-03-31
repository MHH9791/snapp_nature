<head>
    <link href="/public/css/toast.css" rel="stylesheet" type="text/css"/>
    <script src="/public/js/toast.js"></script>
    <script>
        function submitIcon(filename){
            var extension=getExtension(filename);
            var allowedFiles = ["jpeg", "img", "jpg","png","gif"];
            var file=document.getElementById("profilePicture");
            var result=0;

            if(allowedFiles.indexOf(extension)>-1) {
                var maxFileSize=5*1024*1024; //5MB

                var fileSize=file.files[0].size;
                if(fileSize>maxFileSize)
                {
                    showToast("Please upload images that is smaller than 5MB");
                    file.value="";
                }
                else
                {
                    showToast("Updated avatar successfully");
                    result=1;
                }
            }
            else
            {
                showToast("Please upload an allowed file type: JPEG, IMG, JPG, PNG and GIF");
                file.value="";
            }

            if(result)
            {
                document.getElementById("uploadIcon").submit();
            }
            else
            {
                file.value="<?php echo $profile_picture?>"
            }
        }

        function getExtension(filename)
        {
            var parts=filename.split('.');
            return parts[parts.length-1];
        }

        window.onload = function ()
        {
            if(<?php echo $isMyProfile?>)
            {
                document.querySelector("#profilePicture").disabled=false;
            }
        };

    </script>

</head>
<div class="profile-content">

    <div class="profile-content-top">
        <div class="profile-overview-top">

            <div class="profile-picture">
                <form method="post" name="uploadIcon" id="uploadIcon" enctype="multipart/form-data">
                <span class="profile-picture__prompt" id="imageSpan"><img alt="Profile picture" id="profile_picture" src="<?php echo $profile_picture?>" style="height: 70px; width: 70px;"></span>
                <input disabled type="file" name="profilePicture" id="profilePicture" class="profile-picture__input" onchange="submitIcon(this.value)">
                    <input type="hidden" name="uploadIconFlag">
                </form>
            </div>

            <a href=<?php echo "/diary/".$targetId?> class="profile-number-box">
                <div class="profile-number-label">
                    <?php echo lang('text.observed')?>
                </div>

                <div class="profile-number">
                    <?php  echo $observation_number?>
                </div>
            </a>

            <a href=<?= "/following_list/".$targetId?> class="profile-number-box">
                <div class="profile-number-label">
                    <?php echo lang('text.lowercase_following')?>
                </div>

                <div class="profile-number">
                    <?php  echo $following_number?>
                </div>
            </a>

            <a href=<?= "/follower_list/".$targetId?> class="profile-number-box">
                <div class="profile-number-label">
                    <?php echo lang('text.follow_by')?>
                </div>

                <div class="profile-number">
                    <?php echo $follower_number?>
                </div>
            </a>
        </div>

        <div class="profile-overview-bottom">

            <div class="column profile-username-box">

                <div class="profile-username-label">
                    <?php echo lang('text.lowercase_username')?>
                </div>

                <div class="profile-username">
                    <?php echo $username?>
                </div>

            </div>

            <div class="column"></div>

            <div class="column"></div>
            <div class="column" style="flex:1.25;">
            <?php if(is_array($followingIds)) :?>
                <?php foreach ($followingIds as $followingId):?>
                    <?php if($followingId['target_id'] == $targetId) :?>
                        <?php $profile_interact_button = "unfollow"; ?>
                    <?php endif;?>
                <?php endforeach;?>

                <?php if(isset($isMyProfile)):?>
                <?php if(!$isMyProfile):?>
                <button onclick="myFunction(<?= $senderId ?>, <?= $targetId ?>)" class="column profile-interact-button profile-topbar-button" id = 'follow_button'><?php echo $profile_interact_button?></button>
                    <?php endif; ?>
                <?php endif; ?>
                <?php endif;?>
            </div>

        </div>

    </div>



    <div class="profile-content-main">

        <?php if(isset($isMyProfile)):?>
        <?php if($isMyProfile):?>
        <form method="post" class="profile-content-item follow-username-wrapper" id="follow-username" enctype="multipart/form-data">
            <input class = "follow-username-inputbox" type="text" name="follow-username" placeholder='<?php echo lang('text.lowercase_username_to_follow')?>'>
            <button onclick="followUser()" class="profile-interact-button add-follow-button"><?php echo lang('text.follow')?></button>
        </form>
        <?php endif; ?>
        <?php endif; ?>



        <div class="profile-content-item">
            <div class="profile-content-label">
                <div class="profile-content-label-text" id="profile_bio_label">
                    <?php echo lang('text.bio')?>
                </div>
                <?php if($targetId == $senderId) :?>
                    <button onclick="startEditBio()" style="position: relative; right: 3px;" class="column profile-interact-button profile-topbar-button edit_button button_active" id ="start_edit_bio_button">edit</button>
                    <button onclick="finishEditBio()" style="position: relative; right: 3px;" class="column profile-interact-button profile-topbar-button edit_button" id ="finish_edit_bio_button">finish</button>
                <?php endif;?>
            </div>

            <form method="post" name="uploadBio" id="uploadBio" enctype="multipart/form-data">
            <div class="profile-content-box" id="profile_bio_content_box">
                <textarea disabled id="profile_bio_textarea" name="profile_bio_textarea" class="profile-box-content"><?php echo $userbio?></textarea>
            </div>
                <input type="hidden" name="uploadBioFlag">
            </form>
        </div>

        <div class = "profile_content_badges slideshow-container" >

            <div class="mySlides fade">
                <div class="myBadge distinct_observation_badge" style="margin-left: auto;margin-right: auto">
                    <?php if($distinct_ob_number >= 5) :?>
                        <img alt="Badges picture" class="badge_pic" src="/Assets/distinct_observation.png" width="80" height="80">
                        <h3 class = "caption_observation caption_badge_complete" >Achieved: 5 unique observations</h3>
                    <?php else :?>
                        <img alt="Badges picture" src="/Assets/distinct_observation.png" style="filter:grayscale(1)" width="80" height="80">
                        <h3 class = "caption_observation" >Make 5 unique observations</h3>
                    <?php endif;?>

                </div>
            </div>

            <div class="mySlides fade">
                <div class="myBadge ollow_others_badge" style="margin-left: auto;margin-right: auto">
                    <?php if($following_number >= 5) :?>
                        <img alt="Badges picture" class="badge_pic" src="/Assets/follow_others.png" width="80" height="80">
                        <h3 class = "caption_observation caption_badge_complete" >Achieved: Following 5 people</h3>
                    <?php else :?>
                        <img alt="Badges picture" src="/Assets/follow_others.png" style="filter:grayscale(1)" width="80" height="80">
                        <h3 class = "caption_observation" >Follow 5 people</h3>
                    <?php endif;?>

                </div>
            </div>

            <div class="mySlides fade">
                <div class="myBadge followed_by_others_badge" style="margin-left: auto;margin-right: auto">
                    <?php if($follower_number >= 5) :?>
                        <img alt="Badges picture" class="badge_pic" src="/Assets/followed_by_others.png" width="80" height="80">
                        <h3 class = "caption_observation caption_badge_complete" >Achieved: 5 followers</h3>
                    <?php else :?>
                        <img alt="Badges picture" src="/Assets/followed_by_others.png" style="filter:grayscale(1)"width="80" height="80">
                        <h3 class = "caption_observation" >Have 5 followers</h3>
                    <?php endif;?>

                </div>
            </div>

            <div class="mySlides fade">
                <div class="myBadge observation_badge" style="margin-left: auto;margin-right: auto">
                    <?php if($observation_number >= 10) :?>
                        <img alt="Badges picture" class="badge_pic" src="/Assets/observation.png" width="80" height="80">
                        <h3 class = "caption_observation caption_badge_complete" >Achieved: 10 unique observations</h3>
                    <?php else :?>
                        <img alt="Badges picture" src="/Assets/observation.png" style="filter:grayscale(1)" width="80" height="80">
                        <h3 class = "caption_observation" >Make 10 unique observations</h3>
                    <?php endif;?>

                </div>
            </div>

            <div class="mySlides fade">
                <div class="myBadge tasks_badge" style="margin-left: auto;margin-right: auto">
                    <?php if($task_number >= 5) :?>
                        <img alt="Badges picture" class="badge_pic" src="/Assets/tasks.png" style="filter: invert(18%) sepia(35%) saturate(373%) hue-rotate(104deg) brightness(92%) contrast(91%);" width="80" height="80">
                        <h3 class = "caption_observation caption_badge_complete">Achieved: 5 Tasks</h3>
                    <?php else :?>
                        <img alt="Badges picture" src="/Assets/tasks.png" style="filter:grayscale(1)" width="80" height="80">
                        <h3 class = "caption_observation">Complete 5 tasks</h3>
                    <?php endif;?>
                </div>
            </div>

            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>


        <?php if($targetId == $senderId) :?>
        <br>
        <br>

            <a style="color: cornflowerblue" href="<?= base_url()?>/changePassword">Change password</a>
        <?php endif;?>
    </div>

</div>

<script src="/public/js/add_profile_picture.js"></script>