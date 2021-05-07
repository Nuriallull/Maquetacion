export let renderLocaleTabs = () => {

    let subpanelButton = document.querySelectorAll(".subpanel-button");
    let subPanel = document.querySelectorAll(".subpanel");

    subpanelButton.forEach (subpanelButton => {

        subpanelButton.addEventListener("click", () => {

            let activeElements = document.querySelectorAll(".locale-tab-active");
            let activeTab = subpanelButton.dataset.tab;

            activeElements.forEach(activeElement => {

                if(activeElement.dataset.tab == activeTab){
                    activeElement.classList.remove("locale-tab-active");
                }
            });

            subpanelButton.classList.add("locale-tab-active");

            subPanel.forEach(subPanel => {
                
                if(subPanel.dataset.tab == activeTab){
                    if(subPanel.dataset.localetab == subpanelButton.dataset.localetab)
                    
                    subPanel.classList.add("locale-tab-active");
                    
                }
            })
        })
    });
}