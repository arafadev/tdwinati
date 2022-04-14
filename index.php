<?php include('include/connection.php'); ?>
<!--Start Content-->    
<?php
if (! isset($_SESSION['id'])) {
    echo "<div class= 'alert alert-danger'> The page is not found </div>";
    header('refresh:2;URL=login.php');
} else {
    include('public/header.php');
?>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <?php
                    $query = 'SELECT * FROM posts ORDER BY id DESC';
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <div class="post">
                            <div class="post-image">
                                <a href="post.php?id=<?php echo $row['id']; ?>"><img src="upload/<?php echo $row['post_image'] ?>"></a>
                            </div>
                            <div class="post-title">
                                <h5 style="font-weight:bold;)"><a href="post.php?id=<?php echo $row['id']; ?>" style="color:var(--first-color);"><?php echo $row['post_title'] ?></a></h5>
                            </div>
                            <div class="post-details">
                                <p class="post-info">
                                    <span> <i class="fa fa-user" aria-hidden="true"></i><?php echo $row['post_author'] ?></span>
                                    <span> <i class="fa fa-calendar-minus-o" aria-hidden="true"></i> <?php echo $row['post_date'] ?> </span>
                                    <span> <i class="fa fa-tags" aria-hidden="true"></i> <?php echo $row['post_cat'] ?> </span>
                                </p>
                            </div>
                            <div class="post-details">
                                <p class="postContent">
                                    <?php
                                    if (strlen($row['post_content']) > 150) {
                                        $row['post_content'] = substr($row['post_content'], 0,  300) . '...';
                                        echo $row['post_content'];
                                    } else {

                                        echo $row['post_content'];
                                    }
                                    ?>
                                </p>
                                <a href="post.php?id=<?php echo $row['id']; ?>"><button class="btn btn-custom">اقرأ المزيد</button></a>
                            </div>
                        </div>
                    <?php } ?>


                </div>
                <div class="col-md-3">
                    <!--Catagories-->
                    <div class="categeries">
                        <h4 style="font-weight: 700;">التصنيفات</h4>
                        <ul>
                            <?php
                            $query = 'SELECT * FROM categories ORDER BY id DESC';
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <li>
                                    <a href="category.php?category=<?php echo $row['category_name'] ?>">
                                        <span><i class="fa fa-tags" aria-hidden="true"></i></span>
                                        <span><?php echo $row['category_name'] ?></span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>

                    <!--End categories-->

                    <!--Start Latest Posts-->
                    <div class="last-posts">
                        <h4 style="font-weight: 700;">أحدث المنشورات </h4>
                        <ul>
                            <?php
                            $query = 'SELECT * FROM posts ORDER BY id DESC LIMIT 3';
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <li>
                                    <a href="post.php?id=<?php echo $row['id'] ?>">
                                        <span class="span-img"><img src="upload/<?php echo $row['post_image'] ?>" alt="img 2"></span>
                                        <span><?php echo $row['post_title']; ?> </span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!--End Latest Posts-->
                </div>
            </div>
        </div>
    </div>
<?php
    include('public/footer.php');
} ?>
<!--End Content-->

<?php
?>