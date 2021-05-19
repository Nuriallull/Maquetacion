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
        
      
        inputElement.addEventListener("change", (e) => {
            if (inputElement.files.length) {
                updateThumbnail(uploadElement, inputElement.files[0]);
            }
        });
      
        uploadElement.addEventListener("dragover", (e) => {
            e.preventDefault();

            if (e.dataTransfer.files.length) {
                inputElement.files = e.dataTransfer.files;
                updateThumbnail(uploadElement, e.dataTransfer.files[0]);
            }
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
                thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
                updateImageModal(reader.result);
                openModal();
            };

            uploadElement.classList.remove('upload-image-add');
            uploadElement.classList.add('upload-image');


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

        let url = image.dataset.url;

        if(url){

            let sendImageRequest = async () => {

                try {
                    axios.get(url).then(response => {
    
                        openImageModal(response.data);
                        
                    });
                    
                } catch (error) {
    
                }
            };
    
            sendImageRequest();

        }else{            

            openModal();
        }
    }
}
