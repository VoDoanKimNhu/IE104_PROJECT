<?php
    require('common/document-head.php');
?>
<title>Home</title>
<link href="./css/style-home.css" rel="stylesheet">
<link href="./css/style.css" rel="stylesheet">
</head>
<?php
    error_reporting(0);    
    use MongoDB\Client;

    require_once "vendor/autoload.php";

    $conn = new Client("mongodb+srv://kimnhu:kimnhu@cluster0.uvhrc.mongodb.net/?serverSelectionTryOnce=false&serverSelectionTimeoutMS=15000&w=majority");
    $db = $conn->IE104_PROJECT;
    $post = $db->POST;
    $account = $db->ACCOUNT;
    $comment = $db->COMMENT;
    $province = $db->PROVINCE;

    $viewerid = 1;
    $result_post = $post->find();
?>
<body>
    <?php
        require('common/header.php');
    ?>
    <main>
        <!-----------------------------Blog Carousel---------------------------------->
        <article class="slideshow-container">
            <div class="slides fade" style="display: block;">
                <!-- <a href="blog-content.php" target="_self">
                    <div class="nameImg" data-aos="flip-up" data-aos-delay="300">
                        <h1>Mã Pí Lèng - Hà Giang</h1>
                        <p>Since NASA’s inception in 1958, astronauts have landed on the moon, parked a robot-controlled rover</p>
                    </div>
                </a> -->
                <img src="image/welcomeVN.png" style="width: 100%;">
            </div>

            <div class="slides fade">
                <img src="image/dalat.png" style="width: 100%;">
            </div>

            <div class="slides fade">
                <img src="image/hagiang.png" style="width: 100%;">
            </div>

            <div class="slides fade">
                <img src="image/halong.png" style="width: 100%;">
            </div>

            <div class="slides fade">
                <img src="image/hue.png" style="width: 100%;">
            </div>

            <div class="slides fade">
                <img src="image/maichau.png" style="width: 100%;">
            </div>

            <div class="slides fade">
                <img src="image/nhatrang.png" style="width: 100%;">
            </div>

            <div class="slides fade">
                <img src="image/ninhbinh.png" style="width: 100%;">
            </div>

            <div class="slides fade">
                <img src="image/phuquoc.png" style="width: 100%;">
            </div>

            <div class="slides fade">
                <img src="image/sapa.png" style="width: 100%;">
            </div>

            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>

            <br>
            <div class="dotbox" style="text-align:center">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
                <span class="dot" onclick="currentSlide(4)"></span>
                <span class="dot" onclick="currentSlide(5)"></span>
                <span class="dot" onclick="currentSlide(6)"></span>
                <span class="dot" onclick="currentSlide(7)"></span>
                <span class="dot" onclick="currentSlide(8)"></span>
                <span class="dot" onclick="currentSlide(9)"></span>
                <span class="dot" onclick="currentSlide(10)"></span>
            </div>

            <script src="js/home.js"></script>

        </article>
        <!-----------------------------Blog Carousel---------------------------------->

        <div class="intro">
            <div class="centered">
                <h1>See Share Viet Nam</h1>
                <p>#SeeShareVN is a chance for travellers to see Vietnam through the eyes of the people who call it
                    home.
                    <br>Here, Vietnamese from north to south share personal stories and favourite moments from their
                    cities.
                </p>
            </div>
            <img src="image/lotus.png">
        </div>


        <!------------------------------Site Content------------------------------->
        <section class="site-container">
            <div class="site-content">
                <div class="posts">
                <?php
                    if (isset($_GET['pageno'])) {
                        $pageno = $_GET['pageno'];
                    } else {
                        $pageno = 1;
                    }

                    $no_of_records_per_page = 4;
                    $offset = ($pageno-1)*$no_of_records_per_page;
                    $rec_count = 16;
                    $total_pages = ceil($rec_count/$no_of_records_per_page);
                    
                    $new_post = $post->find([],['sort' => ['_id' => -1], 'limit' => 16]);

                    $i = 0;
                    foreach ($new_post as $row) {
                        if($i>=$offset && $i<$offset+$no_of_records_per_page) {
                            $new_accountid = $row->accountid;

                            $post_account = $account->findOne(['accountid' => $new_accountid]);

                            $post_cmt = $comment->find(['postid' => $row->postid]);
                            $count_cmt = 0;
                            foreach($post_cmt as $cmt) {
                                $count_cmt++;
                            }
                            ?>
                                <div class="post-content" data-aos="zoom-in" data-aos-delay="<?php $i*10;?>">
                                    <div class="post-image image">
                                        <div>
                                            <img src="image/<?php echo $row['img'][0];?>" class="img-p" alt="Image name">
                                        </div>
                                        <div class="post-info flex-row">
                                            <span><i class="fa-solid fa-user"></i>&nbsp;&nbsp;<?php echo $post_account['lastname'];?></span>
                                            <span><i class="fas fa-calendar-alt text-gray"></i>&nbsp;&nbsp;<time
                                        datetime="<?php echo $row->date;?>"><?php echo $row->date;?></time> </span>
                                            <span><?php echo $count_cmt;?> Comments</span>
                                        </div>
                                    </div>
                                    <div class="post-title">
                                        <a class="post-cont" href="blog-content.php?postid=<?php echo $row->postid;?>"><?php echo $row->title;?></a>
                                        <p>
                                            <?php echo $row->description;?>
                                        </p>
                                        <button class="btn post-btn"><a href="blog-content.php" style="color: rgb(153, 8, 8);">
                                                Read More &nbsp;<i style="color: rgb(153, 8, 8);"
                                                    class="fas fa-arrow-right"></i></a></button>
                                    </div>
                                </div>
                                <hr>
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
                </div>    
                <aside class="sidebar">
                    <div class="popular-post">
                        <h1>Popular Posts</h1>
                        <?php 
                            $num_cmts = array();
                            $id_post = array();
                            $i = 0;
                            $top_post = $post->find();

                            foreach($top_post as $row) {
                                $cnt = 0;
                                $res_cmt = $comment->find(['postid'=>$row->postid]);
                                foreach($res_cmt as $cmtss) {
                                    $cnt++;
                                }
                                $id_post[$i] = $row->postid;
                                $num_cmts[$i] = $cnt;
                                $i++;
                            }

                            rsort($num_cmts);
                            $top4 = array_slice($num_cmts, 0, 4);
                        
                            foreach ($top4 as $key => $val) {
                                // echo $val;
                                // echo $key."k\n";
                                $post__ = $post->findOne(['postid' => $id_post[$key]]);
                                ?>
                                    <div class="post-content" data-aos="flip-up" data-aos-delay="300">

                                    <div class="post-image">
                                        <div>
                                            <img src="image/<?php echo $post__['img'][0];?>" class="img-p"
                                                alt="Image name">
                                        </div>
                                    </div>

                                    <div class="post-title">
                                        <a class="post-cont" href="blog-content.php?postid=<?php echo $key;?>"><?php echo $post__['title'];?></a>
                                    </div>

                                </div>
                                <?php
                            }
                        ?>
                    </div>
                    <div class="popular-tag">
                        <h1>Popular Tags</h1>
                        <div class="tags flex-row">
                        <?php
                            $provinceid = array();
                            $index = 0;
                            $top10 = array_slice($num_cmts, 0, 10);
                            foreach ($top10 as $key => $val) {
                                $pro_post = $post->findOne(['postid'=>$id_post[$key]]);
                                $top_province = $province->findOne(['provinceid' => $pro_post['provinceid']]);

                                if($index == 0) {
                                    $provinceid[$index] = $top_province['name'];
                                    $index++;
                                } else {
                                    $check = true;
                                    for($i=0; $i<$index; $i++) {
                                        if($provinceid[$i] == $top_province['name']) {
                                            $check = false;
                                            break;
                                        }
                                    }
                                    if($check) {
                                        $provinceid[$index] = $top_province['name'];
                                        $index++;
                                    }
                                }
                            }
                            for($i=0; $i<$index; $i++) {
                                if($provinceid[$i] != '') {
                                ?>
                                <span class="tag" data-aos="flip-up" data-aos-delay="100"><a href="#"><?php echo $provinceid[$i];?></a></span>
                                <?php
                                }
                            }                        

                        ?>
                        </div>
                    </div>

                    <div class="gallery-image">
                        <h1>gallery image</h1>
                        <div class="gallery-container">
                            <div class="gallery">
                                <figure class="item1" data-aos="zoom-in-right" data-aos-easing="ease-out-cubic"
                                    data-aos-duration="1000">
                                    <img class="ga-img" src="image/See Vietnam Now - Vietnam Tourism - 3.jpg"
                                        onclick="openModal();currentSlideImg(1)" alt="Always a foodie destination, 
                                        Vietnam is taking travellers deeper into its markets, 
                                        farms and kitchens with great new tours for culinary enthusiasts.">
                                </figure>
                                <figure class="item2" data-aos="zoom-in-left" data-aos-easing="ease-out-cubic"
                                    data-aos-duration="1000">
                                    <img class="ga-img" src="image/See Vietnam Now - Vietnam Tourism - 18.jpg"
                                        onclick="openModal();currentSlideImg(2)">
                                </figure>
                                <figure class="item3" data-aos="zoom-out-up" data-aos-easing="ease-out-cubic"
                                    data-aos-duration="1000">
                                    <img class="ga-img" src="image/things to do in hcmc-7.jpg"
                                        onclick="openModal();currentSlideImg(3)">
                                </figure>
                                <figure class="item4" data-aos="flip-left" data-aos-easing="ease-out-cubic"
                                    data-aos-duration="1000">
                                    <img class="ga-img" src="image/See Vietnam Now - Vietnam Tourism - 11.jpg"
                                        onclick="openModal();currentSlideImg(4)">
                                </figure>
                                <figure class="item5" data-aos="flip-up" data-aos-easing="ease-out-cubic"
                                    data-aos-duration="1000">
                                    <img class="ga-img" src="image/Cao_Bang-Ban_Gioc_Waterfall-0014 text.jpg"
                                        onclick="openModal();currentSlideImg(5)">
                                </figure>
                                <figure class="item6" data-aos="flip-down" data-aos-easing="ease-out-cubic"
                                    data-aos-duration="1000">
                                    <img class="ga-img" src="image/Da Nang Best Dishes Vietnam Tourism.jpg"
                                        onclick="openModal();currentSlideImg(6)">
                                </figure>
                                <figure class="item7" data-aos="fade-left" data-aos-easing="ease-out-cubic"
                                    data-aos-duration="1000">
                                    <img class="ga-img" src="image/Water puppet shows Vietnam Tourism.jpg"
                                        onclick="openModal();currentSlideImg(7)">
                                </figure>
                                <figure class="item8" data-aos="fade-right" data-aos-easing="ease-out-cubic"
                                    data-aos-duration="1000">
                                    <img class="ga-img" src="image/See Vietnam Now - Vietnam Tourism - 9.jpg"
                                        onclick="openModal();currentSlideImg(8)">
                                </figure>
                                <figure class="item9" data-aos="fade-up" data-aos-easing="ease-out-cubic"
                                    data-aos-duration="1000">
                                    <img class="ga-img" src="image/See Vietnam Now - Vietnam Tourism - 7_0.jpg"
                                        onclick="openModal();currentSlideImg(9)">
                                </figure>
                            </div>

                            <div id="imgModal" class="imgmodal">
                                <span class="close cursor" onclick="closeModal()">&times;</span>
                                <div class="imgmodal-content">

                                    <div class="slider">
                                        <div class="numbertext">1 / 9</div>
                                        <img src="image/See Vietnam Now - Vietnam Tourism - 3.jpg" style="width:100%"
                                            alt="Always a foodie destination, Vietnam is taking travellers deeper into its markets, 
                                            farms and kitchens with great new tours for culinary enthusiasts.">
                                        <div class="caption-container">
                                            <p id="caption">Always a foodie destination, Vietnam is taking travellers
                                                deeper into its markets, farms and kitchens with great new tours for
                                                culinary enthusiasts.</p>
                                        </div>
                                    </div>


                                    <div class="slider">
                                        <div class="numbertext">2 / 9</div>
                                        <img src="image/See Vietnam Now - Vietnam Tourism - 18.jpg" style="width:100%"
                                            alt="Craving a break? Head for the hills, mountains, or forests of northern Vietnam 
                                            to reconnect with nature and have views like this all to yourself.">
                                        <div class="caption-container">
                                            <p id="caption">Craving a break? Head for the hills, mountains, or forests
                                                of northern Vietnam to reconnect with nature and have views like this
                                                all to yourself.</p>
                                        </div>
                                    </div>

                                    <div class="slider">
                                        <div class="numbertext">3 / 9</div>
                                        <img src="image/things to do in hcmc-7.jpg" style="width:100%"
                                            alt="A man lights incense at a temple in District 5">
                                        <div class="caption-container">
                                            <p id="caption">A man lights incense at a temple in District 5</p>
                                        </div>
                                    </div>

                                    <div class="slider">
                                        <div class="numbertext">4 / 9</div>
                                        <img src="image/See Vietnam Now - Vietnam Tourism - 11.jpg" style="width:100%"
                                            alt="You can’t leave Vietnam without seeing the agricultural side of the country. 
                                            The Mekong Delta is alive with colours, smells, and riveting sights.">
                                        <div class="caption-container">
                                            <p id="caption">You can’t leave Vietnam without seeing the agricultural side
                                                of the country. The Mekong Delta is alive with colours, smells, and
                                                riveting sights.</p>
                                        </div>
                                    </div>

                                    <div class="slider">
                                        <div class="numbertext">5 / 9</div>
                                        <img src="image/Cao_Bang-Ban_Gioc_Waterfall-0014 text.jpg" style="width:100%">
                                        <div class="caption-container">
                                            <p id="caption">You can’t leave Vietnam without seeing the agricultural side
                                                of the country. The Mekong Delta is alive with colours, smells, and
                                                riveting sights.</p>
                                        </div>
                                    </div>

                                    <div class="slider">
                                        <div class="numbertext">6 / 9</div>
                                        <img src="image/Da Nang Best Dishes Vietnam Tourism.jpg" style="width:100%"
                                            alt="Bún cá and mì Quảng are served at street stalls all over the city.">
                                        <div class="caption-container">
                                            <p id="caption">Bún cá and mì Quảng are served at street stalls all over the
                                                city.</p>
                                        </div>
                                    </div>
                                    <div class="slider">
                                        <div class="numbertext">7 / 9</div>
                                        <img src="image/Water puppet shows Vietnam Tourism.jpg" style="width:100%"
                                            alt="Traditional water puppet shows recreate scenes of rural life.">
                                        <div class="caption-container">
                                            <p id="caption">Traditional water puppet shows recreate scenes of rural
                                                life.</p>
                                        </div>
                                    </div>

                                    <div class="slider">
                                        <div class="numbertext">8 / 9</div>
                                        <img src="image/See Vietnam Now - Vietnam Tourism - 9.jpg" style="width:100%"
                                            alt="More than just street food, Vietnamese cuisine is getting an update from 
                                            enterprising young chefs. This 100$ pho from Anan Saigon is worth every penny.">
                                        <div class="caption-container">
                                            <p id="caption">More than just street food, Vietnamese cuisine is getting an
                                                update from enterprising young chefs. This 100$ pho from Anan Saigon is
                                                worth every penny.</p>
                                        </div>
                                    </div>

                                    <div class="slider">
                                        <div class="numbertext">9 / 9</div>
                                        <img src="image/See Vietnam Now - Vietnam Tourism - 7_0.jpg" style="width:100%"
                                            alt="Some of Vietnam’s most compelling stories centre around its 54 ethnic groups, 
                                            such as the K’ho people who were the first coffee planters in Vietnam.">
                                        <div class="caption-container">
                                            <p id="caption">Some of Vietnam’s most compelling stories centre around its
                                                54 ethnic groups, such as the K’ho people who were the first coffee
                                                planters in Vietnam.</p>
                                        </div>
                                    </div>

                                    <a class="prev-ga" onclick="plusSlideImgs(-1)">&#10094;</a>
                                    <a class="next-ga" onclick="plusSlideImgs(1)">&#10095;</a>

                                </div>
                            </div>

                        </div>
                    </div>

                    <script src="./js/js-modal-img.js"></script>

                </aside>
            </div>
        </section>

        <!------------------------------Site Content------------------------------->

    </main>
    <!-----------------------------Main Site Section------------------------------------>

    <?php
        require('common/footer.php');
    ?>
    <script type="text/javascript">
        $(document).ready(function () {
            AOS.init();
        });
    </script>
</body>

</html>