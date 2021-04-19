const errorButton = document.getElementById('close-errors-button');

errorButton.addEventListener("click", () => {
    console.log("close");

    let activeElements = document.querySelectorAll(".active");
    
    if(errorButton.classList.contains("active")){

        errorButton.classList.remove("active");
    }else{
        activeElements.forEach(activeElement => {
            activeElement.classList.remove("active");
        });
    }
})