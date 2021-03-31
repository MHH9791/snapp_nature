<div class="page-content" style="position: relative;
                                 align-items: baseline;
                                 margin-bottom: 250px">
    <?php foreach ($topTen as $leader) : ?>
        <div class="baseGrid">
            <div class="backgroundGrid" style="width: <?php echo 100*$leader->count/$maxCount->max,"%" ?> ; min-width: 150px">
                <div style="margin-left:5px; display: flex; flex-direction: row;">
                    <a href=<?php echo "/profile_page/".$leader->iduser?>>
                    <img alt="Profile picture" src="<?php echo $leader->icon?>" style="width:50px;height: 50px;border-radius: 50%" onerror="this.src='/Assets/blank-profile.svg'">
                    </a>
                    <div style="display: flex; flex-direction: column">
                        <a class="leaderboard-label"><?=$leader->username?></a>
                        <a class="leaderboard-label"><?=$leader->count?></a>
                    </div>

                </div>

            </div>
        </div>
    <?php endforeach;?>
</div>