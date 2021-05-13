import {startWait, stopWait} from './wait';
import {showMessage} from './messages';
import {renderEditor} from './ckeditor';
import {renderTabs} from './tabs';
import {renderLocaleTabs} from './tabslocale';
import {renderUpload} from './upload';

const table = document.getElementById("table");
const form = document.getElementById("form");



//*Aqui comienza la función que incluye el JavaScript del formulario. Las constantes pasan a ser variables, y solamente se mantienen como constantes el formulario y la tabla.

export let renderForm = () => {

    let forms = document.querySelectorAll(".admin-form");
    let labels = document.querySelectorAll('.label-highlight');
    let inputs = document.querySelectorAll('.input-highlight');
    let sendButton = document.getElementById("send-button");
    let updateButton = document.getElementById("update-button");

    inputs.forEach(input => {

        input.addEventListener('focusin', () => {
    
            for( var i = 0; i < labels.length; i++ ) {
                if (labels[i].htmlFor == input.name){
                    labels[i].classList.add("active");
                }
            }
        });
    
        input.addEventListener('blur', () => {
    
            for( var i = 0; i < labels.length; i++ ) {
                labels[i].classList.remove("active");
            }
        });
    });
    
    sendButton.addEventListener("click", () => {
    
        forms.forEach(form => { 
            
            let data = new FormData(form);

            if( ckeditors != 'null'){

                Object.entries(ckeditors).forEach(([key, value]) => {
                    data.append(key, value.getData());
                });
            }

            let url = form.action;

            let sendPostRequest = async () => {

                startWait();
    
                try {
                    await axios.post(url, data).then(response => {
                        form.id.value = response.data.id;
                        table.innerHTML = response.data.table;

                        stopWait();
                        showMessage('success', response.data.message);
                        renderTable();
                    });
                    
                } catch (error) {

                    stopWait();
    
                    if(error.response.status == '422'){
    
                        let errors = error.response.data.errors;      
                        let errorMessage = '';
    
                        Object.keys(errors).forEach(function(key) {
                            errorMessage += '<li>' + errors[key] + '</li>';
                        })
        
                        showMessage('error', errorMessage);
                    }
                }
            };

            sendPostRequest();
        });
    });

    updateButton.addEventListener("click", (event) => {

        event.preventDefault();

        let url = updateButton.dataset.url;

        let sendCreateRequest = async () => {

            startWait();

            try {
                await axios.get(url).then(response => {

                    form.innerHTML = response.data.form;

                    stopWait();
                    renderForm();
                });
                
            } catch (error) {

                stopWait();
            }
        };

        sendCreateRequest();
                
    });

    renderEditor();
    renderTabs();
    renderLocaleTabs();
    renderUpload();
};

export let renderTable = () => {

    let editButtons = document.querySelectorAll(".edit-button");
    let deleteButtons = document.querySelectorAll(".delete-button");
    let paginationButtons = document.querySelectorAll(".pagination-button");

    editButtons.forEach(editButton => {

        editButton.addEventListener("click", () => {

            let url = editButton.dataset.url;

            let sendEditRequest = async () => {

                try {
                    await axios.get(url).then(response => {
                        form.innerHTML = response.data.form;
                        renderForm(); //*cada vez que terminamos una llamada de JS al elemento (formulario) lo llamamos de nuevo al final.
                    });
                    
                } catch (error) {
                    console.error(error);
                }
            };

            sendEditRequest(); //* llamamos la funcion editar: cuando demos al boton editar, cogeremos los datos dela tabla y se comunicaran al formulario, para editarlos.
        });
    });

    deleteButtons.forEach(deleteButton => {

        deleteButton.addEventListener("click", () => {

            let url = deleteButton.dataset.url;

            let sendDeleteRequest = async () => {

                try {
                    await axios.delete(url).then(response => {
                        table.innerHTML = response.data.table;
                        renderTable();
                    });
                    
                } catch (error) {
                    console.error(error);
                }
            };

            sendDeleteRequest();
            //* llamamos la funcion eliminar: cuando pulsemos el boton eliminar, cogemos los datos de la tabla (innerhtml) para que desaparezcan de ella.
        });
    });

    paginationButtons.forEach(paginationButton => {

        paginationButton.addEventListener("click", () => {

            let url = paginationButton.dataset.page; 

            let sendPaginationRequest = async () => {

                try {
                    await axios.get(url).then(response => {
                        table.innerHTML = response.data.table;
                        renderTable();
                    });
                    
                } catch (error) {
                    console.error(error);
                }
            };

            sendPaginationRequest();
            
        });
    });
    
};

renderForm();
renderTable();
