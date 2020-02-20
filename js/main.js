// general js

//Allows typing only numbers
// eslint-disable-next-line no-unused-vars
function numberOnly(event) {
    let x = event.key;
    if(isNaN(parseInt(x))  ){
        event.preventDefault();
    }
}

let spinnerOn = document.querySelectorAll(".spinner-on");
spinnerOn.forEach((el)=>{
    el.addEventListener("click", ()=>{
        document.getElementById("spinner-wrapper").style.display = "block";
    })
})
