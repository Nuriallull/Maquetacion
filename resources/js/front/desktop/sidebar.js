const hamButton = document.getElementById("ham-button");
const sidebar = document.getElementById("sidebar");


hamButton.addEventListener("click", () => {

    hamButton.classList.toggle("active");
    sidebar.classList.toggle("active");
    
});
    
