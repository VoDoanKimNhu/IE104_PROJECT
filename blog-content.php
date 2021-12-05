<?php
    session_start();
    require('common/document-head.php');
?>
    <title>Blog Content</title>
    <link rel="stylesheet" href="/IE104_PROJECT/css/style-blog-content.css">
</head>

<?php
    use MongoDB\Client;

    require_once "vendor/autoload.php";

    $conn = new Client("mongodb+srv://kimnhu:kimnhu@cluster0.uvhrc.mongodb.net/?serverSelectionTryOnce=false&serverSelectionTimeoutMS=15000&w=majority");
    $db = $conn->IE104_PROJECT;
    $post = $db->POST;
    $account = $db->ACCOUNT;
    $comment = $db->COMMENT;
    $province = $db->PROVINCE;

    $viewerid = $_SESSION['accountid'];

    $postid = (int) $_GET['postid'];
    $result = $post->findOne(['postid' => $postid]);
    
    $title = $result['title'];
    $accountid = $result['accountid'];
    $description = $result['description'];
    $heading1 = $result['heading1'];
    $para1 = $result['paragraph1'];
    $heading2 = $result['heading2'];
    $para2 = $result['paragraph2'];
    $heading3 = $result['heading3'];
    $para3 = $result['paragraph3'];
    $heading4 = $result['heading4'];
    $para4 = $result['paragraph4'];
    $heading5 = $result['heading5'];
    $para5 = $result['paragraph5'];
    $brief = $result['brief'];
    $date = $result['date'];
    $imgs = $result['img'];
    $provinceid = $result['provinceid'];

    $result_pro = $province->findOne(['provinceid' => $provinceid]);
    $province = $result_pro['name'];

    $imgs_length = count($imgs);
?>
<?php
    $res = $comment->find(['postid' => $postid]);
    $num_cmt = 0;
    foreach ($res as $row) {
        $num_cmt++;
    }                       

    if (isset($_POST['submit_cmt'])){
        $commentid = $num_cmt+1;
        $message = $_POST['comment'];
        $date = date("D M d Y");

        $insert_cmt = $comment->insertOne([
            'postid'    => $postid,
            'commentid'  => $commentid,
            'accountid' => $viewerid,
            'message' => $message,
            'date' => $date
        ]);   
    }
