
var upload_counter = 0;
var element_amount = 0;
var batch_amount = 0;           //this is the amount of batches of elements (for example every time you scroll to the bottom)
document.cookie = "element_amount = 0";

let xhr1

$(document).ready(function(){
    xhr1 = new XMLHttpRequest()
    xhr1.onreadystatechange = myCallback
    // xhr.open("GET", "http://localhost/public/snapp/tasks?output=JSON", true)
    // xhr.open("GET", "http://10.39.193.44/public/snapp/tasks?output=json", true)
    // xhr.open("GET", "https://a20ux5.studev.groept.be/public/snapp/tasks?output=json", true)
    xhr1.open("GET", "https://a20ux5.studev.groept.be/activity?output=json", true)
    xhr1.send()
});


function addElementAjax(){
    xhr1 = new XMLHttpRequest()
    xhr1.onreadystatechange = myCallback
    // xhr.open("GET", "http://localhost/public/snapp/tasks?output=JSON", true)
    // xhr.open("GET", "http://10.39.193.44/public/snapp/tasks?output=json", true)
    // xhr.open("GET", "https://a20ux5.studev.groept.be/public/snapp/tasks?output=JSON", true)
    xhr1.open("GET", "https://a20ux5.studev.groept.be/activity?output=json", true)
    xhr1.send()
}

function myCallback() {
    var post = '<ul style="list-style-type:none; padding: 0">\n';
    if (xhr1.readyState === 4) {
        if (xhr1.status === 200) {
            batch_amount++;
            var data=xhr1.responseText;
            var jsonResponse = JSON.parse(data);
            // console.log(jsonResponse[0]["name"]);

            for (var i = 0; i < Object.keys(jsonResponse).length; i++) {

                post += '<li>\n' +
                    '<div class="post">\n' +
                    '    <div class="bg-image-wrapper"> \n'+
                    '      <div class="bg-image" style="background-image:url('+ jsonResponse[i]['picture']+ ')">\n'+
                    '    </div> \n'+
                    '    </div>\n'+
                    '    <div class="plant_image" style="background-image:url('+ jsonResponse[i]['picture']+ ')"></div>\n'+
                    '    <a class="posting_user" href="/profile_page/' + jsonResponse[i]['iduser'] + ' " >\n' +
                    '        <img src=' + jsonResponse[i]['picture'] + ' >\n' +
                    '        <p class="posting_user_name" style="margin-left: 5%;">' + jsonResponse[i]['username'] + '</p>\n' +
                    '    </a>\n' +
                    '\n' +
                    '    <div class="post_information">\n' +
                    '        <p class="common_name">'+ jsonResponse[i]['common_name'] +'</p>\n' +
                    '        <p class="scientific_name">'+ jsonResponse[i]['scientific_name'] +'</p>\n' +
                    '        <div class="like_comment_box">\n' +
                    '            <button class="comment_box">\n' +
                    '                <i class="material-icons-outlined" style="margin-right: 3px">comment</i>\n' +
                    '                <p>Comment</p>\n' +
                    '            </button>\n' +
                    '            <button class="like_box">\n' +
                    '                <i class="material-icons-outlined" style="margin-right: 3px">thumb_up</i>\n' +
                    '                <p>Like</p>\n' +
                    '            </button>\n' +
                    '        </div>\n' +
                    '    </div>\n' +
                    '\n' +
                    '    <p class="post_time">'+ jsonResponse[i]['time'] +'</p>\n' +
                    '    <a class="view_details_link" href="">\n' +
                    '        <p>VIEW DETAILS</p>\n' +
                    '    </a>\n' +
                    '</div>\n' +
                    '</li>\n';



            }
            post += '</ul>';
            var newElement = document.createElement('div');
            newElement.setAttribute('id', 'posts');
            newElement.innerHTML = post;
            document.getElementById("scrollbox").appendChild(newElement);
            //
            //
            // scrollbox.appendChild(newElement);

            element_amount += Object.keys(jsonResponse).length;
            document.cookie = "element_amount = " + element_amount;
            //
        } else {
            //alert("Message returned, error status: " +  xhr1.status + ".")
        }
    }
}

$(window).scroll(function() {
    if(($(window).scrollTop() + $(window).height()) > (document.getElementById("posts").getBoundingClientRect().height)*batch_amount) {
        console.log("ik ben vanonder");
        addElementAjax();
    }
});

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}


// <div class="post" style="background-image:linear-gradient(180deg, #253933 0%, rgba(90, 90, 90, 0) 15.62%, rgba(111, 111, 111, 0) 62.5%, #FFFFFF 75.52%) ,url(<?=$upload['picture']?>)">
//     <a class="posting_user" href="#" >
//         <img src=<?=$upload['picture']?> >
//         <p class="posting_user_name" style="margin-left: 5%;"><?=$username?></p>
//     </a>
//
//     <div class="post_information">
//         <p class="common_name"><?="Common Name"?></p>
//         <p class="scientific_name"><?=$upload['common_name']?></p>
//         <div class="like_comment_box">
//             <button class="comment_box">
//                 <i class="material-icons-outlined" style="margin-right: 3px">comment</i>
//                 <p>Comment</p>
//             </button>
//             <button class="like_box">
//                 <i class="material-icons-outlined" style="margin-right: 3px">thumb_up</i>
//                 <p>Like</p>
//             </button>
//         </div>
//     </div>
//
//     <p class="post_time"><?=$upload['time']?></p>
//     <a class="view_details_link" href="<?=""?>">
//         <p>VIEW DETAILS</p>
//     </a>
// </div>