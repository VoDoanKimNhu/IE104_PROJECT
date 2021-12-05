<?php
    error_reporting(0);
    use MongoDB\Client;

    require_once "vendor/autoload.php";

    $conn = new Client("mongodb+srv://kimnhu:kimnhu@cluster0.uvhrc.mongodb.net/?serverSelectionTryOnce=false&serverSelectionTimeoutMS=15000&w=majority");
    $db = $conn->IE104_PROJECT;
    $post = $db->POST;
    $account = $db->ACCOUNT;

    $viewerid = 1;

    $result_act = $account->findOne(['accountid' => $viewerid]);
    $result_post = $post->find(['accountid' => $viewerid]);    

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
