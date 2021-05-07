export let renderTabs = () => {

    let menuButton = document.querySelectorAll(".menu-button");
    let panel = document.querySelectorAll(".panel");


    menuButton.forEach (menuButton => {

        
        menuButton.addEventListener("click", () => {

            let activeElements = document.querySelectorAll(".tab-active");

            activeElements.forEach(activeElement => {
                activeElement.classList.remove("tab-active");
            });

            menuButton.classList.add("tab-active");

            panel.forEach(panel => {

                if(panel.dataset.tab == menuButton.dataset.tab){

                
                    panel.classList.add("tab-active");
                    
                }
            })
        })

    });

}