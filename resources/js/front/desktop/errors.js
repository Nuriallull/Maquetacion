const errorButton = document.getElementById('close-errors-button');

if(errorButton){

    errorButton.addEventListener("click", () => {
    
        let activeElements = document.querySelectorAll(".active");
        
        if(errorButton.classList.contains("active")){
    
            errorButton.classList.remove("active");
        }else{
            activeElements.forEach(activeElement => {
                activeElement.classList.remove("active");
            });
        }
    })

}

