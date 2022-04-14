<?php include('include/connection.php') ?>
<?php include('include/header.php') ?>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $pTitle = $_POST['title'];
    $pCat   = $_POST['category'];   
    $pAuther = 'عبدالله محمد ';
    $pContent = $_POST['content'];  
    $pAdd = $_POST['add'];
    // Image
    $image_name = $_FILES['post_image']['name'];
    $img_tmp = $_FILES['post_image']['tmp_name'];

}
?>
<!-- Start Content-->
<?php
if (!isset($_SESSION['id'])) {
    echo "<div class= 'alert alert-danger'>  غير مسموح لك فتح هذه الصفحه </div>";
    header('refresh:2;URL=login.php');
}
else{ ?>
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
                        <a href="logout.php">
                            <span><i class="fa fa-sign-out" aria-hidden="true"></i></span>
                            <span>تسجيل الخروج</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!--End-->

            <!--Add New Artical-->
            <div class="col-md-10" id="main-area">
                <button class="btn-custom first">مقال جديد</button>
                <div class="add-categories">
                    <?php
                    if (isset($pAdd)) {
                        if (empty($pTitle) || empty($pCat) || empty($pContent)) {
                            echo '<div class="alert alert-danger" role="alert">
                                يجب ملأ الحقول جميعها 
                            </div>';
                        } elseif (strlen($pContent) > 100000) {
                            echo '<div class="alert alert-danger" role="alert">
                                يجب ألا يزيد المحتوي عن 1000 حرف
                            </div>';
                        } else {

                            $post_image_name = rand(0, 100000) . '_' . $image_name;

                            move_uploaded_file($img_tmp, 'upload/' . $post_image_name);

                            $sql = "INSERT INTO posts(post_title, post_cat, post_image, post_content, post_author)
                                                VALUES('$pTitle','$pCat','$post_image_name','$pContent','$pAuther')";


                            if (mysqli_query($conn, $sql)) {

                                echo '<div class="alert alert-success" role="alert">
                                    تم اضافه المنشور بنجاح
                                </div>';
                            } else {
                                echo '<div class="alert alert-danger" role="alert">
                                    لم يتم اضافه المنشور 
                                </div>';
                            }
                        }
                    }
                    ?>
                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method='POST' enctype="multipart/form-data">
                        <div class="form-group">
                            <label style="font-weight: 700;">عنوان المقاله</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="caty" style="font-weight: 700;">التصنيف</label>
                            <select name="category" id="caty" class="form-control">

                                <?php
                                $query = 'SELECT * FROM categories';
                                $res = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_assoc($res)) {
                                ?>
                                    <option value="<?php echo $row['category_name'] ?>">
                                        <?php echo $row['category_name'] ?>
                                    </option>

                                <?php   }  ?>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="image">صوره المقال</label>
                            <input type="file" id="image" class="form-control" name="post_image">
                        </div>
                        <div class="form-group">
                            <label for="content" id="">نص المقال</label>
                            <textarea cols="30" rows="10" class="form-control" name="content"></textarea>
                        </div>
                        <button class="btn-custom" name="add">نشر المقاله</button>
                    </form>
                </div>
            </div>
            <!--End New Artical-->
        </div>

    </div>
</div>
<?php
 include('include/footer.php');
    }   ?>