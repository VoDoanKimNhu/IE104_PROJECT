var elements = document.getElementsByClassName("column");

var i; //amount img in column

// function one() {
//     for(i=0; i<elements.length; i++) {
//         elements[i].style.msFlex="100%";
//         elements[i].style.flex="100%";
//     }
// }

function two() {
    for(i=0; i<elements.length; i++) {
        elements[i].style.msFlex="50%";
        elements[i].style.flex="50%";
        elements[i].style.height="400px";
    }
}

function four() {
    for(i=0; i<elements.length; i++) {
        elements[i].style.msFlex="25%";
        elements[i].style.flex="25%";
        elements[i].style.height="300px";
    }
}

var header = document.getElementById("photo");
var btns = header.getElementsByClassName("btn");
for(var i=0; i<btns.length; i++) {
    btns[i].addEventListener("click", function() {
        var current = document.getElementsByClassName("active");
        current[0].className = current[0].className.replace(" active", "");
        this.className += " active";
    });
}