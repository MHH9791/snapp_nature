document.addEventListener('DOMContentLoaded', function (){
    let stars = document.querySelectorAll('.score_icon');
    stars.forEach(function (star){
        star.addEventListener('click', setRating);
        star.addEventListener('mouseover', colorStars);
        star.addEventListener('mouseout', removeColor);
    });

    let rating = parseInt(document.querySelector('.rating_stars').getAttribute('data-rating'));
    let target = stars[rating - 1];

    target.dispatchEvent(new MouseEvent('click'));
    target.dispatchEvent(new MouseEvent('mouseover'));
    target.dispatchEvent(new MouseEvent('mouseout'));
});

function setRating(ev){
    let span = ev.currentTarget;
    let stars = document.querySelectorAll(".score_icon");
    let match = false;
    let num = 0;
    stars.forEach(function (star, index){
        if(match) {
            star.classList.remove('rated');
        }
        else{
            star.classList.add('rated');
        }
        if(star === span){
            match = true;
            num = index +1;
        }
    })
    document.querySelector('.rating_stars').setAttribute('data-rating', num);
    console.log("you choose "+num);
}

function colorStars(ev){
    let span = ev.currentTarget;
    let stars = document.querySelectorAll(".score_icon");
    let match = false;
    stars.forEach(function (star, index){
        if(match) {
            star.classList.remove('onHover');
        }
        else{
            star.classList.add('onHover');
        }
        if(star === span){
            match = true;
        }
    })
}

function removeColor(ev){
    let stars = document.querySelectorAll(".score_icon");
    stars.forEach(function (star, index){
        star.classList.remove('onHover');
    })
}