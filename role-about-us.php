<?php
    error_reporting(0);    
    require('common/document-head.php');
    session_start();
?>
<title>About us</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<link rel="stylesheet" href="/IE104_PROJECT/css/style-aboutus.css">
</head>

<body>
  <?php
        require('common/role-header.php');
    ?>
  <main>

    <div class="wall">
      <div class="text-content">
        <h1 class="text-heading" style="font-family: 'Comforter', cursive;">About Us</h1>
      </div>
    </div>

    <section class="aboutus-members">
      <h1>Members</h1>
      <div class="row">
        <div class="col-sm-4">
          <img src="./image/aboutus.jpg" alt="Vo Doan Kim Nhu"
            style="width:100%">
          <div class="icons">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-instagram-square"></i></a>
            <a href="#"><i class="fab fa-twitter-square"></i></a>
          </div>
        </div>
        <div class="col-sm-8 member-text">
          <h2>Võ Đoàn Kim Như</h2>
          <p>19521972</p>
          <p>Like to climb mountains and explore the culture of Vietnamese ethnic groups to to satisfy understanding.</p>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-8 member-text">
          <h2>Nguyễn Thị Huệ</h2>
          <p>19521558</p>
          <p>Passionate about discovering regional cuisines around Vietnam and relish to write blogs to share delightful tips.</p>
        </div>
        <div class="col-sm-4">
          <img src="./image/aboutus.jpg" alt="Nguyen Thi Hue"
            style="width:100%">
          <div class="icons">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-instagram-square"></i></a>
            <a href="#"><i class="fab fa-twitter-square"></i></a>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-4">
          <img src="./image/aboutus.jpg" alt="Vo Thi Nhu Lai"
            style="width:100%">
          <div class="icons">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-instagram-square"></i></a>
            <a href="#"><i class="fab fa-twitter-square"></i></a>
          </div>
        </div>
        <div class="col-sm-8 member-text">
          <h2>Võ Thị Như Lài</h2>
          <p>19521733</p>
          <p>Enjoy capturing beautiful scenes through nice shots and talking to many people to understand the ancient history of Vietnam.</p>
        </div>
      </div>
    </section>

    <!-- <div class="row">
      <div class="col-sm-6">
        <img src="https://i.pinimg.com/originals/2b/54/57/2b54575029c6046817d5522347fd6d88.jpg" alt="member1"
          style="width:100%">
      </div>
      <div class="col-sm-6 member-text">
        <h2>Our project</h2>
        <p> Currently the project is carried out entirely with personal resources. On average, to produce 1 hour of
          content, the project team must spend about 60-80 hours working at the highest level of concentration. In
          addition, we also have to pay certain expenses to keep the podcast running.</p>
      </div>
    </div> -->
<!-- 
    <div class="centered">
      <h1>Our Project</h1>
      <p>Each Vietnamese city exudes its own distinct character.
          <br> Get a feel for Vietnam’s fascinating urban centres in these interactive tours.
          <br>Let these local Vietnamese show you around their hometowns with personal stories, top tips, and
          must-do experiences.
      </p>
    </div> -->

    <section class="head-content">
      <div class="container">
        <h1>Our Project</h1>
        <p>Each Vietnamese city exudes its own distinct character.
            <br> Get a feel for Vietnam’s fascinating urban centres in these interactive tours.
            <br>Let these local Vietnamese show you around their hometowns with personal stories, top tips, and
            must-do experiences.
            <br>This website is a place for everyone who relishes tralveling in general and share experience.
            <br>Through all of posts, we can see what Vietnam has and how Vietnam is gorgeous.
        </p>
      </div>
  </section>
<<<<<<< HEAD

    <div class="achie">
        <h1 style="margin-bottom: 5rem; margin-top: 10rem;">Our Achievements</h1>
    </div>
=======
>>>>>>> dfafa0707f2e75a37425196dc2c001a89bd0a91d


    <div class="slideshow-container">
      <div class="mySlides">
        <img src="./image/Ha Giang Loop Ma Pi Leng Pass.jpg"
          style="width:100%">
        <div class="text">1000 users</div>
      </div>

      <div class="mySlides">
        <img src="./image/Ha Giang Loop-12.jpg" style="width:100%">
        <div class="text">More than 10000 posts </div>
      </div>

      <div class="mySlides">
        <img src="./image/Ha Giang Loop-9.jpg"
          style="width:100%">
        <div class="text">More than 2000 shares</div>
      </div>

      <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
      <a class="next" onclick="plusSlides(1)">&#10095;</a>

    </div>
    <br>

    <div class="dotbox" style="text-align:center; display: none;">
      <span class="dot" onclick="currentSlide(1)"></span>
      <span class="dot" onclick="currentSlide(2)"></span>
      <span class="dot" onclick="currentSlide(3)"></span>
    </div>

    <script language="javascript" src="/IE104_PROJECT/js/js-aboutus.js"></script>

  </main>

  <?php
        require('common/footer.php');
    ?>
</body>

</html>