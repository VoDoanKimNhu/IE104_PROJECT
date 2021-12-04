<?php
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

    $viewerid = 1;
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
            <button class="all">ALL</button>
            <div class="search-container">
                <form action="place.php" method="POST">
                    <!-- <input type="text" placeholder="Search.." name="search"> -->
                    <div class="form-group">
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
                    <button type="submit" name="search"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>

        <div class="content-container">
            <?php
                if(isset($_POST['search'])) {
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
            }
            ?>
        </div>
    </main>


    <!------------------------------Footer---------------------------------------------------->

    <?php
        require('common/footer.php');
    ?>

    <!------------------------------Footer---------------------------------------------------->


</body>