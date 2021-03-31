
    <link rel="stylesheet" href="/public/css/task_page.css">

    <?php if (isset($scripts_to_load)) foreach ($scripts_to_load as $script): ?>
        <script src="/public/js/<?=$script?>" defer></script>
    <?php endforeach; ?>



    <div class="task_page">
        <div id="scrollbox"></div>

</div>

<input type="hidden" id="user_id_hidden" value=<?=$user_id?>>

