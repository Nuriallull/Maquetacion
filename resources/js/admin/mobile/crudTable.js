import {renderEditor} from './ckeditor';
import {swipeRevealItem} from './swipe';
import {scrollWindowElement} from './verticalScroll';
import {startWait, stopWait} from './wait';
import {showMessage} from './messages';
import {showForm} from './bottombarMenu';
import {renderTabs} from './tabs';
import {renderLocaleTabs} from './tabslocale';

const table = document.getElementById("table");
const form = document.getElementById("form");
const panelButton = document.querySelectorAll(".panel-button");
const panel = document.querySelectorAll(".panel");



export let renderForm = () => {

    let forms = document.querySelectorAll(".admin-form");
    let labels = document.querySelectorAll('.label-highlight');
    let inputs = document.querySelectorAll('.input-highlight');
    let sendButton = document.getElementById("send-button");
    
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


    sendButton.addEventListener("click", (event) => {

            event.preventDefault();
            
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

    renderEditor();
    renderTabs();
    renderLocaleTabs();


};

panelButton.forEach (panelButton => {

    panelButton.addEventListener("click", () => {

        panel.forEach(panel => {

            if(panel.dataset.tab == panelButton.dataset.tab){

            
                panel.classList.toggle("active");
                panelButton.classList.toggle("active");

            }
        })
    })
});

//*Aqui comienza la función que incluye el JavaScript de la tabla.

export let renderTable = () => {

    
    let swipeRevealItemElements = document.querySelectorAll('.swipe-element');


    swipeRevealItemElements.forEach(swipeRevealItemElement => {

        new swipeRevealItem(swipeRevealItemElement);

    });

    new scrollWindowElement(table);
};

export let verticalScrollTable = () => {
    
    new scrollWindowElement(table);

}

export let deleteElement = (url) => {

    let modalDelete = document.getElementById('modal-delete');
    let deleteConfirm = document.getElementById('delete-confirm');

    deleteConfirm.dataset.url = url;
    modalDelete.classList.add('open');
}


export let editElement = (url) => {

        let sendEditRequest = async () => {

        showForm();

        try {
            await axios.get(url).then(response => {
                form.innerHTML = response.data.form;
                renderForm(); //*cada vez que terminamos una llamada de JS al elemento (formulario) lo llamamos de nuevo al final.
            });
            
        } catch (error) {
            console.error(error);
        }
    };

    sendEditRequest(); //* llamamos la funcion editar: cuando demos al boton editar, cogeremos los datos dela tabla y se comunicaran al formulario, para editarlos}
}

renderForm();
renderTable();


//* Al final llamamos de nuevo a las funciones de la tabla y el formulario.