?>
<body>
    <?php
        require('common/header.php');
    ?>
    <main>
        <section class="head-content">
            <div class="container">
                <h1><?php echo $title?></h1>
            </div>
        </section>
        <?php
            $result_account_owner = $account->findOne(['accountid' => $accountid]);
            $account_owner_name = $result_account_owner['firstname'].' '.$result_account_owner['lastname'];
            $account_owner_img = $result_account_owner['imgsrc'];          
        ?>
        <section class="main-content container">
            <section class="content">
                <div class="info">
                    <img src="/IE104_PROJECT/image/<?php echo $account_owner_img;?>" alt="Image of <?php echo $account_owner_name;?>" class="img-owner">
                    <div class="post-owner">
                        <h2><?php echo $account_owner_name;?></h2>
                        <p><?php echo $date?></p>
                    </div>
                </div>

                <div class="detail">
                    <div class="photos">
                        <div class="head-photo" id="photo">
                            <!-- <button class="btn" onclick="one()">1</button> -->
                            <button class="btn active" onclick="two()">2</button>
                            <button class="btn" onclick="four()">4</button>
                        </div>
                        <div class="row">
                        <?php
                            for($i=0; $i<$imgs_length; $i++) {
                                $img_name = 'blog_content_'.$postid.'_'.($i+1).'.jpg';
                                ?>
                                <div class="column">
                                    <img src="/IE104_PROJECT/image/<?php echo $img_name?>" alt="<?php echo $province;?> photo" class="row-img">
                                    <!-- <img src="/IE104_PROJECT/image/sapa-contact-us.jpg" alt="sapa photo" class="row-img"> -->
                                </div>
                                <?php
                            }
                        ?>
                        </div>
                        <div id="myModal" class="modal">
                            <span class="close">&times;</span>
                            <img class="modal-content" id="img01">
                            <div id="caption"></div>
                        </div>
                    </div>
                    <br>
                    <div class="overview">
                        <p><?php echo $description?></p>
                        <br>
                    </div>
                    <br>
                    <div class="detail-content">
                        <?php
                            for($i=0; $i<5; $i++) {
                                $name_heading = 'heading'.($i+1);
                                $name_para = 'para'.($i+1);

                                if($$name_heading != '') {
                                    ?>
                                    <h3><?php echo $$name_heading;?></h3>
                                    <p><?php echo $$name_para;?></p>
                                    <!-- <p>You can also get to know the ethnic groups through their unique handmade costumes. Spend some time learning about the styles of the different tribes through sewing, embroidery, weaving or batik workshops. Each costume may take months to make. If you’d like to shop ethnic designs, drop in the IndigoCat store to buy authentic bags, jackets and pillows.</p>
                                    <q><strong>TIP: ETHOS offers community-based tours for responsible travellers, ranging from motorbike rides to sewing classes to photography tours.</strong></q> -->
                                    <br>
                                    <br>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                    <br>
                    <div class="summary">
                        <p><?php echo $brief;?></p>
                        <br>
                    </div>
                    <br>
                </div>
            </section>
        </section>

        <section class="container">
            <h2>
                <?php 
                    $res = $comment->find(['postid' => $postid]);
                    $num_cmt = 0;
                    foreach ($res as $row) {
                        $num_cmt++;
                    }                       

                    if($num_cmt>=2) echo $num_cmt.' Comments';
                    else echo $num_cmt.' Comment';
                ?> 
            </h2>
            <?php
                $result_viewer = $account->findOne(['accountid' => $viewerid]);
                $viewer_img = $result_viewer['imgsrc'];
                $viewer_name = $result_viewer['firstname'].' '.$result_viewer['lastname'];
            ?>
            <div class="comment-act">
                <div class="add-comment">
                    <div class="info">
                        <img src="/IE104_PROJECT/image/<?php echo $viewer_img;?>" alt="Image of <?php echo $viewer_name;?>" class="img-owner">
                    </div> 
                </div>
                <form action="blog-content.php" name="add-comment" id="add-comment" method="POST">
                    <div class="add-cmt">
                        <input type="text" name="comment" id="comment" placeholder="Add a public comment...">
                    </div>
                    <div class="btn-cmt">
                        <button class="btn" name="submit_cmt">Comment</button>
                    </div>
                </form>
            </div>
            <?php

                if (isset($_GET['pageno'])) {
                    $pageno = $_GET['pageno'];
                } else {
                    $pageno = 1;
                }

                $no_of_records_per_page = 3;
                $offset = ($pageno-1)*$no_of_records_per_page;
                $rec_count = $num_cmt;
                $total_pages = ceil($rec_count/$no_of_records_per_page);
                
                $res = $comment->find(['postid' => $postid]);

                $i = 0;
                foreach ($res as $row) {
                    if($i>=$offset && $i<$offset+$no_of_records_per_page) {
                        $cmt_accountid = $row->accountid;
                        $cmt_message = $row->message;
                        $cmt_date = $row->date;
    
                        $result_account = $account->findOne(['accountid' => $cmt_accountid]);
                        $account_name = $result_account['firstname'].' '.$result_account['lastname'];
                        $account_img = $result_account['imgsrc'];                  
    
                        ?>
                            <div class="comment">
                                <div class="info">
                                    <img src="/IE104_PROJECT/image/<?php echo $account_img;?>" alt="Image of <?php echo $account_name;?>" class="img-owner">
                                    <div class="post-owner">
                                        <h2><?php echo $account_name;?></h2>
                                        <p><?php echo $cmt_date;?></p>
                                    </div>
                                </div>
                                <div class="detail">
                                    <p><?php echo $cmt_message;?></p>
                                </div>
                            </div>
                        <?php                 
                    }
                    $i++;
                }    
            ?>
            <div class="pagination flex-row">
                <a href="#"><i class="fas fa-chevron-left"></i></a>
                <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>" class="pages"> 
                    <?php if($pageno <= 1){ echo '...'; } else { echo ($pageno - 1); } ?>
                </a>
                <a href="<?php echo "?pageno=".($pageno); ?>" class="pages"><?php echo $pageno;?></a>
                <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>" class="pages">
                    <?php if($pageno >= $total_pages){ echo '...'; } else { echo ($pageno + 1); } ?>
                </a>
                <a href="#"><i class="fas fa-chevron-right"></i></a>
            </div>
        </section>
        <!-- <section class="interaction container">
            <h3>LEAVE A REPLY</h3>
            <hr>
            <br>
            <p>Your email address will not be published. Required fields are marked <span style="color: red;">*</span></p>
            <br>
            <form class="reply">
                <textarea name="comment" id="comment" cols="30" rows="10" placeholder="* Your Comment" required></textarea>
                <div class="info-comment">
                    <input type="text" name="name" id="name" placeholder="*  Your Name" required><br>
                    <input type="email" name="email" id="email" placeholder="*  Your Email" required><br>
                    <input type="text" name="website" id="website" placeholder="Your Website"><br>
                </div>
                <span class="save-info">
                    <input type="checkbox" name="save" id="save">
                    <p>Save my name, email, and website in this browser for the next time I comment.</p>    
                </span> 
                <br> 
                <input type="submit" value="POST COMMENT">  
            </form>
        </section> -->

    </main>
    <?php
        require('common/footer.php');
    ?>
    <script src="/IE104_PROJECT/js/js-blog-content.js"></script>
    <script src="/IE104_PROJECT/js/js-blog-img-grid.js"></script>
</body>
</html>
