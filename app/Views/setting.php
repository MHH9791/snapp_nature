<link rel="stylesheet" href="/public/css/settings_style.css">

<form method="post" class="setting_upload" id="setting_upload">
    <div class="language_selection">
        <div class="flag-container">
            <input type="checkbox" id="en" name="en" onclick="clicked_en()"><label for="en">English</label>
        </div>

        <div class="flag-container">
            <input type="checkbox" id="tk" name="tk" onclick="clicked_tk()"><label for="tk">Türkçe</label>
        </div>

        <div class="flag-container">
            <input type="checkbox" id="be" name="be" onclick="clicked_be()"><label for="be" >Nederlands</label>
        </div>

        <div class="flag-container">
            <input type="checkbox" id="cn" name="cn" onclick="clicked_cn()"><label for="cn" >简体中文</label>
        </div>
    </div>

    <input class="confirm_button" type="submit" value=<?php echo lang('text.confirm') ?>>
</form>

<script type="text/javascript">
    function clicked_en()
    {
        document.getElementById("en").checked=true;
        document.getElementById("be").checked=false;
        document.getElementById("tk").checked=false;
        document.getElementById("cn").checked=false;
    }
    function clicked_be()
    {
        document.getElementById("en").checked=false;
        document.getElementById("be").checked=true;
        document.getElementById("tk").checked=false;
        document.getElementById("cn").checked=false;
    }
    function clicked_tk()
    {
        document.getElementById("en").checked=false;
        document.getElementById("be").checked=false;
        document.getElementById("tk").checked=true;
        document.getElementById("cn").checked=false;
    }
    function clicked_cn()
    {
        document.getElementById("en").checked=false;
        document.getElementById("be").checked=false;
        document.getElementById("tk").checked=false;
        document.getElementById("cn").checked=true;
    }

</script>
