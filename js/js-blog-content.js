// img grid 
var elements = document.getElementsByClassName("column");

var i; //amount img in column

function one() {
    for(i=0; i<elements.length; i++) {
        elements[i].style.msFlex="100%";
        elements[i].style.flex="100%";
    }
}

function two() {
    for(i=0; i<elements.length; i++) {
        elements[i].style.msFlex="50%";
        elements[i].style.flex="50%";
    }
}

function four() {
    for(i=0; i<elements.length; i++) {
        elements[i].style.msFlex="25%";
        elements[i].style.flex="25%";
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

// img modal
var modal = document.getElementById('myModal');

var imgs = document.getElementsByClassName('row-img');
// var imgs = document.getElementsByClassName('row-img');
for(let i=0; i<imgs.length; i++) {
    var modalImg = document.getElementById("img01");
    console.log(modalImg);
    var captionText = document.getElementById("caption");
    imgs[i].onclick = function(){

      modal.style.display = "block";
      modalImg.src = this.src;
      captionText.innerHTML = this.alt;
    }    
}

var span = document.getElementsByClassName("close")[0];

span.onclick = function() { 
  modal.style.display = "none";
}