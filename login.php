<?php
include('include/connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> تسجيل الدخول</title>
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Cairo:wght@200;300;400;500;700&family=Tajawal:wght@200;300;400&display=swap" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-rtl.css">
    <!-- Css Files-->
    <link rel="stylesheet" href="css/dashboard.css">
    <!--Font Awesome-->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <style>
        .login {
            width: 300px;
            margin: 80px auto;
        }

        .login h4 {
            color: #000;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 700;
        }

        .login button {
            margin-right: 80px;
        }
    </style>

</head>

<body>

    <div class="login">
        <?php
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $adminMail = $_POST['email'];
            $adminPass = $_POST['password'];
            $login = $_POST['login'];

            if (isset($login)) {
                if (empty($adminMail) || empty($adminPass)) {
                    echo "<div class='alert alert-danger'>الرجاء ادخال البريد الالكتروني وكلمه السر</div>";
                } else {

                    $sql = "SELECT * FROM admin WHERE email = '$adminMail' AND password = '$adminPass'";

                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);

                    $rowcount = mysqli_num_rows($result);

                    if ($rowcount == 0) {
                        echo "<div class=' alert alert-danger'> الحقول غير متطابقه </div>";
                    } else {
                        echo "<div class='alert alert-success'>مرحبا سيتم تحويلك الي لوحه التحكم ..... </div>";
                        $_SESSION['id'] = $row['id'];
                        header("REFRESH:2;URL=categories.php");
                    }
                }
            }
        }
        ?>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <h4>تسجيل الدخول</h4>
            <div class="form_group">
                <label for="mail">البريد الالكتروني </label>
                <input type="text" name="email" class="form-control" id="mail" />

            </div>
            <div class="form_group" style="margin-bottom:10px ;">
                <label for="pass">الرقم السري </label>
                <input type="password" name="password" class="form-control" id="pass" />
            </div>
            <button name="login" class=".btn-custom" style="background:var(--first-color); color:#fff;border:1px solid var(--first-color); padding: 5px 10px">تسجيل دخول</button>

        </form>

    </div>









    <!-- Jquery-->
    <script src="js/jquery-3.6.0.min.js"></script>
    <!--Font Awesome-->
    <!--Bootstrap-->
    <script src="js/bootstrap.min.js"></script>


</body>

</html>