
//toggle button text view
const displayStutands = document.querySelector("#display-stutands");

displayStutands.addEventListener("click",(event)=>{

if(displayStutands.innerHTML === "הצג תלמידים"){
        displayStutands.innerHTML = "הסתר תלמידים";
    }else{
        displayStutands.innerHTML = "הצג תלמידים";
    }
    
})

let stops = document.querySelectorAll(".stop-row");

stops.forEach((stop)=>{
    let stopNum = stop.childNodes[1];
    let updateStop = stop.childNodes[3];
    let save = document.querySelector("#save");

    save.addEventListener("click",()=>{
        updateStop.value = stopNum.innerHTML;
    })
})

