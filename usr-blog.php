<?php
    require('common/document-head.php');
?>
    <title>User Blog</title>
    <link href="./css/style-usr-blog.css" rel="stylesheet">
    <link href="./css/style-announce.css" rel="stylesheet">
</head>
<?php
    use MongoDB\Client;

    require_once "vendor/autoload.php";

    $conn = new Client("mongodb+srv://kimnhu:kimnhu@cluster0.uvhrc.mongodb.net/?serverSelectionTryOnce=false&serverSelectionTimeoutMS=15000&w=majority");
    $db = $conn->IE104_PROJECT;
    $post = $db->POST;
    $account = $db->ACCOUNT;

    $viewerid = 1;
    $result_act = $account->findOne(['accountid' => $viewerid]);
    $result_post = $post->find(['accountid' => $viewerid]);
?>
<body>
    <!----------------------------Header--------------------------->
    <?php
        require('common/header.php');
    ?>
    <!----------------------------Header-------------------------------->

    <main>
        <section class="head-content">
            <div class="container">
                <h1>Post</h1>
                <p>Place to keep the memories!</p>
            </div>
        </section>
        <article class="usr-blog-content">
            <section class="blog-nav">
                <div class="avatar-container">
                    <img src="./image/<?php echo $result_act['imgsrc'];?>" alt="<?php echo $result_act['firstname'].' '.$result_act['lastname'];?> avatar" class="usr-avatar" data-aos="zoom-in"
                        data-aos-delay="100">
                    <div class="change-avatar">
                        <a href="#changeavt" id="linkavt" style="color: white;"><i
                                class="fas fa-camera"></i>&nbsp;Change Avatar</a>
                    </div>
                    <div class="modal" id="mymodal">
                        <div class="modal-content">
                            <form action="#">
                                <span class="close">&times;</span>
                                <h2 style="margin: 2rem; text-align: center;">Change your avatar</h2>
                                <div class="form-group">
                                    <button>Choose image</button>
                                    <input type="text" id="first-name-m" name="fname">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="usr-name"><?php echo $result_act['firstname'].' '.$result_act['lastname'];?></div>

                <div class="modal-container">
                    <div>
                        <button id="myBtn1" class="mybtn" href="#changeinf">
                            <i class="fas fa-pencil"></i>&nbsp;&nbsp;Change your information</button>
                    </div>
                    <!--Change user inf modal-->
                    <?php
                        if(isset($_POST['btn_info'])){
                            $fname = $_POST['fname'];
                            $lname = $_POST['lname'];
                            $email = $_POST['email'];
                            $facebook = $_POST['fb'];
                            $instagram = $_POST['ig'];
                            $twitter = $_POST['twitter'];

                            $check = false; //true if form has at least one changed input

                            if($fname != $result_act['firstname'] && $fname != '') {
                                $update = $account->updateOne(
                                    ['accountid' => $viewerid],
                                    ['$set' => ['firstname' => $fname]],
                                );
                                $check = true;
                            }

                            if($lname != $result_act['lastname'] && $lname != '') {
                                $update = $account->updateOne(
                                    ['accountid' => $viewerid],
                                    ['$set' => ['lastname' => $lname]],
                                );
                                $check = true;
                            }

                            if($email != $result_act['email'] && $email != '') {
                                $update = $account->updateOne(
                                    ['accountid' => $viewerid],
                                    ['$set' => ['email' => $email]],
                                );
                                $check = true;
                            }

                            if($facebook != $result_act['facebook'] && $facebook != '') {
                                $update = $account->updateOne(
                                    ['accountid' => $viewerid],
                                    ['$set' => ['facebook' => $facebook]],
                                );
                                $check = true;
                            }

                            if($instagram != $result_act['instagram'] && $instagram != '') {
                                $update = $account->updateOne(
                                    ['accountid' => $viewerid],
                                    ['$set' => ['instagram' => $instagram]],
                                );
                                $check = true;
                            }

                            if($twitter != $result_act['twitter'] && $twitter != '') {
                                $update = $account->updateOne(
                                    ['accountid' => $viewerid],
                                    ['$set' => ['twitter' => $twitter]],
                                );
                                $check = true;
                            }

                            if($check) {
                                    ?>
                                    <div class="announce failed" id="announce">
                                        <div class="form_announce">
                                            <div class="content">
                                                <h3>Update successfully.</h3>
                                                <div class="btn close" style="display: flex; justify-content: center;">
                                                    <button id="close_announce">OK</button>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            } else {
                                ?>
                                <div class="announce failed" id="announce">
                                    <div class="form_announce">
                                        <div class="content">
                                            <h3>No fields are changed.<br>Please check your update.</h3>
                                            <div class="btn close" style="display: flex; justify-content: center;">
                                                <button id="close_announce">OK</button>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                    ?>

                    <div class="modal" id="mymodal1">
                        <div class="modal-content">
                            <form action="usr-blog.php" method="POST">
                                <span class="close">&times;</span>
                                <h2>Change your information</h2>
                                <div class="form-group">
                                    <label for="fname">First Name</label>
                                    <input type="text" id="first-name-m1" name="fname" value="<?php echo $result_act['firstname'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="lname">Last Name</label>
                                    <input type="text" id="last-name" name="lname" value="<?php echo $result_act['lastname'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" value="<?php echo $result_act['email'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="fb">Link Facebook</label>
                                    <input type="text" name="fb" value="<?php echo $result_act['facebook'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="ig">Link Instagram</label>
                                    <input type="text" name="ig" value="<?php echo $result_act['instagram'];?>">
                                </div>
                                <div class="form-group">
                                    <label for="twitter">Link Twitter</label>
                                    <input type="text" name="twitter" value="<?php echo $result_act['twitter'];?>">
                                </div>
                                <div class="form-group">
                                    <button class="inf-btn modal-btn" name="btn_info">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!--Change password modal-->
                    <?php
                        if (isset($_POST['btn_pass'])){
                            $old_pass = $_POST['password'];
                            $new_pass = $_POST['new-password'];
                            $conf_pass = $_POST['conf-password'];

                            $check = false;

                            if($result_act['password'] != $old_pass) {
                                    ?>
                                    <div class="announce failed" id="announce">
                                        <div class="form_announce">
                                            <div class="content">
                                                <h3>Confirm old password failed.<br>Please try again.</h3>
                                                <div class="btn close" style="display: flex; justify-content: center;">
                                                    <button id="close_announce">OK</button>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            } else {
                                if($new_pass != $conf_pass) {
                                    ?>
                                        <div class="announce failed" id="announce">
                                            <div class="form_announce">
                                                <div class="content">
                                                    <h3>Confirm new password failed.<br>Please try again.</h3>
                                                    <div class="btn close" style="display: flex; justify-content: center;">
                                                        <button id="close_announce">OK</button>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                } else {
                                    $update = $account->updateOne(
                                        ['accountid' => $viewerid],
                                        ['$set' => [
                                                'password' => $new_pass
                                            ],
                                        ]
                                    );   
                                    $check = true; 
                                }
                            }
                            if($check) {
                                    ?>
                                    <div class="announce failed" id="announce">
                                        <div class="form_announce">
                                            <div class="content">
                                                <h3>Update successfully.</h3>
                                                <div class="btn close" style="display: flex; justify-content: center;">
                                                    <button id="close_announce">OK</button>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }
                        }
                    ?>
                    <div>
                        <button id="myBtn2" class="mybtn" href="#changepw"><i
                                class="fas fa-pencil"></i>&nbsp;&nbsp;Change password</button>
                    </div>

                    <div class="modal" id="mymodal2">
                        <div class="modal-content">
                            <form action="usr-blog.php" method="POST">
                                <span class="close">&times;</span>
                                <h2>Change your password</h2>
                                <div class="form-group">
                                    <label for="oldpw">Password</label>
                                    <input type="password" name="password">
                                </div>
                                <div class="form-group">
                                    <label for="newpw">New password</label>
                                    <input type="password" name="new-password">
                                </div>
                                <div class="form-group">
                                    <label for="confpw">Confirm password</label>
                                    <input type="password" name="conf-password">
                                </div>
                                <div class="form-group">
                                    <button class="pw-btn modal-btn" name="btn_pass">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!--Add new post modal-->
                    <?php
                        $res = $post->find();
                        $num_post = 0;
                        foreach ($res as $row) {
                            $num_post++;
                        }                       
                            
                        if (isset($_POST['btn_new_post'])){
                            $title = $_POST['blog-title'];
                            $province = $_POST['province'];
                            $description = $_POST['description'];
                            $heading1 = $_POST['blog-heading1'];
                            $para1 = $_POST['blog-para1'];
                            $heading2 = $_POST['blog-heading2'];
                            $para2 = $_POST['blog-para2'];
                            $heading3 = $_POST['blog-heading3'];
                            $para3 = $_POST['blog-para3'];
                            $heading4 = $_POST['blog-heading4'];
                            $para4 = $_POST['blog-para4'];
                            $heading5 = $_POST['blog-heading5'];
                            $para5 = $_POST['blog-para5'];
                            $brief = $_POST['brief'];

                            $date = date("D M d Y");
                            $postid = $num_post + 1;

                            $fileName = array();
                            $fileTmpName = array();
                            $fileType = array();
                            $fileExt = array();
                            $fileActualExt = array();
                            $img_post = array();

                            $allowed = array('jpg', 'jpeg', 'png', 'pdf');

                            $check = true;
                            $count = 0;
                            echo $_FILES['userfile']['name'][0];
                            $_FILES['userfile']['name'][1];

                            for($i=0; $i<4; $i++) {
                                echo $_FILES['userfile']['name'][$i];
                                if((string)$_FILES['userfile']['name'][$i] != '') {
                                    $count++;
                                    $fileName[$i]=$_FILES['userfile']['name'][$i];
                                    $fileTmpName[$i]=$_FILES['userfile']['tmp_name'][$i];
                                    $fileType[$i]=$_FILES['userfile']['type'][$i];
    
                                    $fileExt[$i] = explode('.', $fileName[$i]);
                                    $fileActualExt[$i] = strtolower(end($fileExt[$i]));
    
                                    if(!in_array($fileActualExt[$i], $allowed)) {
                                        $check = false;
                                        break;
                                    }        
                                }
                            }
                            if($check) {
                                $fileNameNew = array();
                                $fileDestination = array();

                                for($i=0; $i<$count; $i++) {
                                    $fileNameNew[$i] = 'blog_content_'.$postid.'_'.($i+1).'.'.$fileActualExt[$i];
                                    $fileDestination[$i] = 'uploads/'.$fileNameNew[$i];
                                    $img_post[$i] = $fileNameNew[$i];
                                    move_uploaded_file($fileTmpName[$i], $fileDestination[$i]);
                                }

                                $insert_post = $post->insertOne([
                                    'postid'    => $postid,
                                    'accountid'  => $viewerid,
                                    'title' => $title,
                                    'description' => $description,
                                    'date' => $date,
                                    'provinceid' => $province,
                                    'heading1' => $heading1,
                                    'paragraph1' => $para1,
                                    'heading2' => $heading2,
                                    'paragraph2' => $para2,
                                    'heading3' => $heading3,
                                    'paragraph3' => $para3,
                                    'heading4' => $heading4,
                                    'paragraph4' => $para4,
                                    'heading5' => $heading5,
                                    'paragraph5' => $para5,
                                    'brief' => $brief,
                                    'img' => $img_post
                                ]);       
                                ?>
                                    <div class="announce failed" id="announce">
                                        <div class="form_announce">
                                            <div class="content">
                                                <h3>Post successfully.</h3>
                                                <div class="btn close" style="display: flex; justify-content: center;">
                                                    <button id="close_announce">OK</button>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                <?php

                            } else {
                                ?>
                                    <div class="announce failed" id="announce">
                                        <div class="form_announce">
                                            <div class="content">
                                                <h3>Post failed.<br>Please check your inputs again.</h3>
                                                <div class="btn close" style="display: flex; justify-content: center;">
                                                    <button id="close_announce">OK</button>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }                    
                        }
                    ?>
                    <div>
                        <button id="myBtn3" class="mybtn" href="#addnewpost"><i
                                class="fas fa-pencil"></i>&nbsp;&nbsp;Add new post</button>
                    </div>

                    <div class="modal" id="mymodal3">
                        <div class="modal-content">
                            <form action="usr-blog.php" method="POST" enctype="multipart/form-data">
                                <span class="close">&times;</span>
                                <h2>Add new post</h2>
                                <i><b>You can upload up to 4 pictures with extensions: jpg, jpeg, png, pdf.</b></i>
                                <div class="form-group">
                                    <label for="btitle">Title</label><br>
                                    <input type="text" id="title" name="blog-title">
                                </div>
                                <div class="form-group">
                                    <label for="bplace">Place</label>
                                    <select id="province" name="province">
                                        <option value="0">Viet Nam</option>
                                        <option value="1">An Giang</option>
                                        <option value="2">Bà Rịa - Vũng Tàu</option>
                                        <option value="3">Bắc Giang</option>
                                        <option value="4">Bắc Cạn</option>
                                        <option value="5">Bạc Liêu</option>
                                        <option value="6">Bắc Ninh</option>
                                        <option value="7">Bến Tre</option>
                                        <option value="8">Bình Định</option>
                                        <option value="9">Bình Dương</option>
                                        <option value="10">Bình Phước</option>
                                        <option value="11">Bình Thuận</option>
                                        <option value="12">Cà Mau</option>
                                        <option value="13">Cần Thơ</option>
                                        <option value="14">Cao Bằng </option>
                                        <option value="15">Đà Nẵng</option>
                                        <option value="16">Đắk Lắk</option>
                                        <option value="17">Đắk Nông</option>
                                        <option value="18">Điện Biên</option>
                                        <option value="19">Đồng Nai</option>
                                        <option value="20">Đồng Tháp</option>
                                        <option value="21">Gia Lai</option>
                                        <option value="22">Hà Giang</option>
                                        <option value="23">Hà Nam</option>
                                        <option value="24">Hà Nội </option>
                                        <option value="25">Hà Tĩnh</option>
                                        <option value="26">Hải Dương</option>
                                        <option value="27">Hải Phòng</option>
                                        <option value="28">Hậu Giang</option>
                                        <option value="29">Hòa Bình</option>
                                        <option value="30">Hưng Yên</option>
                                        <option value="31">Khánh Hòa</option>
                                        <option value="32">Kiên Giang</option>
                                        <option value="33">Kon Tum</option>
                                        <option value="34">Lai Châu</option>
                                        <option value="35">Lâm Đồng</option>
                                        <option value="36">Lạng Sơn</option>
                                        <option value="37">Lào Cai</option>
                                        <option value="38">Long An</option>
                                        <option value="39">Nam Định</option>
                                        <option value="40">Nghệ An</option>
                                        <option value="41">Ninh Bình</option>
                                        <option value="42">Ninh Thuận</option>
                                        <option value="43">Phú Thọ</option>
                                        <option value="44">Phú Yên</option>
                                        <option value="45">Quảng Bình</option>
                                        <option value="46">Quảng Nam</option>
                                        <option value="47">Quảng Ngãi</option>
                                        <option value="48">Quảng Ninh</option>
                                        <option value="49">Quảng Trị</option>
                                        <option value="50">Sóc Trăng</option>
                                        <option value="51">Sơn La</option>
                                        <option value="52">Tây Ninh</option>
                                        <option value="53">Thái Bình</option>
                                        <option value="54">Thái Bình</option>
                                        <option value="55">Thanh Hóa</option>
                                        <option value="56">Thừa Thiên Huế</option>
                                        <option value="57">Tiền Giang</option>
                                        <option value="58">Thành phố Hồ Chí Minh</option>
                                        <option value="59">Trà Vinh</option>
                                        <option value="60">Tuyên Quang</option>
                                        <option value="61">Vĩnh Long</option>
                                        <option value="62">Vĩnh Phúc</option>
                                        <option value="63">Yên Bái</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="picture">Picture</label><br>
                                    <!-- <button>Choose picture</button><br> -->
                                    <input type="file" name="userfile[]" multiple>
                                </div>
                                <div class="form-group">
                                    <label for="bopen">Description</label><br>
                                    <textarea id="opening" name="description">Some text...</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="bheading1">Heading 1</label><br>
                                    <input type="text" id="heading1" name="blog-heading1">
                                </div>
                                <div class="form-group">
                                    <label for="paragraph1">Paragraph 1</label><br>
                                    <textarea id="para1" name="blog-para1">Some text...</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="bheading2">Heading 2</label><br>
                                    <input type="text" id="heading2" name="blog-heading2">
                                </div>
                                <div class="form-group">
                                    <label for="paragraph2">Paragraph 2</label><br>
                                    <textarea id="para2" name="blog-para2">Some text...</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="bheading3">Heading 3</label><br>
                                    <input type="text" id="heading3" name="blog-heading3">
                                </div>
                                <div class="form-group">
                                    <label for="paragraph3">Paragraph 3</label><br>
                                    <textarea id="para3" name="blog-para3">Some text...</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="bheading4">Heading 4</label><br>
                                    <input type="text" id="heading4" name="blog-heading4">
                                </div>
                                <div class="form-group">
                                    <label for="paragraph4">Paragraph 4</label><br>
                                    <textarea id="para4" name="blog-para4">Some text...</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="bheading5">Heading 5</label><br>
                                    <input type="text" id="heading5" name="blog-heading5">
                                </div>
                                <div class="form-group">
                                    <label for="paragraph5">Paragraph 5</label><br>
                                    <textarea id="para5" name="blog-para5">Some text...</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="brief">Brief</label><br>
                                    <textarea id="brief" name="brief">Some text...</textarea>
                                </div>
                                <div class="form-group">
                                    <button class="post-btn modal-btn" name="btn_new_post">Post</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="contact-icon">
                    <i class="fab fa-facebook"><a href="<?php echo $result_act['facebook'];?>"></a></i>
                    <i class="fab fa-instagram-square"><a href="<?php echo $result_act['instagram'];?>"></a></i>
                    <i class="fab fa-twitter-square"><a href="<?php echo $result_act['twitter'];?>"></a></i>
                </div>
            </section>

            <section class="usr-list-post">

                <?php
                    $count = 0;
                    foreach($result_post as $row) {
                        $count++;
                        $imgsrc = $row['img'][0];
                        $title = $row['title'];
                        $description = $row['description'];

                        ?>
                        <div class="usr-post" data-aos="zoom-in" data-aos-delay="100">
                            <div class="usr-post-image">
                                <a href="blog-content.php"><img src="./image/<?php echo $imgsrc;?>" alt="Image name"></a>
                            </div>
                            <div class="usr-post-title">
                                <a href="blog-content.php?postid=<?php echo $row['postid'];?>"><?php echo $title;?></a>
                                <p>
                                    <?php echo $description;?>
                                </p>
                            </div>
                            <div class="option">
                                <a href="#editpost" id="edit-post<?php echo $count;?>" class="edit-btn modal-btns"><i class="fas fa-user-edit"></i></a>
                                <a href="#deletepost" id="del-post<?php echo $count;?>" class="del-btn modal-btns"><i class="fas fa-trash-alt"></i></a>
                            </div>
                        </div>
                        <?php
                    }
                ?>

                <!-- <div class="usr-post" data-aos="zoom-in" data-aos-delay="100">
                    <div class="usr-post-image">
                        <a href="blog-content.php"><img src="./image/See Vietnam Now - Vietnam Tourism - 11.jpg" alt="Image name"></a>
                    </div>
                    <div class="usr-post-title">
                        <a href="blog-content.php">Travel travel and travel</a>
                        <p>Since NASA’s inception in 1958, astronauts have landed on the moon, parked a robot-controlled
                            rover on Mars...
                        </p>
                    </div>
                    <div class="option">
                        <a href="#editpost" id="edit-post1" class="edit-btn modal-btns"><i class="fas fa-user-edit"></i></a>
                        <a href="#deletepost" id="del-post1" class="del-btn modal-btns"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>

                <div class="usr-post" data-aos="zoom-in" data-aos-delay="100">
                    <div class="usr-post-image">
                        <a href="blog-content.php"><img src="./image/See Vietnam Now - Vietnam Tourism - 2.jpg" alt="Image name"></a>
                    </div>
                    <div class="usr-post-title">
                        <a href="blog-content.php">Travel travel and travel</a>
                        <p>Since NASA’s inception in 1958, astronauts have landed on the moon, parked a robot-controlled
                            rover on Mars...
                        </p>
                    </div>
                    <div class="option">
                        <a href="#editpost" id="edit-post2" class="edit-btn modal-btns"><i class="fas fa-user-edit"></i></a>
                        <a href="#deletepost" id="del-post2" class="del-btn modal-btns"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>

                <div class="usr-post" data-aos="zoom-in" data-aos-delay="100">
                    <div class="usr-post-image">
                        <a href="blog-content.php"><img src="./image/See Vietnam Now - Vietnam Tourism - 8.jpg" alt="Image name"></a>
                    </div>
                    <div class="usr-post-title">
                        <a href="blog-content.php">Travel travel and travel</a>
                        <p>Since NASA’s inception in 1958, astronauts have landed on the moon, parked a robot-controlled
                            rover on Mars...
                        </p>
                    </div>
                    <div class="option">
                        <a href="#editpost" id="edit-post3" class="edit-btn modal-btns"><i class="fas fa-user-edit"></i></a>
                        <a href="#deletepost" id="del-post3" class="del-btn modal-btns"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>

                <div class="usr-post" data-aos="zoom-in" data-aos-delay="100">
                    <div class="usr-post-image">
                        <a href="blog-content.php"><img src="./image/Sidwalk cafes Vietnam Tourism.jpg" alt="Image name"></a>
                    </div>
                    <div class="usr-post-title">
                        <a href="blog-content.php">Travel travel and travel</a>
                        <p>Since NASA’s inception in 1958, astronauts have landed on the moon, parked a robot-controlled
                            rover on Mars...
                        </p>
                    </div>
                    <div class="option">
                        <a href="#editpost" id="edit-post4" class="edit-btn modal-btns"><i class="fas fa-user-edit"></i></a>
                        <a href="#deletepost" id="del-post4" class="del-btn modal-btns"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>

                <div class="usr-post" data-aos="zoom-in" data-aos-delay="100">
                    <div class="usr-post-image">
                        <a href="blog-content.php"><img src="./image/things to do in hcmc.jpg" alt="Image name"></a>
                    </div>
                    <div class="usr-post-title">
                        <a href="blog-content.php">Travel travel and travel</a>
                        <p>Since NASA’s inception in 1958, astronauts have landed on the moon, parked a robot-controlled
                            rover on Mars...
                        </p>
                    </div>
                    <div class="option">
                        <a href="#editpost" id="edit-post5" class="edit-btn modal-btns"><i class="fas fa-user-edit"></i></a>
                        <a href="#deletepost" id="del-post5" class="del-btn modal-btns"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>

                <div class="usr-post" data-aos="zoom-in" data-aos-delay="100">
                    <div class="usr-post-image">
                        <a href="blog-content.php"><img src="./image/Vietnam traditional souvenirs-3_0.jpg" alt="Image name"></a>
                    </div>
                    <div class="usr-post-title">
                        <a href="blog-content.php">Travel travel and travel</a>
                        <p>Since NASA’s inception in 1958, astronauts have landed on the moon, parked a robot-controlled
                            rover on Mars...
                        </p>
                    </div>
                    <div class="option">
                        <a href="#editpost" id="edit-post6" class="edit-btn modal-btns"><i class="fas fa-user-edit"></i></a>
                        <a href="#deletepost" id="del-post6" class="del-btn modal-btns"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>

                <div class="usr-post" data-aos="zoom-in" data-aos-delay="100">
                    <div class="usr-post-image">
                        <a href="blog-content.php"><img src="./image/Cao_Bang-Nguom_Ngao_Cave-7869.jpg" alt="Image name"></a>
                    </div>
                    <div class="usr-post-title">
                        <a href="blog-content.php">Travel travel and travel</a>
                        <p>Since NASA’s inception in 1958, astronauts have landed on the moon, parked a robot-controlled
                            rover on Mars...
                        </p>
                    </div>
                    <div class="option">
                        <a href="#editpost" id="edit-post7" class="edit-btn modal-btns"><i class="fas fa-user-edit"></i></a>
                        <a href="#deletepost" id="del-post7" class="del-btn modal-btns"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>

                <div class="usr-post" data-aos="zoom-in" data-aos-delay="100">
                    <div class="usr-post-image">
                        <a href="blog-content.php"><img src="./image/Water puppet shows Vietnam Tourism.jpg" alt="Image name"></a>
                    </div>
                    <div class="usr-post-title">
                        <a href="blog-content.php">Travel travel and travel</a>
                        <p>Since NASA’s inception in 1958, astronauts have landed on the moon, parked a robot-controlled
                            rover on Mars...
                        </p>
                    </div>
                    <div class="option">
                        <a href="#editpost" id="edit-post8" class="edit-btn modal-btns"><i class="fas fa-user-edit"></i></a>
                        <a href="#deletepost" id="del-post8" class="del-btn modal-btns"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>

                <div class="usr-post" data-aos="zoom-in" data-aos-delay="100">
                    <div class="usr-post-image">
                        <img src="./image/post-10.jpg" alt="Image name">
                    </div>
                    <div class="usr-post-title">
                        <a href="blog-content.php">Travel travel and travel</a>
                        <p>Since NASA’s inception in 1958, astronauts have landed on the moon, parked a robot-controlled
                            rover on Mars...
                        </p>
                    </div>
                </div>

                <div class="modal" id="delmodal">
                    <div class="modal-content">
                        <form action="#">
                            <span class="closes">&times;</span>
                            <h2>Are you sure you want to delete this post?</h2>
                            <div>
                                <button class="yes modal-btn" id="agree">Yes</button>
                                <button class="no modal-btn" id="disagree">No</button>
                            </div>
                    </div>
                    <div class="usr-post-title">
                        <a href="blog-content.php">Travel travel and travel</a>
                        <p>Since NASA’s inception in 1958, astronauts have landed on the moon, parked a robot-controlled
                            rover on Mars...
                        </p>
                    </div>
                    <a href="#deletepost" id="del-post" class="del-btn"><i class="fas fa-trash-alt"></i></a>
                </div> -->
                <script src="js/modal-usr-blog.js"></script>
            </section>
        </article>
    </main>

    <!------------------------------Footer---------------------------------------------------->
    <?php
        require('common/footer.php');
    ?>
    <!------------------------------Footer---------------------------------------------------->

    <script type="text/javascript">
        $(document).ready(function () {
            AOS.init();
        });
    </script>
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