<?php
    session_start();
    require('common/document-head.php');
?>
    <title>Login</title>
    <link rel="stylesheet" href="/IE104_PROJECT/css/style-login.css">
    <link rel="stylesheet" href="/IE104_PROJECT/css/style-announce.css">
</head>
<?php
    use MongoDB\Client;

    require_once "vendor/autoload.php";

    $conn = new Client("mongodb+srv://kimnhu:kimnhu@cluster0.uvhrc.mongodb.net/?serverSelectionTryOnce=false&serverSelectionTimeoutMS=15000&w=majority");
    $db = $conn->IE104_PROJECT;
    $account = $db->ACCOUNT;

    if (isset($_POST['submit-login'])){
        $email = $_POST['email-login'];
        $pass = $_POST['password-login'];

        $result = $account->findOne(['email' => $email, 'password' => $pass]);
        if($result) {
            $_SESSION['loggedin'] = true;
            $_SESSION['accountid'] = $result['accountid'];
            switch ($result['role']) {
                case '1':
                    header("location: index.html");
                    break;
                case '2':
                    header("location: #");
                    break;    
                default:
                    header("location: index.html");
                    break;
            }
        } 
        else
        {
            ?>
                <div class="announce failed" id="announce">
                    <div class="form_announce">
                        <div class="content">
                            <h3>Login failed. <br>Please try again.</h3>
                            <div class="btn close" style="display: flex; justify-content: center;">
                                <button id="close_announce">OK</button>
                            </div> 
                        </div>
                    </div>
                </div>
            <?php
        }
    }

    if (isset($_POST['submit-reg'])){
        $fname = $_POST['first-name'];
        $lname = $_POST['last-name'];
        $email_reg = $_POST['email-reg'];
        $pass_reg = $_POST['password-reg'];
        $pass_conf = $_POST['confirm-password'];

        if($pass_reg != $pass_conf) {
            ?>
                <div class="announce failed" id="announce">
                    <div class="form_announce">
                        <div class="content">
                            <h3>Confirm password failed. <br>Please try again.</h3>
                            <div class="btn close" style="display: flex; justify-content: center;">
                                <button id="close_announce">OK</button>
                            </div> 
                        </div>
                    </div>
                </div>
            <?php
        }
        else {
            $res = $account->find();
            $num_act = 0;
            foreach ($res as $row) {
                $num_act++;
            }        
            
            $accountid = $num_act + 1;
            $role = 1;
            $insert_cmt = $account->insertOne([
                'accountid'    => $accountid,
                'firstname'  => $fname,
                'lastname' => $lname,
                'email' => $email_reg,
                'role' => $role,
                'password' => $pass_reg,
                'facebook' => '',
                'instagram' => '',
                'twitter' => ''
            ]);   
            if($insert_cmt) {
                $_SESSION['loggedin'] = true;
                $_SESSION['accountid'] = $accountid;

                header("location: index.html");
            }  
        }
    }
?>
<script>
    document.getElementById("close_announce").addEventListener("click", function(){
        document.getElementById("announce").classList.add("action");
    })
    document.addEventListener('keydown',function(e){
        if (e.keyCode === 13) {
            document.getElementById("announce").classList.add("action");
        }
    });
</script>

<body>
    <?php
        require('common/header.php');
    ?>
    <main>
        <div class="container">
            <div id="login-form" class="login-page">
                <div class="form-box">
                    <div class="button-box">
                        <div id="btn"></div>
                        <button type="button" onclick="login()" class="toggle-btn"><span>Log In</span></button>
                        <button type="button" onclick="register()" class="toggle-btn"><span>Register</span></button>
                    </div>
                    <form action="login.php" id="login" class="input-group-login" method="POST">
                        <div class="form-group">
                            <input name="email-login" type="email" id="email-login" class="input-field" placeholder="Your Email" required>
                            <p class="form-message"></p><br>
                        </div>

                        <div class="form-group">
                            <input name="password-login" type="password" id="password-login" class="input-field" placeholder="Your Password" required>
                            <p class="form-message"></p>
                        </div>

                        <input type="checkbox" name="remember-pswd" id="remember-pswd" class="check-box"><span>Remember Password</span>

                        <button type="submit" class="submit-btn" name="submit-login">Log In</button>
                    </form>
                    <form action="" id="register" class="input-group-register" method="POST">
                        <div class="form-group">
                            <input name="first-name" type="text" id="first-name" class="input-field" placeholder="Your First Name" required>
                            <p class="form-message"></p>
                        </div>

                        <div class="form-group">
                            <input name="last-name" type="text" id="last-name" class="input-field" placeholder="Your Last Name" required>
                            <p class="form-message"></p>
                        </div>

                        <div class="form-group">
                            <input name="email-reg" type="email" id="email-reg" class="input-field" placeholder="Your Email" required>
                            <p class="form-message"></p>
                        </div>

                        <div class="form-group">
                            <input name="password-reg" type="password" id="password-reg" class="input-field" placeholder="Your Password" required>
                            <p class="form-message"></p>
                        </div>

                        <div class="form-group">
                            <input name="confirm-password" type="password" id="confirm-password" class="input-field" placeholder="Confirm Password" required>
                            <p class="form-message"></p>
                        </div>

                        <input type="checkbox" name="agree-terms" id="agree-terms" class="check-box"><span>I agree to the terms and conditions</span><br>
                        <button type="submit" class="submit-btn" name="submit-reg">Register</button>
                    </form>
                </div>
            </div>    
        </div>
    </main>
    <script src="/IE104_PROJECT/js/js-login.js"></script>
    <!-- <script src="/IE104_PROJECT/js/js-validator.js"></script>
    <script>
        Validator({
        form: '#register',
        errorSelector: '.form-message',
        rules: [
            Validator.isRequired('#first-name'),
            Validator.isRequired('#last-name'),
            Validator.isRequired('#email-reg'),
            Validator.isEmail('#email-reg'),
            Validator.isRequired('#password-reg'),
            Validator.minLength('#password-reg', 6),
            Validator.isRequired('#confirm-password'),
            Validator.isConfirmed('#confirm-password', function() {
                return document.querySelector('#register #password-reg').value;
            }),
        ],
    });

    Validator({
        form: '#login',
        errorSelector: '.form-message',
        rules: [
            Validator.isRequired('#email-login'),
            Validator.isEmail('#email-login'),
            Validator.isRequired('#password-login')
        ],
    });
    </script> -->
    <?php
        require('common/footer.php');
    ?>
    <script>
        document.getElementById("close_announce").addEventListener("click", function(){
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