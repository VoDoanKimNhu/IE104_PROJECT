<?php
    error_reporting(0);
    session_start();
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

    $viewerid = $_SESSION['accountid'];
?>
<body>
    <!----------------------------Header--------------------------->

    <?php
        require('common/role-header.php');
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
                <form action="role-place.php" method="POST">
                    <!-- <input type="text" placeholder="Search.." name="search"> -->
                    <div class="form-group">
                            <select id="province" name="province" value="selected">
                                <option  <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 0) echo "selected";?> value=0>Viet Nam</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 1) echo "selected";?>  <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 1) echo "selected";?> value=1>An Giang</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 2) echo "selected";?> value="2">Ba Ria - Vung Tau</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 3) echo "selected";?> value="3">Bac Giang</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 4) echo "selected";?> value="4">Bac Can</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 5) echo "selected";?> value="5">Bac Lieu</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 6) echo "selected";?> value="6">Bac Ninh</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 7) echo "selected";?> value="7">Ben Tre</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 8) echo "selected";?> value="8">Binh Dinh</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 9) echo "selected";?> value="9">Binh Duong</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 10) echo "selected";?> value="10">Binh Phuoc</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 11) echo "selected";?> value="11">Binh Thuan</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 12) echo "selected";?> value="12">Ca Mau</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 13) echo "selected";?> value="13">Can Tho</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 14) echo "selected";?> value="14">Cao Bang </option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 15) echo "selected";?> value="15">Da Nang</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 16) echo "selected";?> value="16">Dak Lak</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 17) echo "selected";?> value="17">Dak Nong</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 18) echo "selected";?> value="18">Dien Bien</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 19) echo "selected";?> value="19">Dong Nai</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 20) echo "selected";?> value="20">Dong Thap</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 21) echo "selected";?> value="21">Gia Lai</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 22) echo "selected";?> value="22">Ha Giang</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 23) echo "selected";?> value="23">Ha Nam</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 24) echo "selected";?> value="24">Ha Noi </option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 25) echo "selected";?> value="25">Ha Tinh</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 26) echo "selected";?> value="26">Hai Duong</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 27) echo "selected";?> value="27">Hai Phong</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 28) echo "selected";?> value="28">Hau Giang</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 29) echo "selected";?> value="29">Hoa Binh</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 30) echo "selected";?> value="30">Hung Yen</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 31) echo "selected";?> value="31">Khanh Hoa</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 32) echo "selected";?> value="32">Kien Giang</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 33) echo "selected";?> value="33">Kon Tum</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 34) echo "selected";?> value="34">Lai Chau</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 35) echo "selected";?> value="35">Lam Dong</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 36) echo "selected";?> value="36">Lang Son</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 37) echo "selected";?> value="37">Lao Cai</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 38) echo "selected";?> value="38">Long An</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 39) echo "selected";?> value="39">Nam Dinh</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 40) echo "selected";?> value="40">Nghe An</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 41) echo "selected";?> value="41">Ninh Binh</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 42) echo "selected";?> value="42">Ninh Thuan</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 43) echo "selected";?> value="43">Phu Tho</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 44) echo "selected";?> value="44">Phu Yen</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 45) echo "selected";?> value="45">Quang Binh</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 46) echo "selected";?> value="46">Quang Nam</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 47) echo "selected";?> value="47">Quang Ngai</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 48) echo "selected";?> value="48">Quang Ninh</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 49) echo "selected";?> value="49">Quang Tri</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 50) echo "selected";?> value="50">Soc Trang</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 51) echo "selected";?> value="51">Son La</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 52) echo "selected";?> value="52">Tay Ninh</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 53) echo "selected";?> value="53">Thai Binh</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 54) echo "selected";?> value="54">Thai Binh</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 55) echo "selected";?> value="55">Thanh Hoa</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 56) echo "selected";?> value="56">Thua Thien Hue</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 57) echo "selected";?> value="57">Tien Giang</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 58) echo "selected";?> value="58">Ho Chi Minh</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 59) echo "selected";?> value="59">Tra Vinh</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 60) echo "selected";?> value="60">Tuyen Quang</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 61) echo "selected";?> value="61">Vinh Long</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 62) echo "selected";?> value="62">Vinh Phuc</option>
                                <option <?php if($_SERVER["REQUEST_METHOD"] == "POST") if($_POST["province"] == 63) echo "selected";?> value="63">Yen Bai</option>                            
                            </select>
                        </div>
                    <button type="submit" name="search"><i class="fas fa-search"></i></button>
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
                                <p class="introduce"><?php echo $row->description;?></p>
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