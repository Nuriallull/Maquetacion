document.querySelector(".minus-btn").setAttribute("disabled", "disabled");
    
document.querySelector(".plus-btn").addEventListener("click", function()
{
    valueCount = document.getElementById("quantity").value;

    valueCount++;

    document.getElementById("quantity").value = valueCount;
})

document.querySelector(".minus-btn").addEventListener("click", function()
{
    valueCount = document.getElementById("quantity").value;

    valueCount--;

    document.getElementById("quantity").value = valueCount;
})