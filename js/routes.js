// js for routes screen

// checks on reload page if is in small screen
let isSmallWindow = window.innerWidth < 768;

// checks on resize page if is small screen
window.onresize = ()=>{
    isSmallWindow = window.innerWidth < 768;
    if(!isSmallWindow) removeActiveStudentClass();// if is width screen call function to remove class
}

//add and remove class on event
function toggleClass(element,className){
    element.classList.toggle(className);
}

//Puts the forth routes to a separate section
let forthRoutes = document.querySelectorAll('[data-direction="forth"]');
forthRoutes.forEach((route)=>{
    document.getElementById("forth").insertAdjacentElement("beforeend", route);
})

//add and remove class for header of the selected route to change style
let routeHeader = document.querySelectorAll(".display-route");
routeHeader.forEach((route)=>{
    route.addEventListener("click",()=>{toggleClass(route,"active-header")});
})

// Don't select the route at the click of a icon
let cancelBubbleIcon = document.querySelectorAll(".edit-route, .fa-print");
cancelBubbleIcon.forEach((icon)=>{
    icon.addEventListener("click",(event)=>{event.cancelBubble = true;});
})

//add and remove class for selected student to change style
let studentRow = document.querySelectorAll(".student-row");
studentRow.forEach((student)=>{
    student.addEventListener("click",()=>{
        if(isSmallWindow){
            toggleClass(student,"active-student");
        }
    });
})

//remove class from selected student In calling the function
function removeActiveStudentClass(){
    studentRow.forEach((student)=>{
        student.classList.remove ("active-student");
    })
}

//Prints each route at the click of the button 'הדפס'
let head = document.getElementsByTagName("head")[0].innerHTML; //get html from head for css links
let routes = document.querySelectorAll(".route"); // get html from selected route
routes.forEach((route)=>{

    // get the amount of students for current route
    let students = route.getElementsByClassName("student-row");
    if(students.length > 47 && students.length < 70) route.classList.add("big-route");// if much students add class to scale to print on one page
    
    // get the print button from current route
    let printBtn = route.getElementsByClassName("fa-print")[0];
    printBtn.addEventListener("click",()=>{

        // open new window to print only current rout
        let  printPage = window.open('','','left=300,top=50,width=1000,height=700');
        printPage.document.write(head, route.outerHTML ); // write page head and current rout html to the new window
        
        // Delays printing until all html is loaded into the new window
        setTimeout(()=>{
            printPage.print(); // print the new window
            printPage.close(); // close new window after print
       },100)
      
    });
})




