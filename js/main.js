
//Allows typing only numbers

function numberOnly(event) {

    var x = event.key;

    if(isNaN(parseInt(x))  ){
        event.preventDefault();

    }
}