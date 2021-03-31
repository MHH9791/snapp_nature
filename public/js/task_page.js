// document.getElementById("addElement").addEventListener('mousedown', addElementAjax);
var task_counter = 0;
var element_amount = 0;
var batch_amount = 0;           //this is the amount of batches of elements (for example every time you scroll to the bottom)
document.cookie = "element_amount = 0";

let xhr

$(document).ready(function(){
    xhr = new XMLHttpRequest()
    xhr.onreadystatechange = myCallback
    xhr.open("GET", "https://a20ux5.studev.groept.be/tasks?output=json", true)
    xhr.send()
});

function load_a_tab(){
    xhr = new XMLHttpRequest()
    xhr.onreadystatechange = myCallback
    xhr.open("GET", "https://a20ux5.studev.groept.be/tasks?output=json", true)
    xhr.send()
}


function myCallback() {
    scrollbox.innerHTML = '';
    var task_post_querry_result = '<p></p> '

    if (xhr.readyState === 4) {
        if (xhr.status === 200) {
            batch_amount++;

            var data=xhr.responseText;
            var jsonResponse = JSON.parse(data);
            user_id = -1;
            user_id = document.getElementById("user_id_hidden").value;

            var i;
            var task_id = 0;
            var completed = 0;

            ///Determine which tab
            var tab;
            var active_tabs = document.getElementsByClassName("active");
            var active_tab = active_tabs[0];
            if(active_tab.getAttribute('data-tab-target') === "#tab0"){
                var element1 = document. getElementById("tab1");
                element1.style.display = "none";
                var element2 = document. getElementById("tab0");
                element2.style.display = "block";

                tab = "weekly";
            }
            else if(active_tab.getAttribute('data-tab-target') === "#tab1"){
                var element3 = document. getElementById("tab1");
                element3.style.display = "none";
                var element4 = document. getElementById("tab0");
                element4.style.display = "block";

                tab = "monthly";
            }
            ///Determine which tab


            for (i = 0; i < Object.keys(jsonResponse).length; i++) {

                console.log(jsonResponse[i]["idtask"]);

                // console.log(jsonResponse[i]["monthly"]);
                // console.log(jsonResponse[i]["monthly"] == 1);
                // console.log(tab === "monthly");
                // console.log(jsonResponse[i]["monthly"] === 1 && tab === "monthly");
                // console.log(jsonResponse[i]["weekly"] === 1 && tab === "weekly");
                // console.log(jsonResponse[i]["monthly"] === 1 && tab === "monthly" || jsonResponse[i]["weekly"] === 1 && tab === "weekly");
                // console.log("***");

                ///makes sure only the first time a task appears it is added
                if (jsonResponse[i]["idtask"] === task_id) {
                }
                else {
                    completed = is_it_completed(jsonResponse, jsonResponse[i]["idtask"], user_id);

                    var circle;
                    if (completed === 1) {
                        circle = '<div id="circlecompleted"></div>';
                        completed = 0;
                    }
                    else {
                        circle = '<a id="circleuncompleted" href="./addObservation"></a>';
                    }
                    if (jsonResponse[i]["monthly"] == 1 && tab === "monthly" || jsonResponse[i]["weekly"] == 1 && tab === "weekly") {
                        task_post_querry_result += '<div id=wrapper>';
                        task_post_querry_result += '<p id="task_title" >' + jsonResponse[i]["name"] + '</p>';
                        task_post_querry_result += circle;
                        task_post_querry_result += '</div>'
                        // task_post_querry_result += '<p id="task_location">' + jsonResponse[i]["location"] + '</p>';
                        task_post_querry_result += '<p id="task_description">' + jsonResponse[i]["description"] + '</p>';
                        // task_post_querry_result += '<p>' + jsonResponse[i]["duetime"] + '</p>';
                        task_post_querry_result += '<hr>';
                    }
                }
                task_id = jsonResponse[i]["idtask"];
            }

            var newElement = document.createElement('div');
            newElement.setAttribute('id', "task_element");
            newElement.innerHTML = task_post_querry_result;


            scrollbox.appendChild(newElement);


            // element_amount += Object.keys(jsonResponse).length;
            // document.cookie = "element_amount = " + element_amount;

        } else {
            //alert("Message returned, error status: " +  xhr.status + ".")
        }
    }
}

//Here it is checked whether a task is completed by the logged in user by looping through the database querry
function is_it_completed(json_elements, task_id, username_loggedin){
    for (i = 0; i < Object.keys(json_elements).length; i++) {
        if(json_elements[i]["idtask"] === task_id){
            if(json_elements[i]["iduser"] === username_loggedin){
                return 1;
            }
        }
    }
    return 0;
}


// function myCallback2() {
//     if (xhr.readyState === 4) {
//         if (xhr.status === 200) {
//             // console.log(xhr.responseText);
//             username =  xhr.responseText;
//         }
//     }
// }

// because the .getboundingclientrect().height method gets the height of the 'batch' (we upload a batch every time we reach the bottom of the page) we have to multiply it with the batch amount
// $(window).scroll(function() {
//     if(($(window).scrollTop() + $(window).height()) > (document.getElementById("task_element").getBoundingClientRect().height)*batch_amount) {
//         console.log("ik ben vanonder");
//         // addElementAjax();
//
//         //here block it for a bit!! (bottleneck) ->dont block scrolling
//
//     }
// });

// function getCookie(name) {
//     const value = `; ${document.cookie}`;
//     const parts = value.split(`; ${name}=`);
//     if (parts.length === 2){
//         return parts.pop().split(';').shift();
//     }
// }
