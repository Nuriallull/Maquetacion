import {startOverlay, startWait, stopWait} from './wait';
import {showMessage} from './messages';
import {deleteThumbnail} from './upload';

let modalImageStoreButton = document.getElementById('modal-image-store-button');
let modalImageDeleteButton = document.getElementById('modal-image-delete-button');

export let openModal = () => {

    let modal = document.getElementById('upload-image-modal');

    modal.classList.add('modal-active');
    startOverlay();
}

export let openImageModal = (image) => {

    let modal = document.getElementById('upload-image-modal');
    let imageContainer = document.getElementById('modal-image-original');
    let imageForm = document.getElementById('image-form');

    imageForm.reset();  

    if(image.path){

        if(image.entity_id){
            image.imageId = image.id; 
            imageContainer.src = '../storage/' + image.path;
        }else{
            imageContainer.src = image.path;
        }

    }else{

        imageContainer.src = image.dataset.path;
        image = image.dataset;
    }

    for (var [key, val] of Object.entries(image)) {

        let input = imageForm.elements[key];

        if(input){

            switch(input.type) {
                case 'checkbox': input.checked = !!val; break;
                default:         input.value = val;     break;
            }
        }
    }

    modal.classList.add('modal-active');

    startOverlay();
}

export let updateImageModal = (image) => {

    let imageContainer = document.getElementById('modal-image-original');
    let imageForm = document.getElementById('image-form');

    imageForm.reset();

    if(image.path){

        if(image.entity_id){
            image.imageId = image.id; 
            imageContainer.src = '../storage/' + image.path;
        }else{
            imageContainer.src = image.path;
        }

    }else{

        imageContainer.src = image.dataset.path;
        image = image.dataset;
    }
 
    for (var [key, val] of Object.entries(image)) {

        let input = imageForm.elements[key];
        
        if(input){

            switch(input.type) {
                case 'checkbox': input.checked = !!val; break;
                default:         input.value = val;     break;
            }
        }
    }
}

modalImageStoreButton .addEventListener("click", (e) => {
         
    let modal = document.getElementById('upload-image-modal');
    let imageForm = document.getElementById('image-form');
    let data = new FormData(imageForm);
    let url = imageForm.action;
    let temporalId = document.getElementById('modal-image-temporal-id');
    let id = document.getElementById('modal-image-id');

    let sendImagePostRequest = async () => {

        try {
            axios.post(url, data).then(response => {

                modal.classList.remove('modal-active');
                temporalId.value = "";
                id.value = "";
                imageForm.reset();
                stopWait();
                showMessage('success', response.data.message);
              
            });
            
        } catch (error) {

        }
    };

    sendImagePostRequest();
});

modalImageDeleteButton.addEventListener("click", (e) => {

         
    let modal = document.getElementById('upload-image-modal');
    let url = modalImageDeleteButton.dataset.route;
    let temporalId = document.getElementById('modal-image-temporal-id');
    let imageForm = document.getElementById('image-form');
    let id = document.getElementById('modal-image-id');

    if(id){

        let sendImageDeleteRequest = async () => {

            try {
                axios.get(url, {
                    params: {
                      'image': id.value
                    }
                }).then(response => {
                    deleteThumbnail(response.data.imageId);
                    showMessage('success', response.data.message);
                });
                
            } catch (error) {
    
            }
        };
    
        sendImageDeleteRequest();

    }else{
        console.log("no-no");
        deleteThumbnail(temporalId);
    }

   
    temporalId.value = "";
    id.value = "";
    imageForm.reset();
    modal.classList.remove('modal-active');
    stopWait();
});

/* introducir updateImageModal para que se renderice la imagen recien subida*/
