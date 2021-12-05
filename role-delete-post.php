<?php
    // error_reporting(0);
    session_start();
    require('common/document-head.php');
?>
    <title>Edit Post</title>
    <link href="./css/style-announce.css" rel="stylesheet">
    <link href="./css/style-role-edit-post.css" rel="stylesheet">
</head>
<?php
    use MongoDB\Client;

    require_once "vendor/autoload.php";

    $conn = new Client("mongodb+srv://kimnhu:kimnhu@cluster0.uvhrc.mongodb.net/?serverSelectionTryOnce=false&serverSelectionTimeoutMS=15000&w=majority");
    $db = $conn->IE104_PROJECT;
    $post = $db->POST;

    $viewerid = $_SESSION['accountid'];
    $postid = $_GET['postid'];
    $result_post = $post->findOne(['postid' => (int) $postid]);

    $pro = $province->findOne(['provinceid' => $result_post['provinceid']]);

    if(isset($_POST["edit-post"])) {
        
    }
?>
<body>
    <!----------------------------Header--------------------------->
    <?php
        require('common/role-header.php');
    ?>
    <!----------------------------Header-------------------------------->
    <main>
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