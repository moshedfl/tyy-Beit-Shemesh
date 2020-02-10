// general js

//Allows typing only numbers
// eslint-disable-next-line no-unused-vars
function numberOnly(event) {
    var x = event.key;
    if(isNaN(parseInt(x))  ){
        event.preventDefault();
    }
}