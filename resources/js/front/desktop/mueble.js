const plusButton = document.getElementById('plus-button');
const descriptionElement = document.querySelector(".description-container");
const movingWrap = document.querySelector(".moving-wrap");

if(plusButton){

    plusButton.addEventListener("click", () => {

        movingWrap.classList.toggle("active");
        descriptionElement.classList.toggle("active");
        

    });

}
    