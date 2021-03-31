var tab = document.getElementsByClassName("active")[0]
show_following_activity()

function tab_active(){
    var active_tabs = document.getElementsByClassName("active")
    var active_tab = active_tabs[0]
    tab = active_tab

    if(active_tab.getAttribute('data-tab-target') == "#tab0"){
        console.log("You are on the following tab")
        show_following_activity()
    }
    else if(active_tab.getAttribute('data-tab-target') == "#tab1"){
        console.log("You are on the nearby tab")
        show_nearby_activity()
    }
}


function show_following_activity()
{
    console.log('in tab0');
    let xhr1;
    let total_cards_f = document.getElementById("all_uploads_count_f").value;
    let cards_num_f =0;
    document.cookie = "element_amount_f = 2";
    $(window).scroll(0)
    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() >= $(document).height()){
            console.log("reach bottom following");
            console.log("total observations following = " + total_cards_f);
            if(cards_num_f + 2 <= total_cards_f)
            {
                cards_num_f = cards_num_f + 2;
            }
            else{
                cards_num_f = total_cards_f;
            }

            console.log("current observations following = " + cards_num_f);
            if (cards_num_f < total_cards_f) {
                console.log("load more data following");
                addElementAjax_f();
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
                var data=xhr1.responseText;
                // var jsonResponse = JSON.parse(data);
                post += data;
                var newElement = document.createElement('div');
                newElement.setAttribute('id', 'posts');
                newElement.innerHTML = post;
                document.getElementById("posts-infinite-f").appendChild(newElement);
                document.cookie = "element_amount_f = " + cards_num_f;
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
}


function show_nearby_activity()
{
    console.log('in tab1');
    let xhr2;
    let total_cards_n = document.getElementById("all_uploads_count_n").value;
    let cards_num_n =2;
    document.cookie = "element_amount_n = 2";
    $(window).scroll(0)
    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() >= $(document).height()){
            console.log("reach bottom nearby");
            console.log("total observations nearby = " + total_cards_n);
            if(cards_num_n + 2 <= total_cards_n)
            {
                cards_num_n = cards_num_n + 2;
            }
            else{
                cards_num_n = total_cards_n;
            }
            console.log("current observations nearby = " + cards_num_n);
            if (cards_num_n <= total_cards_n) {
                console.log("load more data nearby");
                addElementAjax_n();
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
                var data=xhr2.responseText;
                // var jsonResponse = JSON.parse(data);
                post += data;
                var newElement = document.createElement('div');
                newElement.setAttribute('id', 'posts');
                newElement.innerHTML = post;
                document.getElementById("posts-infinite-n").appendChild(newElement);
                document.cookie = "element_amount_n = " + cards_num_n;
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
}
