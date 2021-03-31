let following_page_loading = 0;
let xhr1;
let total_cards_f = document.getElementById("all_uploads_count_f").value;
let cards_num_f =4;
let increment_num_f = 4;
document.cookie = "element_amount_f = " + cards_num_f;
document.cookie = "increment_amount_f = "+increment_num_f;

$(window).scroll(function() {
    const activeTabs = document.getElementsByClassName("active")
    const activeTab = activeTabs[0]
    if(activeTab.getAttribute("data-tab-target")==="#tab1") { //means we're at the following page
        if ($(window).scrollTop() + $(window).height() >= ($(document).height() / 2)) {
            if (following_page_loading === 0) {
                following_page_loading = 1
                console.log("reach bottom following");
                console.log("total observations following = " + total_cards_f);
                if (cards_num_f + 4 <= total_cards_f) {
                    cards_num_f = cards_num_f + 4;
                } else {
                    increment_num_f = total_cards_f-cards_num_f;
                    cards_num_f = cards_num_f + 4;
                    if(increment_num_f >0)addElementAjax_f();
                    else console.log("read out f");
                }

                console.log("current observations following = " + cards_num_f);
                console.log("current increment following = " + increment_num_n);
                if (cards_num_f <= total_cards_f) {
                    console.log("load more data following");
                    addElementAjax_f();
                }
            }
        }
    }
});

// $(document).ready(function(){
//     xhr1 = new XMLHttpRequest()
//     xhr1.onreadystatechange = myCallback_f
//     xhr1.open("GET", "https://a20ux5.studev.groept.be/activity_following?output=followingData", true)
//     xhr1.send()
// });


function addElementAjax_f(){
    xhr1 = new XMLHttpRequest()
    xhr1.onreadystatechange = myCallback_f
    xhr1.open("GET", "https://a20ux5.studev.groept.be/activity_following?output=followingData", true)
    xhr1.send()
}

function myCallback_f() {
    let post;
    if (xhr1.readyState === 4) {
        if (xhr1.status === 200) {
            following_page_loading = 0;
            var data=xhr1.responseText;
            // var jsonResponse = JSON.parse(data);
            post += data;
            var newElement = document.createElement('div');
            newElement.setAttribute('id', 'posts');
            newElement.innerHTML = post;
            document.getElementById("posts-infinite-f").appendChild(newElement);
            document.cookie = "element_amount_f = " + cards_num_f;
            document.cookie = "increment_amount_f = " + increment_num_f;
        } else {
            //alert("Message returned, error status: " +  xhr1.status + ".")
        }
    }
}

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}
