import {renderForm, renderTable} from './crudTable';
import {renderEditor} from './ckeditor';

const sidebarButton = document.querySelectorAll(".sidebar-menu-item");
const hamButton = document.getElementById("ham-button");
const sidebar = document.getElementById("sidebar");


sidebarButton.forEach(sidebarButton => {

    sidebarButton.addEventListener("click", () => {
        let url = sidebarButton.dataset.url;

            let sendBarRequest = async () => {

                try {
                    await axios.get(url).then(response => {
                        form.innerHTML = response.data.form;
                        table.innerHTML = response.data.table;

                    window.history.pushState('','', url);
                        renderForm();
                        renderTable();
                        renderEditor();
                    });
                    
                } catch (error) {
                    console.error(error);
                }
            };

        sendBarRequest();

    });
});

hamButton.addEventListener("click", () => {

    hamButton.classList.toggle("active");
    sidebar.classList.toggle("active");
    
});
    
