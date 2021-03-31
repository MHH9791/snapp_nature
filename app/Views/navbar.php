<a href="<?= base_url()?>/activity" class="nav__link
    <?php if(isset($active_navbar_item)):
        if($active_navbar_item == 'activity'):
            echo "nav__link_selected";
        endif;
    endif;
    ?>">
    <img class="nav__icon " src="../../Assets/icons/pin%20simple%20outlined%20green.svg" alt=<?php echo lang('text.activity')?>>
    <span class="nav__text">
            <?php echo lang('text.activity')?>
        </span>
</a>

<a href="<?= base_url()?>/diary" class="nav__link
    <?php if(isset($active_navbar_item)):
        if($active_navbar_item == 'diary'):
            echo "nav__link_selected";
        endif;
    endif;
    ?>">
    <img class="nav__icon" src="../../Assets/icons/diary%20simple%20outlined.svg" alt=<?php echo lang('text.diary')?>>
    <span class="nav__text">
            <?php echo lang('text.diary')?>
        </span>
</a>

<a href="<?= base_url()?>/addObservation" class="nav__link" style="min-height: 63px; position: relative; top: -5px;">
    <i style="font-size: 54px" class="material-icons nav__icon">add_circle_outline</i>
</a>

<a href="<?= base_url()?>/tasks" class="nav__link
    <?php if(isset($active_navbar_item)):
        if($active_navbar_item == 'tasks'):
            echo "nav__link_selected";
        endif;
    endif;
    ?>">
    <img class="nav__icon" src="../../Assets/icons/hiking%20simple%20outlined.svg" alt=<?php echo lang('text.tasks')?>>
    <span class="nav__text">
            <?php echo lang('text.tasks')?>
        </span>
</a>

<a href="<?= base_url()?>/leaderboard" class="nav__link
    <?php if(isset($active_navbar_item)):
        if($active_navbar_item == 'leaderboard'):
            echo "nav__link_selected";
        endif;
    endif;
    ?>">
    <img class="nav__icon" src="../../Assets/icons/trekking-pole%20simple%20outlined.svg" alt=<?php echo lang('text.leaderboard')?>>
    <span class="nav__text">
            <?php echo lang('text.leaderboard')?>
        </span>
</a>