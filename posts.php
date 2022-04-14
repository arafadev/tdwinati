<?php include('include/connection.php') ;
if(!isset($_SESSION['id'])){
    echo "<div class= 'alert alert-danger'> The page is not found </div>";
    header('refresh:2;URL=login.php');
} else { ?>
<?php include('include/header.php') ?>
    <div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-area">
                <h4 style="font-weight: 700;">لوحه التحكم</h4>
                <ul class="main">
                    <li>
                        <a href="categories.php">
                            <span><i class="fa fa-tags" aria-hidden="true"></i></span>
                            <span><i>التصنيفات</i></span>
                        </a>
                    </li>
                    <!-- Artical -->
                    <li data-toggle="collapse" data-target="#menu">
                        <a href="#">
                            <span><i class="fa fa-plus-circle" aria-hidden="true"></i></span>
                            <span><i>المقالات</i></span>
                        </a>
                    </li>
                    <ul class="collaps" id="menu">
                        <li>
                            <a href="new-post.php">
                                <span><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                                <span>مقال جديد</span>
                            </a>
                        </li>
                        <li>
                            <a href="posts.php">
                                <span><i class="fa fa-align-justify" aria-hidden="true"></i></span>
                                <span>كل المقالات</span>
                            </a>
                        </li>
                    </ul>
                    <li>
                        <a href="index.php" target="_blank">
                            <span><i class="fa fa-firefox" aria-hidden="true"></i></span>
                            <span>عرض الموقع</span>
                        </a>
                    </li>
                    <li>
                        <a href="logout.phps">
                            <span><i class="fa fa-sign-out" aria-hidden="true"></i></span>
                            <span>تسجيل الخروج</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!--End-->

            <!--Start Second part of categories-->
            <div class="col-md-10 first" id="main-area">
                <!--Display all posts-->
                <div class="display-posts mt-4">
                    <?php
                    if (isset($_GET['id'])) {

                        $sql = "DELETE FROM posts WHERE id = '" . $_GET['id'] . "'";
                        if (mysqli_query($conn, $sql)) {
                            echo '<div class="alert alert-danger" role="alert">
                            تمت <strong>حذف</strong> المقال
                            </div>';
                        } else {
                            echo 'mysqli_error($conn)';
                        }
                    }
                    ?>
                    <table class="table table-borderd">
                        <tr style="background: var(--first-color); color:#fff">
                            <th>رقم المقال</th>
                            <th>عنوان المقال</th>
                            <th>كاتب المقال </th>
                            <th>صوره المقال</th>
                            <th>تاريخ المقال</th>
                            <th>محتوي المقال</th>
                            <th>حذف المقال</th>
                        </tr>
                        <?php

                        $query = 'SELECT * FROM posts';
                        $res = mysqli_query($conn, $query);
                        $num_id = 0;
                        while ($row = mysqli_fetch_assoc($res)) {
                            $num_id++;
                        ?>
                            <tr>
                                <td><?php echo $num_id ?></td>
                                <td><?php echo $row['post_title'] ?></td>
                                <td><?php echo $row['post_cat'] ?></td>
                                <td> <img src="upload/<?php echo $row['post_image'] ?>" width="70px" height="50px"></td>
                                <td><?php echo $row['post_date'] ?></td>
                                <td><?php echo $row['post_content'] ?></td>
                                <td>
                                    <a href="posts.php?id=<?php echo $row['id'] ?>">
                                        <button class="btn-custom" style="width: 116px;">حذف المقال</button>
                                    </a>
                                </td>
                            </tr>
                        <?php   } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Include footer ['jquery, bootstrap, fonts,....etc]-->
<?php include('include/footer.php') ?>

<?php } ?>


































<?php include('include/footer.php') ?>