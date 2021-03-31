<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
<script src="../../public/js/rating_stars.js" defer></script>
<link href="/public/css/toast.css" rel="stylesheet"  type="text/css"/>
<script src="/public/js/toast.js"></script>

<div class="observation_result">
    <img alt="Plant picture" class="observed_img" src="<?php echo $picture?>">
    <a class="wiki_link" target="_blank" href="<?php echo $wiki_url?>">
        <h1><?php echo $scientific_name?></h1>
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/80/Wikipedia-logo-v2.svg/1200px-Wikipedia-logo-v2.svg.png" alt="Wikipedia-logo-v2.svg">
    </a>
    <p class="wiki_info">
        <?php echo $wiki_description?>
    </p>
    <h2 class="rate_observation">Please rate this observation </h2>
    <form method="post" class="" id="uploadScore">
        <div class = "rating_stars" data-rating>
            <span class="material-icons score_icon" id="submit_1"  onclick="submit_1()">grade</span>
            <span class="material-icons score_icon" id="submit_2"  onclick="submit_2()">grade</span>
            <span class="material-icons score_icon" id="submit_3"  onclick="submit_3()">grade</span>
            <span class="material-icons score_icon" id="submit_4"  onclick="submit_4()">grade</span>
            <span class="material-icons score_icon" id="submit_5"  onclick="submit_5()">grade</span>
        </div>
        <input  style="display:none" id="score" name="score" value=0>
        <input  style="display:none" id="insert_id" name="insert_id" value="<?php echo $insert_id?>">
    </form>
</div>

<script>
    function submit_1()
    {
        document.getElementById("score").value=1;
        showToast('Thanks for rating!');
        document.getElementById("uploadScore").submit();
    }
    function submit_2()
    {
        document.getElementById("score").value=2;
        showToast('Thanks for rating!');
        document.getElementById("uploadScore").submit();
    }
    function submit_3()
    {
        document.getElementById("score").value=3;
        showToast('Thanks for rating!');
        document.getElementById("uploadScore").submit();
    }
    function submit_4()
    {
        document.getElementById("score").value=4;
        showToast('Thanks for rating!');
        document.getElementById("uploadScore").submit();
    }
    function submit_5()
    {
        document.getElementById("score").value=5;
        showToast('Thanks for rating!');
        document.getElementById("uploadScore").submit();
    }
</script>

