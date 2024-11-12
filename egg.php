<?php
    session_start();

    if(!isset($_SESSION['username'])){
        header("location:login.html");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Farm System</title>

    <link rel="icon" sizes="32x32" type="image/x-icon" href="./img/icons/favicon.ico">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="./js/jquery-3.7.1.min.js"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php
            require_once 'sidebar.php';
        ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                            alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['username']; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">บันทึกข้อมูลไก่ตาย/คัดทิ้ง</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                    
                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-7">
                            <div class="card shadow mb-4">
                                
                                <!-- Card Body -->
                                <div class="card-body">
                                    <form id="form">
                                        <div class="row">
                                            <div class="col-sm-4 mt-3">
                                                <label for="farmDropdown">ฟาร์ม</label>
                                                <select class="form-select" id="farmDropdown" name="farmDropdown">
                                                    <option value="">เลือกฟาร์ม</option>
                                                </select> 
                                            </div>
                                            <div class="col-sm-4 mt-3">
                                                <label for="coopDropdown">เล้าที่</label>
                                                <select class="form-select" id="coopDropdown" name="coopDropdown">
                                                <option value="">เลือกเล้า</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4 mt-3">
                                                <label for="inputDate">วันที่</label>
                                                <input type="date" class="form-control" id="inputDate" placeholder="" name="inputDate">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-2 mt-5">
                                                <label for="ErLarge">จำนวนไข่ยักษ์</label>
                                                <input type="text" class="form-control" id="ErLarge" placeholder="" name="ErLarge">
                                            </div>
                                            <div class="col-sm-2 mt-5">
                                                <label for="ErSmall">จำนวนไข่เล็ก</label>
                                                <input type="text" class="form-control" id="ErSmall" placeholder="" name="ErSmall"> 
                                            </div>
                                            <div class="col-sm-2 mt-5">
                                                <label for="ErDeformed">จำนวนไข่ผิดรูป</label>
                                                <input type="text" class="form-control" id="ErDeformed" placeholder="" name="ErDeformed">
                                            </div>
                                            <div class="col-sm-2 mt-5">
                                                <label for="ErDirty">จำนวนไข่สกปรก</label>
                                                <input type="text" class="form-control" id="ErDirty" placeholder="" name="ErDirty">
                                            </div>
                                            <div class="col-sm-2 mt-5">
                                                <label for="ErCrack">จำนวนไข่บุบร้าว</label>
                                                <input type="text" class="form-control" id="ErCrack" placeholder="" name="ErCrack">
                                            </div>
                                            <div class="col-sm-2 mt-5">
                                                <label for="ErWrack">จำนวนไข่เสียหาย</label>
                                                <input type="text" class="form-control" id="ErWrack" placeholder="" name="ErWrack">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-2 mt-3">
                                                <label for="sum">จำนวนไข่ทั้งหมด</label>
                                                <input type="text" class="form-control" id="sum" placeholder="" name="sum" readonly> 
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 mt-5 ml-3">
                                                <button type="submit" class="btn btn-primary">บันทึก</button>
                                                <button class="btn btn-danger" onclick="clearText()">ยกเลิก</button>
                                            </div>
                                            
                                        </div>
                                        
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#form').on('submit', function(event) {
                event.preventDefault(); // ป้องกันการรีเฟรชหน้า

                var formData = {
                    farm: $('#farmDropdown').val(),
                    coop: $('#coopDropdown').val(),
                    inputDate: $('#inputDate').val(),
                    ErLarge: $('#ErLarge').val(),
                    ErSmall: $('#ErSmall').val(),
                    ErDeformed: $('#ErDeformed').val(),
                    ErDirty: $('#ErDirty').val(),
                    ErCrack: $('#ErCrack').val(),
                    ErWrack: $('#ErWrack').val()
                };

                $.ajax({
                    url: 'save_sort.php', // URL ของไฟล์ PHP
                    type: 'POST',
                    data: formData,
                    success: function(response) {

                        $('input[type="text"]').val(''); // เคลียร์ textbox ทั้งหมด
                        $('select').prop('selectedIndex', 0); // รีเซ็ต dropdown ทั้งหมดกลับเป็นค่าแรก
                        $('input[type="date"]').val('');
                        
                        // แสดงข้อความสำเร็จเมื่อการบันทึกข้อมูลเสร็จสิ้น
                        Swal.fire({
                            icon: 'success',
                            title: 'บันทึกสำเร็จ!',
                            text: response
                        });
                    },
                    error: function() {
                        // แสดงข้อความเมื่อเกิดข้อผิดพลาด
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด!',
                            text: 'ไม่สามารถบันทึกข้อมูลได้'
                        });
                    }
                });
            });
        });

        $(document).ready(function() {
            // ทำการเรียกข้อมูลหมวดหมู่ผ่าน AJAX
            $.ajax({
                url: 'get_farm.php', // ไฟล์ PHP ที่ดึงข้อมูลจากฐานข้อมูล
                type: 'GET',
                dataType: 'json', // คาดหวังข้อมูลในรูปแบบ JSON
                success: function(response) {
                    //console.log(response);
                    // ลูปข้อมูลที่ได้จาก AJAX เพื่อเพิ่มลงใน dropdown
                    $.each(response, function(key, value) {
                        $('#farmDropdown').append('<option value="' + value.FarmID + '">' + value.FarmName + '</option>');
                    });
                },
                error: function() {
                    alert('เกิดข้อผิดพลาดในการดึงข้อมูล');
                }
            });
        });

        $(document).ready(function() {
            // ทำการเรียกข้อมูลหมวดหมู่ผ่าน AJAX
            $.ajax({
                url: 'get_coop.php', // ไฟล์ PHP ที่ดึงข้อมูลจากฐานข้อมูล
                type: 'GET',
                dataType: 'json', // คาดหวังข้อมูลในรูปแบบ JSON
                success: function(response) {
                    //console.log(response);
                    // ลูปข้อมูลที่ได้จาก AJAX เพื่อเพิ่มลงใน dropdown
                    $.each(response, function(key, value) {
                        $('#coopDropdown').append('<option value="' + value.CoopID + '">' + value.CoopName + '</option>');
                    });
                },
                error: function() {
                    alert('เกิดข้อผิดพลาดในการดึงข้อมูล');
                }
            });
        });

        $(document).ready(function() {
            // ฟังก์ชันคำนวณผลลัพธ์
            function calculateSum() {
                // ดึงค่าจาก textbox number1 และ number2
                var num1 = parseFloat($('#ErLarge').val()) || 0; // ถ้าไม่มีค่าให้เป็น 0
                var num2 = parseFloat($('#ErSmall').val()) || 0;
                var num3 = parseFloat($('#ErDeformed').val()) || 0;
                var num4 = parseFloat($('#ErDirty').val()) || 0;
                var num5 = parseFloat($('#ErCrack').val()) || 0;
                var num6 = parseFloat($('#ErWrack').val()) || 0;

                // คำนวณผลลัพธ์
                var sum = num1 + num2 + num3 + num4 + num5 + num6;

                // แสดงผลลัพธ์ใน textbox sum
                $('#sum').val(sum);
            }

            // ตรวจจับการเปลี่ยนแปลงใน textbox number1 และ number2
            $('#ErLarge, #ErSmall, #ErDeformed, #ErDirty, #ErCrack, #ErWrack').on('input', function() {
                calculateSum();
            });
        });

        function clearText(){
            event.preventDefault();
            $('input[type="text"]').val('');
            $('select').prop('selectedIndex', 0);
            $('input[type="date"]').val('');
        }

    </script>

    
    <script src="js/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="css/sweetalert2.min.css">

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

   

</body>

</html>