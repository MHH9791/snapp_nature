<script src="/public/js/jquery-3.5.1.js"></script>

<head>
    <script src="/public/js/confirm_picture.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-_YxO3DYsW0TG5gzTDhIurL2Tm7dmV3Y"></script>
    <script>
        window.onload=function ()
        {
            getLocation()
        }

        function hideLocation(cb){
            const location_input_box = document.getElementById("location_address")
            if(cb.checked){
                //hide location
                location_input_box.style.display = "none";
            }
            else{
                //unhide location
                location_input_box.style.display = "initial";
            }
        }


        function confirmObservation()
        {
            document.getElementById("confirm_upload").submit();
        }


    </script>
</head>

<form style="margin-top:114px;" method="post" class="observation_inputs" id="confirm_upload" enctype="multipart/form-data">
    <input class = "obs_input_box" type="text" id="species" name="species" placeholder="<?php echo lang('text.species_name')?>" value="<?php echo $scientific_name?>" readonly>

    <div class = "obs_input_box" style="margin-bottom: -20px;">
        <input type="checkbox" onchange="hideLocation(this)" id="no_location_checkbox" name="no_location_checkbox"
               style="width: 20px;
               height: 20px;
               position: relative;
               top:5px;">
        <label for="no_location" style="margin-left:10px; font-size: 15px; font-weight: bold"><?php echo lang('text.no_location_checkbox')?></label>
    </div>

    <input class = "obs_input_box" type="text" id="location_address" name="location_address" placeholder=<?php echo lang('text.location')?> value="" readonly>
    <input class = "obs_input_box" type="date" id="time" name="time" placeholder=<?php echo lang('text.date')?> value="<?php echo $today?>">
    <textarea class = "obs_input_box" placeholder=<?php echo lang('text.description')?> name="comment" ></textarea>
    <div class = "obs_input_box">
        <input type="checkbox" id="only_diary" name="only_diary"
               style="width: 20px;
               height: 20px;
               position: relative;
               top:5px;">
        <label for="only_diary" style="margin-left:10px; font-size: 15px; font-weight: bold"><?php echo lang('text.check_permission')?></label>
    </div>
    <input class = "obs_input_box" style="display: none" type="text" id="location" name="location" value="">

    <input style="display: none" id="imgSrc" name="imgSrc" value="<?php echo $imgSrc?>">
    <input style="display: none" id="return_img" name="return_img" value="<?php echo $return_img?>">
    <input style="display: none" id="wiki_url" name="wiki_url" value="<?php echo $wiki_url?>">
    <input style="display: none" id="common_name" name="common_name" value="<?php echo $common_name?>">
    <input style="display: none" id="scientific_name" name="scientific_name" value="<?php echo $scientific_name?>">
    <input style="display: none" id="wiki_description" name="wiki_description" value="<?php echo $wiki_description?>">

    <button onclick="confirmObservation()" class="confirm_button">
        <?php echo lang('text.confirm') ?>
    </button>

</form>
