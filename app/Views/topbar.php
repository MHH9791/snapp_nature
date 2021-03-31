<a href="/profile_page" class="nav__link">
    <?php if(isset($isLoggedIn)):?>
        <?php if($isLoggedIn):?>
            <img class="nav__icon" src="../../Assets/icons/backpacker%20simple.svg" alt=<?php echo lang('text.profile')?>>
            <span class="nav__text">
                   <?php echo lang('text.profile')?>
            </span>
        <?php else:?>
            <div class="nav__icon login_button" alt=<?php echo lang('text.login')?>>
                <?php echo lang('text.log')?><br><?php echo lang('text.in')?>
            </div>
        <?php endif?>
    <?php else:?>
        <div class="nav__icon login_button">
            <?php echo lang('text.log')?><br><?php echo lang('text.in')?>
        </div>
    <?php endif?>
</a>

<a href="/activity" class="nav__link" style="min-width: 51.25vw; margin-left: 9px; margin-right: 9px">
    <img class="nav__icon"
         style="max-width: 100%; max-height: 33px"
         src="../../Assets/logo.svg" alt="snapp_logo">
</a>

<a href="<?= base_url()?>/settings" class="nav__link">
    <img class="nav__icon" src="../../Assets/icons/backpack%20simple.svg" alt=<?php echo lang('text.settings')?>>
    <span class="nav__text">
            <?php echo lang('text.settings')?>
        </span>
</a>