<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto mt-5">
                <div class="card">
                    <form action="" method="POST">
                        <div class="card-header text-center">
                            Register
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="username" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="username" name="lusername" value="sdklfjksdajfkld">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">Lastname</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="password" name="lpassword">
                                </div>
                            </div>
                        </div>
                        <div>
                            <select name="sex" require>
                            <option value="">เลือกเพศ</option>
                                <option value="หญิง">ชาย</option>
                                <option value="ชาย">หญิง</option>
                            </select>
                        </div>
                        <div class="card-footer text-center">
                            <input type="submit" name="register" class="btn btn-success" value="Register">
                        </div>
                </div>
            </div>
        </div>
        </form>

        <?php
        include('connect.php');

        if (isset($_POST['register'])) { // ตรวจสอบการกดปุ่ม register
            if (!empty($_POST['lusername']) && !empty($_POST['lpassword'])) { // ตรวจสอบว่า usernaem กับ password ว่างไหม
                $check = 0;
                $username = $_POST['lusername'];
                $password = $_POST['lpassword'];
                $sex = $_POST['sex'];

                $query = "SELECT * FROM merber2";  //!!!อย่าลืมเปลี่ยน ชื่อตาราง
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_array($result)) {  // loop นำข้อมูลมาเช็ค ว่าชื่อที่กรอก กับ ใน database ตรงกันไหม
                    if ($row['name'] == $username) {
                        $check = 1;
                        break;
                    }
                }

                if ($check == 1) {  //ในกรณีที่มีซ้ำ 
                    echo '<script type="text/javascript">
                    swal("Fail", "ก็บอกว่าซ้ำไปสัส!!!!!", "warning");
                    </script>';
                } else {  // ถ้าชื่อไม่ซ้ำ
                    $sql = "INSERT INTO `merber2` (`id`, `name`, `lastname`) VALUES (NULL, '$username', '$password')";  // อย่าลืมเปลี่ยชื่อ db เพื่มข้อมูลที่ต้องการเก็บใน database ตรงนี้

                    $result = mysqli_query($conn, $sql);

                    if ($result) { //ถ้าบันทึกสำเร็จ
                        echo "<script type='text/javascript'>";
                        echo "window.location = 'login.php'; ";
                        echo "console.log('hello')";
                        echo "</script>";
                    } else { //ถ้าบันทึกไม่สำเร็จ
                        echo '<script type="text/javascript">
                    swal("Fail", "บันทึกข้อมูลไม่สำเร็จ", "error");
                    </script>';
                    }
                }
                $check = 0;
            } else { // ถ้าข้อมูลไม่ว่าง
                echo '<script type="text/javascript">
                    swal("Warning", "กรุณาใส่ข้อมูล!", "warning");
                    </script>';
            }
        }
        ?>

        <script src="node_modules/jquery/dist/jquery.min.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
</body>

</html>