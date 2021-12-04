var datamap = new Map([
    [document.getElementById("myBtn1"), document.getElementById("mymodal1")],
    [document.getElementById("myBtn2"), document.getElementById("mymodal2")],
    [document.getElementById("myBtn3"), document.getElementById("mymodal3")],
    // [document.getElementById("del-post4"), document.getElementById("delmodal")],
    // [document.getElementById("del-post5"), document.getElementById("delmodal")],
    // [document.getElementById("del-post6"), document.getElementById("delmodal")],
    [document.getElementById("linkavt"), document.getElementById("mymodal")],
    [document.getElementById("editpost"), document.getElementById("editmodal")]
]);

datamap.forEach((value, key) => {
    doModal(key, value);
});

function doModal(anchor, popupbox) {

    // Get the <span> element that closes the modal
    var span = popupbox.getElementsByClassName("close")[0];

    anchor.addEventListener("click", function (event) {
        popupbox.style.display = "block";
    });

    span.addEventListener("click", function (event) {
        popupbox.style.display = "none";
    });

    window.addEventListener("click", function (event) {
        if (event.target == popupbox) {
            popupbox.style.display = "none";
        }
    });
}
/* 
let modals = document.getElementsByClassName('modals');
let modalBtns = document.getElementsByClassName('modal-btns');
let closeBtns = document.getElementsByClassName('closes');

for(let modalBtn of modalBtns) {
    modalBtn.onclick = function(event) {
        document.querySelector(event.target.getAttribute('href') ).style.display = 'block';
    }
}

for(let closeBtn of closeBtns) {
    closeBtn.onclick = function(event) {
        event.target.parentNode.parentNode.style.display = 'none';
    }
}

window.onclick = function(event) {
    if(event.target.classList.contains('modals') ) {
        for(let modal of modals) {
            if(typeof modal.style !== 'undefined') {
                modal.style.display = 'none';    
            }
        }
    }
}

window.onkeydown = function(event) {
    if (event.key == 'Escape') {
        for(let modal of modals) {
            modal.style.display = 'none';
        }
    }
} */

/* var modal = document.getElementById("mymodal");
var a = document.getElementById("linkavt");
var span = document.getElementsByClassName("close");

a.onclick = function() {
    modal.style.display = "block";
}
  
span.onclick = function() {
    modal.style.display = "none";
}
  
window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
} */
/* var modals = document.querySelectorAll(".modal");
var btn = document.querySelectorAll("button.mybtn");
var spans = document.getElementsByClassName("close");

for (var i = 0; i < btn.length; i++) {
    btn[i].onclick = function (e) {
        e.preventDefault();
        modal = document.querySelector(e.target.getAttribute("href"));
        modal.style.display = "block";
    }
}
for (var i = 0; i < spans.length; i++) {
    spans[i].onclick = function () {
        for (var index in modals) {
            if (typeof modals[index].style !== 'undefined') modals[index].style.display = "none";
        }
    }
}

window.onclick = function (event) {
    if (event.target.classList.contains('modal')) {
        for (var index in modals) {
            if (typeof modals[index].style !== 'undefined') modals[index].style.display = "none";
        }
    }
} */