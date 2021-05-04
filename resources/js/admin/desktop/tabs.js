export let renderTabs = () => {

    let menuButton = document.querySelectorAll(".menu-button");
    let panel = document.querySelectorAll(".panel");


    menuButton.forEach (menuButton => {

        
        menuButton.addEventListener("click", () => {

            let activeElements = document.querySelectorAll(".active");

            activeElements.forEach(activeElement => {
                activeElement.classList.remove("active");
            });

            panel.forEach(panel => {

                
                panel.classList.remove("active");


                if(panel.dataset.tab == menuButton.dataset.tab){

                
                    panel.classList.add("active");
                    
                }
            })
        })

    });

}