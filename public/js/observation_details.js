
function expand_details(index){
    let this_button;
    let target_post;
    let target_post_details;
    let corresponding_shrink_button;

    const active_tabs = document.getElementsByClassName("active");
    if(active_tabs.length == 0){ //we're at the diary page
        this_button = document.querySelector("#expand_button" + index)
        target_post = document.querySelector("#post" + index)
        target_post_details = document.querySelector("#post_detail" + index)
        corresponding_shrink_button = document.querySelector("#shrink_button" + index)
    }
    else {
        const active_tab = active_tabs[0];
        if (active_tab.getAttribute('data-tab-target') === "#tab0") { //means we're at the nearby tab
            this_button = document.querySelector("#n_expand_button" + index)
            target_post = document.querySelector("#n_post" + index)
            target_post_details = document.querySelector("#n_post_detail" + index)
            corresponding_shrink_button = document.querySelector("#n_shrink_button" + index)
        } else if (active_tab.getAttribute('data-tab-target') === "#tab1") { //means we're at the following tab
            this_button = document.querySelector("#f_expand_button" + index)
            target_post = document.querySelector("#f_post" + index)
            target_post_details = document.querySelector("#f_post_detail" + index)
            corresponding_shrink_button = document.querySelector("#f_shrink_button" + index)
        }
    }

    target_post.classList.add("detailed_post")
    target_post_details.classList.add("post_details_active")
    this_button.classList.remove("button_active")
    corresponding_shrink_button.classList.add("button_active")
}

function shrink_details(index){
    let this_button;
    let target_post;
    let target_post_details;
    let corresponding_expand_button;

    const active_tabs = document.getElementsByClassName("active");
    if(active_tabs.length == 0){ // we're at the diary page
        this_button = document.querySelector("#shrink_button" + index)
        target_post = document.querySelector("#post" + index)
        target_post_details = document.querySelector("#post_detail" + index)
        corresponding_expand_button = document.querySelector("#expand_button" + index)
    }
    else {
        const active_tab = active_tabs[0];
        if (active_tab.getAttribute('data-tab-target') === "#tab0") { //means we're at the nearby tab
            this_button = document.querySelector("#n_shrink_button" + index)
            target_post = document.querySelector("#n_post" + index)
            target_post_details = document.querySelector("#n_post_detail" + index)
            corresponding_expand_button = document.querySelector("#n_expand_button" + index)
        } else if (active_tab.getAttribute('data-tab-target') === "#tab1") { //means we're at the following tab
            this_button = document.querySelector("#f_shrink_button" + index)
            target_post = document.querySelector("#f_post" + index)
            target_post_details = document.querySelector("#f_post_detail" + index)
            corresponding_expand_button = document.querySelector("#f_expand_button" + index)
        }
    }

    target_post.classList.remove("detailed_post")
    target_post_details.classList.remove("post_details_active")
    this_button.classList.remove("button_active")
    corresponding_expand_button.classList.add("button_active")
}