document.querySelectorAll(".profile-picture__input").forEach(inputElement => {
    const profilePictureElement = inputElement.closest(".profile-picture");

    profilePictureElement.addEventListener("click", e => {
        inputElement.click();
    });

    profilePictureElement.addEventListener("change", e => {
        if(inputElement.files.length){
            updateThumbnail(profilePictureElement, inputElement.files[0]);
        }
    });

    profilePictureElement.addEventListener("dragover", e => {
        e.preventDefault();
    })

    profilePictureElement.addEventListener("drop", e => {
        e.preventDefault();
        if(e.dataTransfer.files.length){
            inputElement.files = e.dataTransfer.files;
            updateThumbnail(profilePictureElement, e.dataTransfer.files[0]);
        }
    })
});

function updateThumbnail(profilePictureElement, file){
    let thumbnailElement = profilePictureElement.querySelector(".profile-picture__thumb");
    // First time, remove prompt
    if(profilePictureElement.querySelector(".profile-picture__prompt")){
        profilePictureElement.querySelector(".profile-picture__prompt").remove();
    }
    // First time, there is no thumbnail element yet
    if(!thumbnailElement){
        thumbnailElement = document.createElement("div");
        thumbnailElement.classList.add("profile-picture__thumb");
        profilePictureElement.appendChild(thumbnailElement);
    }

    if(file.type.startsWith("image/")){
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => {
            thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
        };
    }
    else {
        // TODO: discard input and display pop up message that the input should be an image
        thumbnailElement.style.backgroundImage = null;
    }
}