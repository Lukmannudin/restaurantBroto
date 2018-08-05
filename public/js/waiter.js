
function check(value, next) {
    /* var input_value = document.getElementById("checkbox-value").value; */

    console.log(next);
    console.log(value);
    
    if (value >= 1) {
        next.checked = true;
    }else{
        next.checked = false; 
    }
}