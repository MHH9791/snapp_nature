function expand_diary_details(index){
    let this_button = document.querySelector("#expand_diary_button" + index)
    let target_diary_post = document.querySelector("#post" + index)
    let corresponding_shrink_button = document.querySelector("#shrink_diary_button" + index)
    let show_post_detail_button = document.querySelector("#expand_button"+index)
    let diary_post_information = document.querySelector("#diary_post_information"+index)
    let diary_list_item = document.querySelector("#diary_list_item"+index)

    diary_list_item.classList.add("active_li")
    target_diary_post.classList.add("diary_post_content_active")
    this_button.classList.remove("button_active")
    corresponding_shrink_button.classList.add("button_active")
    show_post_detail_button.classList.add("button_active")
    diary_post_information.classList.remove("diary_post_information")
}

function shrink_diary_details(index){
    shrink_details(index)
    
    let this_button = document.querySelector("#shrink_diary_button" + index)
    let target_diary_post = document.querySelector("#post" + index)
    let corresponding_expand_button = document.querySelector("#expand_diary_button" + index)
    let shrink_post_detail_button = document.querySelector("#shrink_button"+index)
    let show_post_detail_button = document.querySelector("#expand_button"+index)
    let diary_post_information = document.querySelector("#diary_post_information"+index)
    let diary_list_item = document.querySelector("#diary_list_item"+index)

    diary_list_item.classList.remove("active_li")
    target_diary_post.classList.remove("diary_post_content_active")
    this_button.classList.remove("button_active")
    corresponding_expand_button.classList.add("button_active")
    show_post_detail_button.classList.remove("button_active")
    shrink_post_detail_button.classList.remove("button_active")
    diary_post_information.classList.add("diary_post_information")
}