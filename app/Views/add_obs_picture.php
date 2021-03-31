<head>
    <link href="/public/css/toast.css" rel="stylesheet" type="text/css"/>
    <script src="/public/js/toast.js"></script>
    <script>

        window.onload=function ()
        {
            //alert(language)
            var empty=<?php echo $empty_image?>;
            if(empty) {
                showToast("You should upload a picture to be able to continue");
            }
        }

        function getExtension(filename)
        {
            var parts=filename.split('.');
            return parts[parts.length-1];
        }
        function fileValidation(filename) {

            var extension=getExtension(filename);
            var allowedFiles = ["jpeg", "img", "jpg","png","gif"];
            var file=document.getElementById("picture");

            if(allowedFiles.indexOf(extension)>-1) {
                var maxFileSize=5*1024*1024; //5MB

                var fileSize=file.files[0].size;

                if(fileSize>maxFileSize)
                {
                    showToast("Please upload images that is smaller than 5MB");
                    file.value="";
                }
                else{
                    const button = document.querySelector('button');
                    button.disabled = false;
                }

            }
            else
            {
                showToast("Please upload an allowed file type: JPEG, IMG, JPG, PNG and GIF");
                file.value="";
            }
        }

        function submitObservation()
        {
            document.getElementById("uploadObservation").submit();
        }

    </script>
</head>

<body>
    <form method="post" class="observation_inputs" id="uploadObservation" enctype="multipart/form-data">
        <div class="drop-zone">
            <span class="drop-zone__prompt"><?php echo lang('text.add_observation_msg')?></span>
            <input type="file" name="picture" id="picture" class="drop-zone__input" onchange="fileValidation(this.value)">
        </div>
        <input style="display: none" id="add_obs_picture_flag" name="add_obs_picture_flag" value="">

        <button disabled onclick="submitObservation()" class="forward_button">
            <?php echo lang('text.forward') ?>
        </button>
    </form>
</body>



<script src="/public/js/add_obs_picture.js"></script>

