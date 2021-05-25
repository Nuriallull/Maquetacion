

export let blockSlug = () => {

    let SlugElement =  document.querySelectorAll('.label-seo');

    if(SlugElement){

        slugElement.forEach(slugElement => {

            slugElement.addEventListener("keyup", () => {
            
                let slug = slugElement.value.match(/\{.*?\}/g);

            
            })


            slugElement.addEventListener("keydown", () => {
            
                let slug = slugElement.value.match(/\{.*?\}/g);
            })

        });
        
    }
}
