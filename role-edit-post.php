<?php
    // error_reporting(0);
    session_start();
    require('common/document-head.php');
?>
    <title>Edit Post</title>
    <link href="./css/style-announce.css" rel="stylesheet">
    <link href="./css/style-role-edit-post.css" rel="stylesheet">
    <link href="./css/style-announce.css" rel="stylesheet">
</head>
<?php
    use MongoDB\Client;

    require_once "vendor/autoload.php";

    $conn = new Client("mongodb+srv://kimnhu:kimnhu@cluster0.uvhrc.mongodb.net/?serverSelectionTryOnce=false&serverSelectionTimeoutMS=15000&w=majority");
    $db = $conn->IE104_PROJECT;
    $post = $db->POST;
    $province = $db->PROVINCE;

    $viewerid = $_SESSION['accountid'];
    $postid = $_GET['postid'];
    $result_post = $post->findOne(['postid' => (int) $postid]);

    $pro = $province->findOne(['provinceid' => (int) $result_post['provinceid']]);

?>
<?php
    if(isset($_POST["edit-post"])) {
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

        echo $province.$description.$heading1.$para1;

        $update = $post->updateOne(
            ['postid' => (int) $postid],
            ['$set' => 
                [
                    'title' => $title,
                    'description' => $description,
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
                    // 'img' => $img_post
                ]
            ],
        );
        if($update) {
            ?>
                <div class="announce failed" id="announce">
                    <div class="form_announce">
                        <div class="content">
                            <h3>Edit post successfully.</h3>
                            <div class="btn close" style="display: flex; justify-content: center;">
                                <!-- <a href="role-usr-blog.php">Back to your blog</a> -->
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
    <!----------------------------Header--------------------------->
    <?php
        require('common/role-header.php');
    ?>
    <!----------------------------Header-------------------------------->
    <main>
    <form action="role-edit-post.php?postid=<?php echo $_GET['postid'];?>" method="POST" enctype="multipart/form-data">
        <div class="modal" id="editmodal">
            <div class="modal-content">
                <form action="role-edit-post.php">
                    <h2>Edit post</h2>
                    <div class="form-group">
                        <label for="btitle">Title</label><br>
                        <input type="text" id="b-title" name="blog-title" value="<?php echo $result_post['title'];?>">
                    </div>
                    <div class="form-group">
                        <label for="bplace">Place</label>
                        <select id="b-province" name="province" value="<?php echo $pro['name'];?>">
                        <?php 
                            $provinces = $province->find();

                            foreach($provinces as $row) {
                                if((int) $row->provinceid == (int) $pro['provinceid']) {
                                    ?>
                                        <option value="<?php echo $row->provinceid;?>" selected><?php echo $row->name;?></option>
                                    <?php
                                } else {
                                ?>
                                    <option value="<?php echo $row->provinceid;?>"><?php echo $row->name;?></option>
                                <?php
                                }
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bopen">Description</label><br>
                        <textarea id="b-opening" name="description" value="1"><?php echo $result_post['description'];?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="bheading1">Heading 1</label><br>
                        <input type="text" id="b-heading1" name="blog-heading1" value="<?php echo $result_post['heading1'];?>">
                    </div>
                    <div class="form-group">
                        <label for="paragraph1">Paragraph 1</label><br>
                        <textarea id="b-para1" name="blog-para1"><?php echo $result_post['paragraph1'];?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="bheading2">Heading 2</label><br>
                        <input type="text" id="b-heading2" name="blog-heading2" value="<?php echo $result_post['heading2'];?>">
                    </div>
                    <div class="form-group">
                        <label for="paragraph2">Paragraph 2</label><br>
                        <textarea id="b-para2" name="blog-para2"><?php echo $result_post['paragraph2'];?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="bheading3">Heading 3</label><br>
                        <input type="text" id="b-heading3" name="blog-heading3" value="<?php echo $result_post['heading3'];?>">
                    </div>
                    <div class="form-group">
                        <label for="paragraph3">Paragraph 3</label><br>
                        <textarea id="b-para3" name="blog-para3"><?php echo $result_post['paragraph3'];?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="bheading4">Heading 4</label><br>
                        <input type="text" id="b-heading4" name="blog-heading4" value="<?php echo $result_post['heading4'];?>">
                    </div>
                    <div class="form-group">
                        <label for="paragraph4">Paragraph 4</label><br>
                        <textarea id="b-para4" name="blog-para4"><?php echo $result_post['paragraph4'];?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="bheading5">Heading 5</label><br>
                        <input type="text" id="b-heading5" name="blog-heading5" value="<?php echo $result_post['heading5'];?>">
                    </div>
                    <div class="form-group">
                        <label for="paragraph5">Paragraph 5</label><br>
                        <textarea id="b-para5" name="blog-para5"><?php echo $result_post['paragraph4'];?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="brief">Brief</label><br>
                        <textarea id="b-brief" name="brief"><?php echo $result_post['brief'];?></textarea>
                    </div>
                    <div class="form-group">
                        <button class="post-btn modal-btn" name="edit-post">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </form>
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