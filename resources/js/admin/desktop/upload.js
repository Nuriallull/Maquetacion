import {openModal, openImageModal, updateImageModal} from './modalImage';

export let renderUpload = () => {

    let inputElements = document.querySelectorAll(".drop-zone__input");
    let uploadImages = document.querySelectorAll(".upload-image");

    inputElements.forEach(inputElement => {

        uploadImage(inputElement);

    });

    uploadImages.forEach(uploadImage => {

        uploadImage.addEventListener("click", (e) => {

            openImage(uploadImage);
        });
    });

    function uploadImage(inputElement){

        let uploadElement = inputElement.parentElement;


        uploadElement.addEventListener("click", (event) => {
            
            let thumbnailElement = uploadElement.querySelector(".upload-thumb");

            if(!thumbnailElement){
                inputElement.click();
            }else{
                openImage(uploadElement);
            };
        });
        /* Este de arriba inputElement.click es el click para subir la foto nueva */
      
        inputElement.addEventListener("change", (e) => {
            if (inputElement.files.length) {
                updateThumbnail(uploadElement, inputElement.files[0]);
            }
        });
      
        uploadElement.addEventListener("dragover", (e) => {
            e.preventDefault();
            uploadElement.classList.add("upload-over");
        });
      
        ["dragleave", "dragend"].forEach((type) => {
            uploadElement.addEventListener(type, (e) => {
                uploadElement.classList.remove("upload-over");
            });
        });

      
        uploadElement.addEventListener("drop", (e) => {
            e.preventDefault();
        
            if (e.dataTransfer.files.length) {
                    inputElement.files = e.dataTransfer.files;
                    updateThumbnail(uploadElement, e.dataTransfer.files[0]);
            }
        
            uploadElement.classList.remove("upload-over");
        });
    };

      
    function updateThumbnail(uploadElement, file) {

        if (file.type.startsWith("image/")) {

            let thumbnailElement = uploadElement.querySelector(".upload-thumb");
            let multipleWrap = document.getElementById("multiple-element");

            /* clonamos sin apend. Con apend es así:
               multipleWrap.appendChild(uploadClone); */

            if (uploadElement.classList.contains("multiple")) {
            
                if(!thumbnailElement){

                    
                    let cloneUploadElement = uploadElement.cloneNode(true);
                    let cloneInput = cloneUploadElement.querySelector('.drop-zone__input');
    
                    uploadImage(cloneInput);
                    uploadElement.parentElement.insertBefore(cloneUploadElement,uploadElement);
                }
            }
            
            if (uploadElement.querySelector(".drop-zone__prompt")) {
                uploadElement.querySelector(".drop-zone__prompt").remove();
            }
          
            if (!thumbnailElement) {
                thumbnailElement = document.createElement("div");
                thumbnailElement.classList.add("upload-thumb");
                uploadElement.appendChild(thumbnailElement);
            }
    
            let reader = new FileReader();
           
            reader.readAsDataURL(file);

            reader.onload = () => {
                let temporalId = Math.floor((Math.random() * 99999) + 1);
            let content = uploadElement.dataset.content;
            let language = uploadElement.dataset.language;

            let inputElement = uploadElement.getElementsByClassName("upload-image-input")[0];

            thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
            uploadElement.dataset.temporalId = temporalId;
            uploadElement.dataset.image = reader.result;
            inputElement.name = "images[" + content + "-" + temporalId + "." + language  + "]"; 

            uploadElement.classList.remove('upload-image-add');
            uploadElement.classList.add('upload-image');

            updateImageModal(uploadElement);
            openModal();
            };


            if(uploadElement.classList.contains("multiple")){

                let inputElement = uploadElement.getElementsByClassName("drop-zone__input")[0];
                let content = uploadElement.dataset.content;
                let alias = uploadElement.dataset.alias;
        
                inputElement.name = "images[" + content + "-" + Math.floor((Math.random() * 99999) + 1) + "." + alias  + "]"; 
                    
            }

        } else {
            thumbnailElement.style.backgroundImage = null;
        }
   
        
    };

    function openImage(image){
 /* aqui miramos si tiene url, si la tiene voy a por ella.
 Si no tiene url, es una foto que acaba de cargar asi que le metemos un update en vez de un open.*/
        let url = image.dataset.url;

        if(url){

            let sendImageRequest = async () => {

                try {
                    axios.get(url).then(response => {
    
                        openImageModal(response.data); /* esto abre el modal con una foto que SI esta en la BBDD*/
                        
                    });
                    
                } catch (error) {
    
                }
            };
    
            sendImageRequest();

        }else{            
            updateImageModal(image); /* esto abre el modal con una foto que no esta en la BBDD, se utiliza para que al dar click, salga la foto indicada*/
            openModal();
        }
    }
}

export function deleteThumbnail(imageId) {

    let uploadImages = document.querySelectorAll(".upload-image");

    uploadImages.forEach(uploadImage => {

        if(uploadImage.classList.contains('collection')){

            if(uploadImage.dataset.temporalId == imageId || uploadImage.dataset.imageId == imageId){
                
                uploadImage.remove();
            }
        }

        if(uploadImage.classList.contains('single')){

            if(uploadImage.dataset.temporalId == imageId || uploadImage.dataset.imageId == imageId){

                uploadImage.querySelector(".upload-thumb").remove();
                uploadImage.dataset.imageId = '';
                uploadImage.dataset.url = '';
                uploadImage.querySelector(".drop-zone__prompt").classList.remove('hidden');
                uploadImage.classList.remove('upload-image');
                uploadImage.classList.add('upload-image-add');

                if(uploadImage.querySelector(".drop-zone__input")){
                    uploadImage.querySelector(".drop-zone__input").value = "";
                }
            }
        }
    });
}
