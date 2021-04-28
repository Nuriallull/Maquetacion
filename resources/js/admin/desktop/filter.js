import {renderTable} from './crudTable';

const table = document.getElementById("table");
const tableFilter = document.getElementById("table-filter");
const filterForm = document.getElementById("filter-form");
const openFilter = document.getElementById("open-filter");
const applyFilter = document.getElementById("apply-filter");

export let renderFilterTable = () => {


    openFilter.addEventListener( 'click', () => {
        openFilter.classList.toggle("active");
        tableFilter.classList.toggle("active");
        applyFilter.classList.toggle("active");
    });
    
    applyFilter.addEventListener( 'click', () => {      

        let data = new FormData(filterForm);
        let url = filterForm.action;

        let sendPostRequest = async () => {

            try {
                await axios.post(url, data).then(response => {
                    table.innerHTML = response.data.table;
                    renderTable();
                    tableFilter.classList.toggle("active");
                    applyFilter.classList.toggle("active");
                    
                });
                
            } catch (error) {

            }
        };

        sendPostRequest();
        
    });

};

renderFilterTable();