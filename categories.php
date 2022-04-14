<?php
include('include/connection.php');
?>

<?php
if (!isset($_SESSION['id'])) {
    echo "<div class= 'alert alert-danger'> The page is not found </div>";
    header('refresh:2;URL=login.php');
} else {
 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $cName = $_POST['category'];    
        $cAdd  = $_POST['add'];          
    }
?>
<?php include('include/header.php') ?>
    <!-- Start Content-->
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

                <!--Start Second part of categories-->
                <div class="col-md-10 first" id="main-area">
                    <div class="add-categories">
                        <?php
                        if (isset($cAdd)) {
                            if (empty($cName)) {
                                echo '<div class="alert alert-danger" role="alert">
                                        حقل التصنيف فارغ
                                        </div>';      
                            } elseif (strlen($cName) > 100) {
                                echo '<div class="alert alert-danger" role="alert">
                                        حقل التصنيف كبير جدا
                                        </div>';        
                            } else {
                           
                                $sql = "INSERT INTO categories(category_name) VALUES ('$cName')";
                                if (mysqli_query($conn, $sql)) {
                                    echo '<div class="alert alert-success" role="alert">
                                            تمت إضافة التصنيف
                                            </div>';
                                } else {
                                    echo '<div class="alert alert-danger" role="alert">
                                            "Error: " . $sql . " " . mysqli_error($conn)
                                            </div>';
                                }
                            }
                        }

                        ?>
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">

                            <div class="form-group">
                                <label for="category" style="margin-top:10px;">تصنيف جديد</label>

                                <input type="text" name="category" class="form-control">
                            </div>
                            <button class="btn-custom" name="add">اضافه</button>
                        </form>
                    </div>

                    <!-- Display Categories -->
                    <div class="display-cat mt-5">
                        <!--Delete Row From table-->
                        <?php
                        if (isset($_GET['id'])) {
                            $sql = "DELETE FROM categories WHERE id = '" . $_GET['id'] . "'";
                            if (!mysqli_query($conn, $sql)) {
                                echo mysqli_error($conn);
                            }
                        }
                        ?>
                        <table class="table table-borderd">
                            <tr style="background: var(--first-color); color:#fff">
                                <th>رقم الفئه</th>
                                <th>اسم الفئه</th>
                                <th>تاريخ الاضافه</th>
                                <th>حذف التصنيف </th>
                            </tr>

                            <?php
                            $query = 'SELECT * FROM categories';

                            $res = mysqli_query($conn, $query);

                            $num_id = 0;

                            while ($row = mysqli_fetch_assoc($res)) {
                                $num_id++;
                            ?>
                                <tr>

                                    <td><?php echo $num_id ?></td>
                                    <td><?php echo $row['category_name'] ?></td>
                                    <td><?php echo $row['category_date'] ?></td>
                                    <td>

                                        <a href="categories.php?id=<?php echo $row["id"]; ?>">
                                            <button class="btn-custom" style="width: 116px;">حذف التصنيف</button>
                                        </a>

                                    </td>

                                </tr>


                            <?php } ?>
                        </table>
                    </div>
                </div>
                <!--End second part of categories-->



                <!--Include footer ['jquery, bootstrap, fonts,....etc]-->
                <?php include('include/footer.php') ?>

            </div>
        </div>
    </div>
<?php } ?>