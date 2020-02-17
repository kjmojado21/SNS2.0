<?php
include 'Connection.php';
class User extends Connection
{

    public function registerUser($fname, $email, $password)
    {
        $firstQuery = "INSERT INTO login_tbl(user_email,user_password)VALUES('$email','$password')";
        $firstQueryResult = $this->conn->query($firstQuery);

        if ($firstQueryResult == TRUE) {
            $loginID = $this->conn->insert_id;
            $secondQuery = "INSERT INTO users_tbl(user_fullname,login_id)VALUES('$fname','$loginID')";
            $secondQueryResult = $this->conn->query($secondQuery);
            if ($secondQueryResult == FALSE) {
                echo "second query failed";
            } else {
                $userLoginID = $this->conn->insert_id;
                $thirdResult = $this->conn->query("INSERT INTO followed_users(user_id,followed_user_id)VALUES('$userLoginID','$userLoginID')");
                header('location:login.php');
            }
        } else {
            echo "first query failed";
        }
    }
    public function login($username, $password)
    {
        $sql = "SELECT * FROM login_tbl WHERE user_email = '$username' AND user_password = '$password'";
        $result = $this->conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $_SESSION['login_id'] = $row['login_id'];
            header('location:homepage.php');
        } else {
            echo "<div class = 'alert alert-danger'>User doesnt exist!</div>";
        }
    }
    public function getOneUser($id)
    {
        $sql = "SELECT * FROM users_tbl INNER JOIN login_tbl ON users_tbl.login_id = login_tbl.login_id WHERE users_tbl.user_id = '$id'";
        $result = $this->conn->query($sql);
        if ($result == FALSE) {
            die($this->conn->error);
        } else {
            return $result->fetch_assoc();
        }
    }
    public function updateUser($id, $fname, $age, $bdate, $location)
    {
        $sql = "UPDATE users_tbl SET user_fullname = '$fname',user_age = '$age',user_bdate = '$bdate',user_location = '$location' WHERE user_id  = '$id'";
        $result = $this->conn->query($sql);
        if ($result == FALSE) {
            die($this->conn->error);
        } else {
            header('location:profile.php');
        }
    }

    // cover photos settings
    public function uploadProfilePicture($id, $picture)
    {
        $dir = 'uploads/';
        $targetDir = $dir . basename($picture);
        $sql = "UPDATE users_tbl SET user_img = '$picture' WHERE user_id = '$id'";
        $result = $this->conn->query($sql);
        if ($result == FALSE) {
            die($this->conn->error);
        } else {
            move_uploaded_file($_FILES['user_pp']['tmp_name'], $targetDir);
            header('location:profile.php');
        }
    }
    public function userCoverPhoto($id)
    {
        $sql = "SELECT * FROM cover_img_tbl INNER JOIN users_tbl ON cover_img_tbl.user_id = users_tbl.user_id WHERE users_tbl.user_id = '$id'";
        $result = $this->conn->query($sql);
        if ($result == false) {
            die($this->conn->error);
        } else {
            return $result->fetch_assoc();
        }
    }
    public function updateCoverPhoto($id, $picture)
    {
        $dir = 'cover_images/';
        $targetDir = $dir . basename($picture);
        $sql = "UPDATE cover_img_tbl SET img_name = '$picture' WHERE user_id = '$id'";
        $result = $this->conn->query($sql);
        if ($result == FALSE) {
            die($this->conn->error);
        } else {
            move_uploaded_file($_FILES['user_cover_img']['tmp_name'], $targetDir);
            header('location:profile.php');
        }
    }
    public function addCoverImage($id, $picture)
    {
        $dir = 'cover_images/';
        $targetDir = $dir . basename($picture);
        $sql = "INSERT INTO cover_img_tbl(img_name,user_id)VALUES('$picture','$id')";
        $result = $this->conn->query($sql);
        if ($result == FALSE) {
            die($this->conn->error);
        } else {
            move_uploaded_file($_FILES['cover_img']['tmp_name'], $targetDir);
            header('location:profile.php');
        }
    }


    // posts methods
    // method for adding posts
    public function addPost($id, $content)
    {
        $sql = "INSERT INTO posts_tbl(user_id,post_content)VALUES('$id','$content')";
        $result = $this->conn->query($sql);

        if ($result == FALSE) {
            die($this->conn->error);
        } else {
            header('location:homepage.php');
        }
    }

    // adding posts with image
    public function addPostWithImage($id, $content, $img)
    {
        $dir = 'postImages/';
        $targetDir = $dir . basename($img);
        $sql = "INSERT INTO posts_tbl(user_id,post_content,post_image)VALUES('$id','$content','$img')";
        $result = $this->conn->query($sql);

        if ($result == FALSE) {
            die($this->conn->error);
        } else {
            move_uploaded_file($_FILES['post_image']['tmp_name'], $targetDir);
            header('location:homepage.php');
        }
    } 
    
	
    // user settings
    // function time2string($timeline) {
    //     $periods = array('hour' => 3600, 'minute' => 60, 'second' => 1);
    //     $ret = 0;
    
    //     foreach($periods AS $name => $seconds){
    //         $num = floor($timeline / $seconds);
    //         $timeline -= ($num * $seconds);
    //         $ret .= $num.' '.$name.(($num > 1) ? 's' : '').' ';
    //     }
    
    //     return trim($ret);
    // }
    
        

    public function getAllPost()
    {
        $sql = "SELECT *  FROM posts_tbl";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = array();
            while ($rows = $result->fetch_assoc()) {
                $row[] = $rows;
            }
            return $row;
        } else {
            return FALSE;
        }
    }
    public function getFollowedUserPosts($id)
    {
        $sql = "SELECT * FROM posts_tbl INNER JOIN followed_users ON posts_tbl.user_id = followed_users.followed_user_id
        INNER JOIN users_tbl ON posts_tbl.user_id = users_tbl.user_id
        INNER JOIN login_tbl ON users_tbl.login_id = login_tbl.login_id
        WHERE followed_users.user_id = '$id'
         ORDER BY posts_tbl.post_id DESC";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $row = array();
            while ($rows = $result->fetch_assoc()) {
                $row[] = $rows;
            }
            return $row;
        } else {
            return FALSE;
        }
    }

    public function getUserPosts($id)
    {
        $sql = "SELECT * FROM posts_tbl INNER JOIN users_tbl ON posts_tbl.user_id = users_tbl.user_id WHERE posts_tbl.user_id = '$id' ORDER BY posts_tbl.post_id DESC";
        $result  = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = array();
            while ($rows = $result->fetch_assoc()) {
                $row[] = $rows;
            }
            return $row;
        } else {
            return FALSE;
        }
    }
    public function searchUser($input)
    {
        $sql = "SELECT * FROM login_tbl INNER JOIN users_tbl ON login_tbl.login_id = users_tbl.user_id WHERE login_tbl.user_email LIKE '%$input%' OR users_tbl.user_fullname LIKE '%$input%'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = array();
            while ($rows = $result->fetch_assoc()) {
                $row[] = $rows;
            }
            return $row;
        } else {
            return FALSE;
        }
    }
    



    // follow,unfollow methods
    public function followUser($userid, $followedID)
    {
        $sql = "INSERT INTO followed_users(user_id,followed_user_id,status)VALUES('$userid','$followedID','followed')";
        $result = $this->conn->query($sql);
        if ($result == FALSE) {
            die($this->conn->error);
        } else {

            header('location:searchedResult.php');
        }
    }
    public function validateUserRelationship($userid, $randomUserID)
    {
        $sql = "SELECT * FROM followed_users WHERE user_id = '$userid' AND followed_user_id = '$randomUserID'";
        $result = $this->conn->query($sql);

        if ($result->num_rows == 1) {
            return "unfollow";
        } else {
            return "follow";
        }
    }
    public function unfollow($id, $randomUserID)
    {
        $sql = "DELETE FROM followed_users WHERE user_id = '$id' AND followed_user_id = '$randomUserID'";
        $result = $this->conn->query($sql);

        if ($result == FALSE) {
            die($this->conn->error);
        } else {
            header('location:searchedResult.php');
        }
    }
    public function countFollowing($id){
        $sql = "SELECT * FROM followed_users";
        $result = $this->conn->query($sql);

        if($result->num_rows>0){
            return $result->num_rows;
        }else{
            return 0;
        }
        
        
    }

    
}

