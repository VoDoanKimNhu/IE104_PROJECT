function openModal() {
    document.getElementById("imgModal").style.display = "block";
  }
  
  function closeModal() {
    document.getElementById("imgModal").style.display = "none";
  }
  
  var slideIndex = 1;
  showSlides(slideIndex);
  
  function plusSlideImgs(n) {
    showSlides(slideIndex += n);
  }
  
  function currentSlideImg(n) {
    showSlides(slideIndex = n);
  }
  
  function showSlides(n) {
    var i;
    var slider = document.getElementsByClassName("slider");
    if (n > slider.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slider.length}
    for (i = 0; i < slider.length; i++) {
      slider[i].style.display = "none";
    }
    slider[slideIndex-1].style.display = "block";
  }