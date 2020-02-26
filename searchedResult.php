<?php
include 'userAction.php';
$result =  $_SESSION['searched_user'];

$currentUserID = $_SESSION['login_id'];
$currentUser = $UserClass->getOneUser($currentUserID);

$searchedUser = $UserClass->searchUser($result);
// print_r($relationship);

// print_r($searchedUser);
if ($searchedUser != FALSE) {
?>
    <!doctype html>
    <html lang="en">

    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://kit.fontawesome.com/eb83b1af77.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="css/searchedResult.css">
        <!-- Bootstrap CSS -->
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>

    <body>

        <div class="container-fluid">
            <div class="col-lg-3">
            <div class="card mt-5">
                    <div class="card-body">
                        <div class="h5">@<?php echo $currentUser['user_email'] ?></div>
                        <div class="h7 text-muted">Fullname : <?php echo $currentUser['user_fullname'] ?></div>
                        <div class="h7">Developer of web applications, JavaScript, PHP, Java, Python, Ruby, Java, Node.js,
                            etc.
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="homepage.php" class="btn btn-outline-info btn-block btn-lg" role="button">Homepage</a>
                        </li>
                       
                        <li class="list-group-item">
                            <a href="logout.php" class="btn btn-outline-secondary btn-block" role="button">Logout</a>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="col-lg-9">
            <hgroup class="mb20 mt-5">
                <h1>Search Results</h1>
                <h2 class="lead"><strong class="text-danger"><?php echo count($searchedUser) ?></strong> results were found for the search for <strong class="text-danger">Lorem</strong></h2>
            </hgroup>
            <?php
            foreach ($searchedUser as $row) :
                $randomID = $row['user_id'];
                $userImg = $row['user_img'];
                if ($_SESSION['login_id'] != $randomID) {
            ?>


                    <section class="col-xs-12 col-sm-6 col-md-12 mt-3">
                        <article class="search-result row">
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <?php
                                if (!empty($userImg)) {
                                ?>
                                    <a href="#" title="Lorem ipsum" class="thumbnail"><img src="uploads/<?php echo $userImg ?>" alt="Lorem ipsum" /></a>
                                <?php
                                } else {
                                ?>
                                <a href="#" title="Lorem ipsum" class="thumbnail"><img src="uploads/default.png" alt="Lorem ipsum" /></a>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-2">
                                <ul class="meta-search">
                                    <li><i class="glyphicon glyphicon-calendar"></i> <span>02/15/2014</span></li>
                                    <li><i class="glyphicon glyphicon-time"></i> <span>4:28 pm</span></li>
                                    <li><i class="glyphicon glyphicon-tags"></i> <span>People</span></li>
                                </ul>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-7 excerpet">
                                <h3><a href="#" title="">Voluptatem, exercitationem, suscipit, distinctio</a></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, exercitationem, suscipit, distinctio, qui sapiente aspernatur molestiae non corporis magni sit sequi iusto debitis delectus doloremque.</p>
                                <?php 
                                $rs = $UserClass->validateUserRelationship($_SESSION['login_id'],$randomID);
                                if($rs == 'follow'){
                                    ?>
                                    <div class="follow-button p-2">
                                        <form action="userAction.php" method="post">
                                            <input type="hidden" value="<?php echo $row['user_id'] ?>" name="followed_user_id">
                                            <input type="hidden" value="<?php echo $_SESSION['login_id'] ?>" name="user_id">
                                            <button type="submit" name="follow_user" class="btn btn-outline-info float-right">
                                            <i class="fas fa-user-plus"></i>
                                            </button>
                                        </form>
                                    </div>
                             

                                    <?php
                                }else{
                                    ?>
                                    <div class="follow-button p-2">
                                        <form action="userAction.php" method="post">
                                            <input type="hidden" value="<?php echo $row['user_id'] ?>" name="followed_user_id">
                                            <input type="hidden" value="<?php echo $_SESSION['login_id'] ?>" name="user_id">
                                            <button type="submit" name="unfollow" class="btn btn-outline-info float-right">
                                            <i class="fas fa-user-minus"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <?php
                                }
                                ?>
                            </div>
                            <span class="clearfix borda"></span>
                        </article>

                    </section>






            <?php
                }
            endforeach;

            ?>
            </div>
          
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>

    </html>
<?php } else {
} ?>