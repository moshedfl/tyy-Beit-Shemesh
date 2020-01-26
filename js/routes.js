let isSmallWindow = window.innerWidth < 768;

window.onresize = ()=>{
    isSmallWindow = window.innerWidth < 768;
    if(!isSmallWindow){
        removeActiveStutandClass()
    }
}

//add in remove class on event
function toggleClass(element,className){
    element.classList.toggle(className);
}

//Puts the forth routes to a separate section
let forthRoutes = document.querySelectorAll('[data-direction="forth"]');
forthRoutes.forEach((route)=>{
    document.getElementById("forth").insertAdjacentElement("beforeend", route);
})

//Adds class to header of the selected route to change the designing
let routeHeader = document.querySelectorAll(".display-route");
routeHeader.forEach((route)=>{
    route.addEventListener("click",()=>{toggleClass(route,"active-header")});
})

let cancelBubbleIcon = document.querySelectorAll(".edit-route, .fa-print");
cancelBubbleIcon.forEach((icon)=>{
    icon.addEventListener("click",(event)=>{event.cancelBubble = true;});
})

let stutandRow = document.querySelectorAll(".stutand-row");
stutandRow.forEach((stutand)=>{
    stutand.addEventListener("click",()=>{
        if(isSmallWindow){
            toggleClass(stutand,"active-stutand");
        }
    });
})
    
function removeActiveStutandClass(){
    stutandRow.forEach((stutand)=>{
        stutand.classList.remove ("active-stutand");
    })
}

//Prints each route by click
let head = document.getElementsByTagName("head")[0].innerHTML ;
let routes = document.querySelectorAll(".route");
routes.forEach((route)=>{
    printBtn = route.getElementsByClassName("fa-print")[0];
    printBtn.addEventListener("click",(event)=>{
       let  printPage = window.open('','','left=300,top=50,width=1000,height=700');
       printPage.document.write(head, route.outerHTML );
       printPage.document.close();
       printPage.focus();
       setTimeout(()=>{
            printPage.print(); 
            printPage.close();
       },50)
      
    });
})




