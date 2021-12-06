<?php
    error_reporting(0);
    require('common/document-head.php');
?>
    <title>Contact Us...</title>
    <link rel="stylesheet" href="/IE104_PROJECT/css/style-contact-us.css">
    <link href="./css/style-announce.css" rel="stylesheet">
</head>
<?php
    use PHPMailer\PHPMailer\PHPMailer;

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";
    
    $mail = new PHPMailer();

    if(isset($_POST['send_mail'])){
        $name = $_POST['name'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        try{
            //smtp settings
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "19521972@gm.uit.edu.vn";
            $mail->Password = '1582104979';
            $mail->Port = '587';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            //email settings
            $mail->setFrom("19521972@gm.uit.edu.vn");
            $mail->addAddress("19521972@gm.uit.edu.vn");
            $mail->isHTML(true);
            $mail->Subject = ($subject);
            $mail->Body = "<h3?>Name: $name<br>Email: $email<br>Tel: $tel<br>Message: $message</h3>";

            $send_mail = $mail->send();
            if($send_mail) {
                    ?>
                    <div class="announce failed" id="announce">
                        <div class="form_announce">
                            <div class="content">
                                <h3>Send email successfully.</h3>
                                <div class="btn close" style="display: flex; justify-content: center;">
                                    <!-- <button id="close_announce">OK</button> -->
                                </div> 
                            </div>
                        </div>
                    </div>
                <?php
            } 
        } catch(Exception $e)  {
            ?>
                <div class="announce failed" id="announce">
                    <div class="form_announce">
                        <div class="content">
                            <h3>Send email failed.<br>Please try again.</h3>
                            <div class="btn close" style="display: flex; justify-content: center;">
                                <!-- <button id="close_announce">OK</button> -->
                            </div> 
                        </div>
                    </div>
                </div>
            <?php
        }
        echo "<meta http-equiv='refresh' content='0'>";
    }
?>
<body>
    <?php
        require('common/header.php');
    ?>
    <main>
        <section class="head-content">
            <div class="container">
                <h1>Contact Us</h1>
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
                <br><br>
                <button id="submitButton" type="submit" name="send_mail">Submit</button>

                <br>
                <!-- <div class="confirm-captcha">
                    <div id="captchaBackground">
                        <div class="captch-box">
                            <canvas id="captcha">captcha text</canvas><br>
                            <input id="textBox" type="text" name="text"> 
                        </div>
                        <br>
                        <div id="buttons">
                            <button id="refreshButton" type="submit">Refresh</button>
                        </div>
                    </div>
                </div> -->
                <!-- <script src="/js/js-captcha-confirm.js"></script> -->
                <!-- <input type="submit" value="Submit">     -->
            </form>    
        </section>
        <section class="more-contact container">
            <div class="contact-info">
                <div class="info" data-aos="zoom-in" data-aos-delay="100">
                    <i class="fa fa-phone" style="font-size: 50px; background-color: white; color: black;"><a href="#"></a></i>
                    <div class="info-detail">
                        <h3>TELEPHONE</h3>
                        <p>+84 000 000 000</p>    
                    </div>
                </div>
                <div class="info" data-aos="zoom-in" data-aos-delay="100">
                    <i class="fa fa-map-marker" style="font-size: 50px; background-color: white; color: black;"><a href="#"></a></i>
                    <div class="info-detail">
                        <h3>ADDRESS</h3>
                        <p><strong>U</strong>niversity of <br><strong>I</strong>nformation and <strong>T</strong>echnology</p>    
                    </div>
                </div>
                <div class="info" data-aos="zoom-in" data-aos-delay="100">
                    <i class="fa fa-envelope" style="font-size: 50px; background-color: white; color: black;"><a href="#"></a></i>
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
    <?php
        require('common/footer.php');
    ?>
    <script type="text/javascript">
        $(document).ready(function(){
            AOS.init();
        });
    </script>
    <script>
        document.getElementById("close_announce").addEventListener("click", function(){
            // window.location.reload();
            document.getElementById("announce").classList.add("action");
        })
        document.addEventListener('keydown',function(e){
            if (e.keyCode === 13) {
                document.getElementById("announce").classList.add("action");
            }
        });
    </script>
</body>
</html>