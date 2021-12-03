<?php

    if(isset($_POST['email']) && $_POST['email'] != ''){


        
        $userName = $_POST['name'];
        $userTel = $_POST['tel'];
        $userEmail = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $to= "19521558@gm.uit.edu.vn";
        $body = "";

        $body .="From: ".$userName. "\r\n";
        $body .="Email: ".$userEmail. "\r\n";
        $body .="Message: ".$message. "\r\n";

        //mail($to,$subject,$body);
        $status=mail("19521558@gm.uit.edu.vn","Success","Send mail from localhost using PHP","abc");
        if($status)
        {
            echo '<p>Your mail has been sent!</p>';
        } else {
            echo '<p>Something went wrong. Please try again!</p>';
        }
    }

?>
<!--#include virtual="/IE104_PROJECT/common/document-head.html"-->
<title>Contact Us...</title>
    <link rel="stylesheet" href="/IE104_PROJECT/css/style-contact-us.css">

</head>
<body>
    <!--#include virtual="/IE104_PROJECT/common/header.html"-->
    <main>
        <section class="head-content">
            <div class="container">
                <h1>CONTACT US</h1>
                <p>FeedBack? Question? Let Us Know!</p>
            </div>
        </section>
        <section class="main-content container">
            <p>Required fields are marked <span style="color: red;">*</span></p><br>
            <form action="contact-us.php" method="POST">
                <div class="personal-info">
                    <input type="text" name="name" id="name" placeholder="*  Your Name" autofocus required>
                    <input type="tel" name="tel" id="tel" placeholder="Your Phone Number">
                </div>
                <div class="personal-info">
                    <input type="email" name="email" id="email" placeholder="*  Your Email" required>
                    <input type="text" name="subject" id="subject" placeholder="*  Your Subject" required>
                </div>
                <div class="personal-info">
                    <textarea name="message" id="message" cols="30" rows="10" placeholder="*  Your Message" required></textarea>
                </div>
            
                <br><br><br>
                <div class="confirm-captcha">
                    <div id="captchaBackground">
                        <div class="captch-box">
                            <canvas id="captcha">captcha text</canvas>
                            <input id="textBox" type="text" name="text">  
                        </div>
                        <div id="buttons">
                            <button id="submitButton" type="submit">Submit</button>
                            <button id="refreshButton" type="submit">Refresh</button>
                        </div>
                        <!-- <span id="output"></span> -->
                    </div>
                </div>
                <script src="/js/js-captcha-confirm.js"></script>
                <!-- <input type="submit" value="Submit">     -->
            </form>    
        </section>
        <section class="more-contact container">
            <div class="contact-info">
                <div class="info" data-aos="zoom-in" data-aos-delay="100">
                    <i class="fa fa-phone" style="font-size: 50px; background-color: #FFFBEA; color: black;"><a href="#"></a></i>
                    <div class="info-detail">
                        <h3>TELEPHONE</h3>
                        <p>+84 000 000 000</p>    
                    </div>
                </div>
                <div class="info" data-aos="zoom-in" data-aos-delay="100">
                    <i class="fa fa-map-marker" style="font-size: 50px; background-color: #FFFBEA; color: black;"><a href="#"></a></i>
                    <div class="info-detail">
                        <h3>ADDRESS</h3>
                        <p><strong>U</strong>niversity of <br><strong>I</strong>nformation and <strong>T</strong>echnology</p>    
                    </div>
                </div>
                <div class="info" data-aos="zoom-in" data-aos-delay="100">
                    <i class="fa fa-envelope" style="font-size: 50px; background-color: #FFFBEA; color: black;"><a href="#"></a></i>
                    <div class="info-detail">
                        <h3>EMAIL</h3>
                        <p>info@gmail.com</p>                            
                    </div>
                </div>    
            </div>
        </section>    
        <section class="location container">
            <div class="contact-location">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10366.099793015172!2d106.79873615058035!3d10.872052194203075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317527587e9ad5bf%3A0xafa66f9c8be3c91!2sUniversity%20of%20Information%20Technology%20VNU-HCM!5e0!3m2!1sen!2s!4v1634443046065!5m2!1sen!2s" width="100%" height="600px" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </section>
    </main>
    <script src="/IE104_PROJECT/js/js-captcha-confirm.js"></script>
    <!--#include virtual="/IE104_PROJECT/common/footer.html"-->
    <script type="text/javascript">
        $(document).ready(function(){
            AOS.init();
        });
    </script>
</body>
</html>