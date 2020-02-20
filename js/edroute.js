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
    let stopNum = Array.from(document.querySelectorAll(".stop-num"));
    stopNum.forEach((stop)=>{
        let num = stopNum.indexOf(stop) + 1;
        stop.innerHTML = num; // Contains the stop number
        stop.nextElementSibling.value = num;
    })   
}

stopsOrderHandler();

dragula([document.querySelector('.stops')], {
    moves: function (el, container, handle) {
        return handle.classList.contains('handle');
      }
})
    .on('drop', function () {
        stopsOrderHandler();
    });

dragula(Array.from(document.querySelectorAll('.students-list')),  {
    moves: function (el, container, handle) {
      return handle.classList.contains('handle1');
    }
  });

console.log(typeof (UndoManager));
