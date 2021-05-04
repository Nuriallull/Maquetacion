export let renderLocaleTabs = () => {

    let subpanelButton = document.querySelectorAll(".subpanel-button");
    let subPanel = document.querySelectorAll(".subpanel");

    subpanelButton.forEach (subpanelButton => {

        subpanelButton.addEventListener("click", () => {

            subPanel.forEach(subPanel => {

                subPanel.classList.remove("active");
                
                
                if(subPanel.dataset.localetab == subpanelButton.dataset.localetab){

                    
                    subPanel.classList.add("active");
                    
                }
            })
        })
    });
}