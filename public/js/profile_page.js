function myFunction(sender, target) {
    console.log("Clicked following button");
    console.log(sender);
    console.log(target);
    var content = document.getElementById("follow_button").innerHTML;
    var fields;
    console.log(content);
    if (content === 'follow')
    {
        var MyAppUrlSettings = {
            MyUsefulUrl : '@Url.Action("follow","Snapp")'
        }
        document.getElementById("follow_button").innerHTML = 'unfollow';
        fields = {
            userId  : sender,
            targetId  : target,
            submit_a: true
        };

        $.ajax({
            url: "/follow",
            type: 'POST',
            data: fields,
            dataType:'JSON',
            success: function(result){
                console.log("success");
            }
        });
    }
    else if(content === 'unfollow')
    {
        var MyAppUrlSettings = {
            MyUsefulUrl: '@Url.Action("follow","Snapp")'
        }
        document.getElementById("follow_button").innerHTML = 'follow';
        fields = {
            userId  : sender,
            targetId  : target,
            submit_a: true
        };

        $.ajax({
            url: '/unfollow',
            type: 'POST',
            data: fields,
            dataType:'JSON',
            success: function(result){
                console.log("success");
            }
        });
    }
}

const start_edit_bio_button = document.querySelector("#start_edit_bio_button")
const finish_edit_bio_button = document.querySelector("#finish_edit_bio_button")
const profile_picture = document.querySelector("#profile_picture")
const bio_label = document.querySelector("#profile_bio_label")
const bio_textarea = document.querySelector("#profile_bio_textarea")
const bio_textarea_box = document.querySelector("#profile_bio_content_box")
const profile_picture_input = document.querySelector(".profile-picture__input")

function startEditBio(){
    bio_label.classList.add("editable_bio_label")
    bio_textarea_box.classList.add("editable_textarea_box")
    start_edit_bio_button.classList.remove("button_active")
    finish_edit_bio_button.classList.add("button_active")

    bio_textarea.disabled = false
}

function finishEditBio(){
    submitBio();
    bio_label.classList.remove("editable_bio_label")
    bio_textarea_box.classList.remove("editable_textarea_box")
    start_edit_bio_button.classList.add("button_active")
    finish_edit_bio_button.classList.remove("button_active")
    bio_textarea.disabled = true
}

function submitBio(){
    document.getElementById("uploadBio").submit();
}




