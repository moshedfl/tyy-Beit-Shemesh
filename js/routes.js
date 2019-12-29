let routeHeader = document.querySelectorAll(".route-header");
routeHeader.forEach((route)=>{
    route.addEventListener("click",(event)=>{
        route.classList.toggle("active-header");

    })
})

let stutandRow = document.querySelectorAll(".stutand-row");
stutandRow.forEach((stutand)=>{
    stutand.addEventListener("click",(event)=>{
        stutand.classList.toggle("active-stutand");

    })
})