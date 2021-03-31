<div class="profile-topbar">

    <?php if($targetId == $senderId) :?>
        <a class="back-button" href="<?= base_url()?>/activity">
    <?php else: ?>
    <a class="back-button" href="javascript:history.back()">
        <?php endif; ?>

        <?php echo lang('text.back')?>
    </a>

    <a class="logout_button" href="<?= base_url()?>/logout">
        <?php echo lang('text.logout')?>
    </a>

</div>