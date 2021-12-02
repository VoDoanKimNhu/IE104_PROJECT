<?php
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

    $viewerid = 5;

    $postid = 1;
    $result = $post->findOne(['postid' => $postid]);
    
    $title = $result['title'];
    $description = $result['description'];
    $accountid = $result['accountid'];
    $content = $result['content'];
    $date = $result['date'];
    $imgs = $result['img'];
    $province = $result['province'];

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
                        <p><?php echo $content?></p>
                        <br>
                    </div>
                    <br>
                    <div class="detail-content">
                        <h3>Ethnic culture</h3>
                        <p>Learning about local culture is a great way to start your time in Sapa. Many minorities in this region still wear their ethnic dress, live in simple villages, and embrace ancient customs. The morning markets are the perfect place to witness the vibrant culture of the ethnic groups. Set aside time for Mường Hum, a small but charming Sunday morning market, or make the three-hour drive to Bắc Hà Market to see locals trading all types of colourful wares and produce. </p>
                        <p>You can also get to know the ethnic groups through their unique handmade costumes. Spend some time learning about the styles of the different tribes through sewing, embroidery, weaving or batik workshops. Each costume may take months to make. If you’d like to shop ethnic designs, drop in the IndigoCat store to buy authentic bags, jackets and pillows.</p>
                        <q><strong>TIP: ETHOS offers community-based tours for responsible travellers, ranging from motorbike rides to sewing classes to photography tours.</strong></q>
                        <br>
                        <br>

                        <h3>Mountain treks</h3>
                        <p>There are countless tour companies in Sapa, but choosing one that’s owned by locals and follows sustainable practices is the way to go. Before you head off, talk with your guide to decide on an itinerary that suits you. You may like to spend more time walking in the mountains, or learning about life in the villages. If you choose a multi-day or overnight trek, you’ll have a chance to sleep in one of the small ethnic villages in the mountains — a must-do experience!</p>
                        <p>Most treks begin with a walk to the wet market to buy food for your trip. Then, it’s an invigorating hike through the hills, full of exquisite panoramas and sweet mountain air. Follow your guide along winding paths, stopping for pictures along the way. Lunch is usually cooked over an open fire. Through the afternoon you may find yourself walking to scenic points, bamboo groves or waterfalls. Sapa has trails for everyone. Pace yourself and enjoy the view.</p>
                        <q><strong>TIP: Sapa Sisters are known for excellent tailored tours led by local guides. These homegrown tours will give you context about Sapa’s history and the reality of life for its ethnic minorities today.</strong></q>
                        <br>
                        <br>

                        <h3>Sustainable stays</h3>
                        <p>Choosing where to stay in Sapa is half the fun of planning your trip. In the town, or out in the terraces? A pool and buffet, or family-style hospitality? There’s lot to choose from in every category, but some of Sapa’s most unique accommodations are its homestays. Staying with an ethnic family supplements the small income they receive from farming and gives you the chance to hear stories about local life, taste delicious ethnic dishes, and make wonderful new friends. </p>
                        <p>If you are looking for a leisurely escape or a getaway with someone special, spring for a bungalow at Topas Ecolodge. This mountain retreat is known for incredible views of Sapa’s misty peaks and terraced valleys (especially from its two saltwater pools) however the lodge is also a leader when it comes to sustainability. To its credit, Topas employs more than 100 staff from nearby villages, recycles its wastewater and glass, reduces plastic and packaging, and buys from local suppliers.</p>
                        <br>

                        <h3>Herbal baths</h3>
                        <p>You can’t leave Sapa without trying its famous herbal baths. The Red Dzao women have perfected the recipe for a healing soak, using bark and leaves harvested in the forests. The leaves are chopped and left to dry in the sun, then boiled in huge pots of water to create an aromatic, steamy blend used to soothe tired muscles, stave off sickness, and help women recover after childbirth. </p>
                        <p>Dedicate a few hours to visit the Sapa-napro bathhouse in the village of Tả Phìn. Spend a half-hour soaking in a barrel full of bubbly, piping hot liquid for just 150,000 VND, then enjoy a late lunch or hot chocolate in the adjacent cafe, with Sapa’s magnificent views accompanying you every minute.</p>
                        <q><strong>TIP: If you don’t fancy the ride to Tả Phìn Village, you can book a healing herbal bath in town at Victoria Sapa Resort & Spa, followed by a massage of your choice. Bliss!</strong></q>
                        <br>
                        <br>

                        <h3>Sapa flavours </h3>
                        <p>Like the rest of Vietnam, in Sapa you’ll find just-picked produce to be the highlight of the table. Ethnic families dine mainly on herbs and vegetables, river fish, and smoked buffalo meat. There are some unusual ethnic dishes for adventurous travellers, but even picky eaters will love the region’s fresh handmade tofu and chayote leaves (rau su su) sauteed with garlic. Be sure to try Sapa’s famous rainbow trout, served in a warming soup, or grilled with spices and rolled in rice paper with cucumber, greens and herbs. </p>
                        <p>The Hill Station Restaurant on Fansipan Street offers cooking classes in authentic Black H’mong cuisine, including a trip to the local market. If you’re a foodie, you might like to stay with Topas Ecolodge or Topas Riverside Lodge, where the chefs lay out amazing hotpots, wood-fired barbecue dinners, and seasonal spreads made with ingredients from the lodge’s organic farms. </p>
                        <br>
                    </div>
                    <br>
                    <div class="summary">
                        <p>There are now several excellent transport options to Sapa from Hanoi. Comfortable limo vans (from 450,000 VND) from downtown Hanoi take about five to six hours, and will drop you off in Sapa town, where you can take a taxi to homestays and lodges in the surrounding valleys. Many travellers take the eight-hour night train (from 900,000 VND) from Hanoi to Lào Cai, where another hour-long ride is required to reach Sapa town. To hire a private car and driver from Hanoi to Sapa costs about 3.5 million VND one way. </p>
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

                $no_of_records_per_page = 1;
                $offset = ($pageno-1)*$no_of_records_per_page;
                $rec_count = $num_cmt;
                $total_pages = ceil($rec_count/$no_of_records_per_page);
                
                $res = $comment->find(['postid' => 1]);

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
            </ul>
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
