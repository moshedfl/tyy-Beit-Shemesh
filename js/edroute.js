// js for edit routes page

//toggle button text view
const displayStudents = document.querySelector("#display-students");
displayStudents.addEventListener("click",(event)=>{
if(displayStudents.innerHTML === "הצג תלמידים"){
        displayStudents.innerHTML = "הסתר תלמידים";
    }else{
        displayStudents.innerHTML = "הצג תלמידים";
    }
});

//Receives the updated stop number and puts it in the value of the adjacent input with the save button
function stopsOrderHandler(){
    let stops = document.querySelectorAll(".stop-row");
    let i = 1;
    stops.forEach((stop)=>{
        let stopNum = stop.childNodes[1]; // Contains the stop number
        stopNum.innerHTML = i; // Contains the stop number
        let updateStop = stop.childNodes[3];// the input
        updateStop.value = i;
        i++
    })   
}

dragula([document.querySelector('.stops')])
    .on('drop', function (el) {
        stopsOrderHandler();
    });


