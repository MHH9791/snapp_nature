let winCached = $(window),
    docCached = $(document)
let xhr2;
let total_cards_n = document.getElementById("all_uploads_count_n").value;
let cards_num_n =4;
let increment_num_n = 4;
let nearby_activity_loading = false
document.cookie = "element_amount_n = "+ cards_num_n ;
document.cookie = "increment_amount_n = "+increment_num_n;

$(window).scroll(function() {
    const activeTabs = document.getElementsByClassName("active")
    const activeTab = activeTabs[0]
    if(activeTab.getAttribute("data-tab-target")==="#tab0") { //means we're at the nearby page
    if($(window).scrollTop() + $(window).height() >= $(document).height()/2) {
        if (!nearby_activity_loading) {
            nearby_activity_loading = true
            console.log("reach bottom nearby");
            console.log("total observations nearby = " + total_cards_n);
            if (cards_num_n + 4 <= total_cards_n) {
                cards_num_n = cards_num_n + 4;
            } else {
                increment_num_n = total_cards_n-cards_num_n;
                cards_num_n = cards_num_n + 4;
                if(increment_num_n >0)addElementAjax_n();
                else console.log("read out n");
            }
            console.log("current increment nearby = " + increment_num_n);
            console.log("current observations nearby = " + cards_num_n);
            if (cards_num_n <= total_cards_n) {
                console.log("load more data nearby");
                addElementAjax_n();
            }
        }
    }
    }
});

// $(document).ready(function(){
//     xhr2 = new XMLHttpRequest()
//     xhr2.onreadystatechange = myCallback
//     xhr2.open("GET", "https://a20ux5.studev.groept.be/activity_nearby?output=moreData", true)
//     xhr2.send()
// });

function addElementAjax_n(){
    xhr2 = new XMLHttpRequest()
    xhr2.onreadystatechange = myCallback_n
    xhr2.open("GET", "https://a20ux5.studev.groept.be/activity_nearby?output=nearbyData", true)
    xhr2.send()
}

function myCallback_n() {
    var post ;
    if (xhr2.readyState === 4) {
        if (xhr2.status === 200) {
            console.log("success")
            nearby_activity_loading=false
            var data=xhr2.responseText;
            // var jsonResponse = JSON.parse(data);
            post += data;
            var newElement = document.createElement('div');
            newElement.setAttribute('id', 'posts');
            newElement.innerHTML = post;
            document.getElementById("posts-infinite-n").appendChild(newElement);
            document.cookie = "element_amount_n = " + cards_num_n;
            document.cookie = "increment_amount_n = " + increment_num_n;
            //
        } else {
            //alert("Message returned, error status: " +  xhr2.status + ".")
        }
    }
}


function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}
