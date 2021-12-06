<?php
    error_reporting(0);
    require('common/document-head.php');
?>
<title>Place</title>

<link href="./css/style-place.css" rel="stylesheet">

</head>
<?php
    use MongoDB\Client;

    require_once "vendor/autoload.php";

    $conn = new Client("mongodb+srv://kimnhu:kimnhu@cluster0.uvhrc.mongodb.net/?serverSelectionTryOnce=false&serverSelectionTimeoutMS=15000&w=majority");
    $db = $conn->IE104_PROJECT;
    $post = $db->POST;
    $province = $db->PROVINCE;
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
                <h1>Places to go</h1>
                <p>Get an insider look at Vietnam’s best destinations.</p>
            </div>
        </section>

        <div class="centered">
            <h1>Urban Hubs</h1>
            <p>Each Vietnamese city exudes its own distinct character.
                <br> Get a feel for Vietnam’s fascinating urban centres in these interactive tours.
                <br>Let these local Vietnamese show you around their hometowns with personal stories, top tips, and
                must-do experiences.

            </p>
        </div>
        <div class="filter">
            <!-- <form action="place.php" method="POST">
                <button class="all" name="search_all">ALL</button>
            </form> -->
            <div class="search-container">
                <form action="place.php" method="POST">
                    <!-- <input type="text" placeholder="Search.." name="search"> -->
                    <div class="form-group" >
                        <select style="display: inline-block; padding: 20px; width: 200px;" id="province" name="province" value="selected">
                            <?php
                                $pro = $province->find();
                                foreach($pro as $row) {
                                    ?>
                                        <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == (int) $row->provinceid) echo "selected";?> value="<?php echo $row->provinceid;?>"><?php echo $row->name;?></option>
                                    <?php
                                }       
                            ?>
                        </select>
                    </div>
                    <button style="display: inline-block;" type="submit" name="search"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>

        <div class="content-container">
            <?php
                if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
                    $search_post_ = $post->find(['provinceid' => (int) $_POST['province']]);
                    $num_post = 0;
                    foreach($search_post_ as $row) {
                        $num_post++;
                    }

                    if (isset($_GET['pageno'])) {
                        $pageno = $_GET['pageno'];
                    } else {
                        $pageno = 1;
                    }
    
                    $no_of_records_per_page = 4;
                    $offset = ($pageno-1)*$no_of_records_per_page;
                    $rec_count = $num_post;
                    $total_pages = ceil($rec_count/$no_of_records_per_page);
    
                    $search_post = $post->find(['provinceid' => (int) $_POST['province']]);

                    foreach($search_post as $row) {
                    ?>
                        <div class="place">
                            <div class="place-img">
                                <a href="blog-content.php?postid=<?php echo $row->postid;?>"><img src="./image/<?php echo $row->img[0];?>" alt="<?php echo $row->title;?>"></a>
                            </div>
                    
                            <div class="place-intro">

                                <h1 class="title">
                                    <a href="blog-content.php?postid=<?php echo $row->postid;?>"><?php echo $row->title;?></a>
                                </h1>
                                <p style="font-size: 16px;" class="introduce"><?php echo $row->description;?></p>
                            </div>
                        </div>
                    <?php
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

                <?php
            }
            // if(isset($_POST['search_all'])) {
            // }
        ?>
        </div>
    </main>
    <!------------------------------Footer---------------------------------------------------->

    <?php
        require('common/footer.php');
    ?>

    <!------------------------------Footer---------------------------------------------------->
</body>