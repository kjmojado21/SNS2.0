<?php 
include 'classes/User.php';
$UserClass = new User;

if(isset($_POST['signup'])){
    $fullname = $_POST['user_fname'];
    $email = $_POST['user_email'];
    $password = $_POST['password'];
    $repassword = $_POST['re_pass'];

   if($password === $repassword){
    $UserClass->registerUser($fullname,$email,$password);
   }else{
       header('location:register.php');
       echo "<div class = 'alert alert-danger'>wrong password</div>";
   }
}
elseif(isset($_POST['login'])){
    $username = $_POST['email'];
    $password = $_POST['password'];

    $UserClass->login($username,$password);

}elseif(isset($_POST['upload'])){
    $profilePicture = $_FILES['user_pp']['name'];
    $userID = $_SESSION['login_id'];

    $UserClass->uploadProfilePicture($userID,$profilePicture);

}elseif(isset($_POST['uploadCover'])){
    $coverImg = $_FILES['cover_img']['name'];

    $UserClass->addCoverImage($_SESSION['login_id'],$coverImg);

}elseif(isset($_POST['updateUserInfo'])){
    $fname = $_POST['fname'];
    $age = $_POST['age'];
    $bdate = $_POST['bdate'];
    $location = $_POST['location'];

    $UserClass->updateUser($_SESSION['login_id'],$fname,$age,$bdate,$location);
}elseif(isset($_POST['updateCoverPhoto'])){
    $coverImg = $_FILES['user_cover_img']['name'];
    $UserClass->updateCoverPhoto($_SESSION['login_id'],$coverImg);

}elseif(isset($_POST['updateProfilePhoto'])){
    $profile_picture = $_FILES['user_pp']['name'];

    $UserClass->uploadProfilePicture($_SESSION['login_id'],$profile_picture);

}elseif(isset($_POST['addPost'])){
    $content = $_POST['user_post'];
    if(!empty($_FILES['post_image']['name'])){
        $img = $_FILES['post_image']['name'];

        $UserClass->addPostWithImage($_SESSION['login_id'],$content,$img);

    }else{
        // $content = $_POST['user_post'];
        $UserClass->addPost($_SESSION['login_id'],$content);
    }

}
elseif(isset($_POST['search'])){
    $searchedUser = $_POST['searched_user'];
    
    $_SESSION['searched_user'] = $searchedUser;
    header('location:searchedResult.php');

}elseif(isset($_POST['follow_user'])){

    $followedID = $_POST['followed_user_id'];
    $userID = $_POST['user_id'];

    // echo $userID;

    $UserClass->followUser($userID,$followedID);

}elseif(isset($_POST['unfollow'])){
    $followedID = $_POST['followed_user_id'];
    $userID = $_POST['user_id'];

    $UserClass->unfollow($userID,$followedID);
}elseif(isset($_POST['addComment'])){
    $postID = $_POST['post_id'];
    $userID = $_POST['user_id'];
    $comment =$_POST['comment'];

    $UserClass->simpleComment($userID,$postID,$comment);
}

// $time = time()-strtotime('2020-02-12 12:16:05');

?>
<?php
// date_default_timezone_set("Asia/Manila");
// // $current_time = date("h:i:s");
// $postTime= strtotime('12:31:23');


// $current_time_str = time();


// $post_time = $current_time_str - $postTime;

// function time_since($since) {
//     $chunks = array(
//         array(60 * 60 * 24 * 365 , 'year'),
//         array(60 * 60 * 24 * 30 , 'month'),
//         array(60 * 60 * 24 * 7, 'week'),
//         array(60 * 60 * 24 , 'day'),
//         array(60 * 60 , 'hour'),
//         array(60 , 'minute'),
//         array(1 , 'second')
//     );

//     for ($i = 0, $j = count($chunks); $i < $j; $i++) {
//         $seconds = $chunks[$i][0];
//         $name = $chunks[$i][1];
//         if (($count = floor($since / $seconds)) != 0) {
//             break;
//         }
//     }

//     $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
//     return $print;
// }

// echo time_since($post_time)." Ago";
?>


