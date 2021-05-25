import {renderTable} from './crudTable';



export let renderFilterTable = () => {

    let table = document.getElementById("table");
    let tableFilter = document.getElementById("table-filter");
    let filterForm = document.getElementById("filter-form");
    let openFilter = document.getElementById("open-filter");
    let applyFilter = document.getElementById("apply-filter");

    if(filterForm != null){

        let openFilter = document.getElementById("open-filter");
        let applyFilter = document.getElementById("apply-filter");

        openFilter.addEventListener( 'click', () => {
            openFilter.classList.toggle("active");
            tableFilter.classList.toggle("active");
            applyFilter.classList.toggle("active");
        });
        
        applyFilter.addEventListener( 'click', () => {      

            let data = new FormData(filterForm);

            let filters = {};
                
                data.forEach(function(value, key){
                    filters[key] = value;
                });
                
            let json = JSON.stringify(filters);

            let url = filterForm.action;

            let sendFilterRequest = async () => {

                try {
                    axios.get(url, {
                        params: {
                            filters: json
                        }
                    }).then(response => {
                        table.innerHTML = response.data.table;
                        renderTable();
                        tableFilter.classList.toggle("active");
                        applyFilter.classList.toggle("active");
                        
                    });
                    
                } catch (error) {

                }
            };

            sendFilterRequest();
        });
        
    };

};

renderFilterTable();