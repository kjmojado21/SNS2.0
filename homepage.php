<?php
include 'userAction.php';
$currentUserID = $_SESSION['login_id'];
$currentUser = $UserClass->getOneUser($currentUserID);
$followedPosts = $UserClass->getFollowedUserPosts($currentUserID);
$currentUserPosts = $UserClass->getUserPosts($currentUserID);
$followingCount = $UserClass->countFollowing($_SESSION['login_id']);
$followersCount = $UserClass->countFollowers($currentUserID);

?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="css/homepage.css">
    <link rel="stylesheet" href="post.css">
    <script src="https://kit.fontawesome.com/eb83b1af77.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-light bg-white">
        <a href="#" class="navbar-brand">SNS2.0</a>
        <form method="POST" action="userAction.php" class="form-inline">
            <div class="input-group">
                <input type="text" class="form-control" name="searched_user" placeholder="Search" aria-label="Recipient's username" aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit" name="search" id="button-addon2">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </nav>


    <div class="container-fluid gedf-wrapper">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="h5">@<?php echo $currentUser['user_email'] ?></div>
                        <div class="h7 text-muted">Fullname : <?php echo $currentUser['user_fullname'] ?></div>
                        <div class="h7">Developer of web applications, JavaScript, PHP, Java, Python, Ruby, Java, Node.js,
                            etc.
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="h6 text-muted">Followers</div>
                            <div class="h5"><?php echo $followersCount   ?></div>
                        </li>
                        <li class="list-group-item">
                            <div class="h6 text-muted">Following</div>
                            <div class="h5"><?php echo $followingCount ?></div>
                        </li>
                        <li class="list-group-item">
                        <a href="logout.php" class="btn btn-outline-secondary btn-block" role="button">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>


            <div class="col-md-6 gedf-main">

                <!--- \\\\\\\Post-->
                <div class="card gedf-card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Make
                                    a publication</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="images-tab" data-toggle="tab" role="tab" aria-controls="images" aria-selected="false" href="#images">Images</a>
                            </li>
                        </ul>
                    </div>
                    <form action="userAction.php" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                                    <div class="form-group">
                                        <label class="sr-only" for="message">post</label>
                                        <textarea class="form-control" name="user_post" id="message" rows="3" placeholder="What are you thinking?"></textarea>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="post_image" id="customFile">
                                            <label class="custom-file-label" for="customFile">Upload image</label>
                                        </div>
                                    </div>
                                    <div class="py-4"></div>
                                </div>
                            </div>
                            <div class="btn-toolbar justify-content-between">
                                <div class="btn-group">
                                    <button type="submit" name="addPost" class="btn btn-primary">share</button>
                                </div>
                                <div class="btn-group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-globe"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item" href="#"><i class="fa fa-globe"></i> Public</a>
                                        <a class="dropdown-item" href="#"><i class="fa fa-users"></i> Friends</a>
                                        <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Just me</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Post /////-->

                <!--- \\\\\\\Post-->
                <?php
                if ($followedPosts == false) {
                    echo "<div class ='alert alert-warning text-center mt-5'>I see no posts, Follow Someone!</div>";
                } else {


                    foreach ($followedPosts as $row) {
                        if (!is_null($row['post_image'])) {
                ?>
                          <div class="card gedf-card mt-3">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="mr-2">
                                            <img class="rounded-circle" width="45" src="uploads/<?php echo $row['user_img'] ?>" alt="">
                                        </div>
                                        <div class="ml-2">
                                            <div class="h5 m-0">@<?php echo $row['user_email'] ?></div>
                                            <div class="h7 text-muted"><?php echo $row['user_fullname'] ?></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="dropdown">
                                            <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-ellipsis-h"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                                <div class="h6 dropdown-header">Configuration</div>
                                                <a class="dropdown-item" href="#">Save</a>
                                                <a class="dropdown-item" href="#">Hide</a>
                                                <?php 
                                                    if($row['user_id']!=$_SESSION['login_id']){    
                                                       ?>
                                                       <a class="dropdown-item" href="#">Report</a>
                                                    <?php
                                                    }else{
                                                 ?>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                <?php
                                                    }
                                                ?>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i><?php 
                               $postID = $row['post_id'];
                               $time = $UserClass->getPostTime($postID);
                              echo $time." ago";
                               ?>
                              
                               </div>
                                <a class="card-link" href="#">
                                    <h5 class="card-title"><?php 
                                        if(!is_null($row['post_content'])){
                                            echo $row['post_content'];
                                        }
                                    
                                    ?></h5>
                                </a>

                                <p class="card-text">
                                    <img src="postImages/<?php echo $row['post_image'] ?>" class="img-fluid" width="100%" alt="">
                                </p>
                            </div>
                            <div class="card-footer">
                                <a href="#" class="card-link"><i class="fa fa-gittip"></i> Like</a>


                                <a href="#contentId_<?php echo $row['post_id'] ?>" class="card-link" type="button" data-toggle="collapse" data-target="#contentId_<?php echo $row['post_id'] ?>" aria-expanded="false" aria-controls="contentId"><i class="fa fa-comment"></i> Comments</a>
            
                                <a href="#" class="card-link"><i class="fa fa-mail-forward"></i> Share</a>

                                <!-- comment collapse -->
                                <div class="collapse mt-3" id="contentId_<?php echo $row['post_id'] ?>">
                                   <form action="userAction.php" method="post" class="form-inline">
                                       <div class="input-group w-100">
                                           <input type="hidden" name="post_id" value="<?php echo $row['post_id'] ?>">
                                           <input type="hidden" name="user_id" value="<?php echo $_SESSION['login_id'] ?>">
                                            <input type="text" name="comment" placeholder="Comment" class="form-control">
                                            <div class="input-group-append">
                                                <button type="submit" name="addComment" class="btn btn-primary"><i class="fas fa-comment-medical"></i></button>
                                            </div>
                                       </div>
                                   </form>
                                </div>
                            </div>
                        </div>





                <?php
                        }else{
                         ?>
                  <div class="card gedf-card mt-3">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="mr-2">
                                            <img class="rounded-circle" width="45" src="uploads/<?php echo $row['user_img'] ?>" alt="">
                                        </div>
                                        <div class="ml-2">
                                            <div class="h5 m-0">@<?php echo $row['user_email'] ?></div>
                                            <div class="h7 text-muted"><?php echo $row['user_fullname'] ?></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="dropdown">
                                            <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-ellipsis-h"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                                <div class="h6 dropdown-header">Configuration</div>
                                                <a class="dropdown-item" href="#">Save</a>
                                                <a class="dropdown-item" href="#">Hide</a>
                                                <?php 
                                                    if($row['user_id']!=$_SESSION['login_id']){    
                                                       ?>
                                                       <a class="dropdown-item" href="#">Report</a>
                                                    <?php
                                                    }else{
                                                 ?>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body">
                            <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i> 
                            <?php 
                               $postID = $row['post_id'];
                               $time = $UserClass->getPostTime($postID);
                              echo $time." ago";
                               ?>
                              
                               </div>
                                <a class="card-link" href="#">
                                    <h5 class="card-title"><?php
                                    echo $row['post_content']
                                   ?></h5>
                                </a>

                                <p class="card-text">
                                
                                </p>
                            </div>
                            <div class="card-footer">
                                <a href="#" class="card-link"><i class="fa fa-gittip"></i> Like</a>
                                <a href="#contentId" class="card-link" type="button" data-toggle="collapse" data-target="#contentId_<?php echo $row['post_id']?>" aria-expanded="false" aria-controls="contentId"><i class="fa fa-comment"></i> Comments</a>
                                <a href="#" class="card-link"><i class="fa fa-mail-forward"></i> Share</a>
                               
                                <!-- comment collapse -->
                                <div class="collapse mt-3" id="contentId_<?php echo $row['post_id'] ?>">
                                   <form action="userAction.php" method="post" class="form-inline">
                                       <div class="input-group w-100">
                                           <input type="hidden" name="post_id" value="<?php echo $row['post_id'] ?>">
                                           <input type="hidden" name="user_id" value="<?php echo $_SESSION['login_id'] ?>">
                                            <input type="text" name="comment" placeholder="Comment" class="form-control">
                                            <div class="input-group-append">
                                                <button type="submit" name="addComment" class="btn btn-primary"><i class="fas fa-comment-medical"></i></button>
                                            </div>
                                       </div>
                                   </form>
                                </div>
                            </div>
                        </div>

                
                
                <?php
                        }
                ?>


                <?php
                    }
                }

                ?>
                <!-- Post /////-->



            </div>
            <div class="col-md-3">
                <div class="card gedf-card">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                            card's content.</p>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
                <div class="card gedf-card">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                            card's content.</p>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>