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

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <script src="./js/jquery-3.7.1.min.js"></script>
    
    <style>
        .number-span {
            display: inline-block;
            min-width: 50px; /* ตั้งค่าความกว้างที่เหมาะสมสำหรับตัวเลข */
            text-align: right; /* จัดชิดขวาให้ตัวเลข */
        }
    </style>

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
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="">
                             
                            
                        </div>
                        <h1 class="h3 mb-0 text-gray-800">
                            ทั้งหมด <span id="total" class="text-success">0</span> ตัว <span class="text-secondary">||</span> 
                            สูญเสีย <span id="totalD" class="text-danger">0</span> ตัว
                        </h1>
                        <h1 class="h3 mb-0 text-gray-800"></h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2" id="senghengModal">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <h4>เซ่งเฮงI</h4>
                                            </div>
                                            <i class="fas fa-crow fa-2x text-gray-300"></i>
                                        </div>
                                        <div class="col-auto">
                                            <div class="h5 mb-0 font-weight-bold text-gray-1800" id="">
                                                ไก่ทั้งหมด <span id="senghengT" class="number-span">0</span> ตัว
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-1800" id="">
                                                ไก่สูญเสีย <span id="senghengD" class="number-span">0</span> ตัว 
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-1800" id="">
                                                ไก่คงเหลือ <span id="sengheng" class="number-span">0</span> ตัว
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2" id="sengheng2Modal">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                <h4>เซ่งเฮงII</h4>
                                            </div>
                                            <i class="fas fa-kiwi-bird fa-2x text-gray-300"></i>
                                        </div>
                                        <div class="col-auto">
                                            <div class="h5 mb-0 font-weight-bold text-gray-1800" id="">
                                                ไก่ทั้งหมด <span id="sengheng2T" class="number-span">0</span> ตัว
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-1800" id="">
                                                ไก่สูญเสีย <span id="sengheng2D" class="number-span">0</span> ตัว 
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-1800" id="">
                                                ไก่คงเหลือ <span id="sengheng2" class="number-span">0</span> ตัว
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2" id="salangphanModal">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                <h4>แสลงพัน</h4>
                                            </div>
                                            <i class="fas fa-feather-alt fa-2x text-gray-300"></i>
                                        </div>
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-1800" id="">
                                                ไก่ทั้งหมด <span id="salangphanT" class="number-span">0</span> ตัว
                                            </div>
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-1800" id="">
                                                ไก่สูญเสีย <span id="salangphanD" class="number-span">0</span> ตัว 
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-1800" id="">
                                                ไก่คงเหลือ <span id="salangphan" class="number-span">0</span> ตัว
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2" id="sasiliamModal">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                <h4>สระสี่เหลี่ยม</h4>
                                            </div>
                                            <i class="fas fa-feather fa-2x text-gray-300"></i>
                                        </div>
                                        <div class="col-auto">
                                            <div class="h5 mb-0 font-weight-bold text-gray-1800" id="">
                                                ไก่ทั้งหมด <span id="sasiliamT" class="number-span">0</span> ตัว
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-1800" id="">
                                                ไก่สูญเสีย <span id="sasiliamD" class="number-span">0</span> ตัว 
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-1800" id="">
                                                ไก่คงเหลือ <span id="sasiliam" class="number-span">0</span> ตัว
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-8 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">เปอร์เซ็นการสูญเสียไก่</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">เซ่งเฮง1 <span
                                            class="float-right" id="senghengPer"></span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 0%" id="sh1PB"
                                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">เซ่งเฮง2 <span
                                            class="float-right" id="sengheng2Per"></span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 0%" id="sh2PB"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">แสลงพัน 
                                        <span class="float-right" id="salangphanPer"></span>
                                    </h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 0%" id="slpPB"
                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">สระสี่เหลี่ยม <span
                                            class="float-right" id="sasiliamPer"></span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 0%" id="sslPB"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-4">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">ไก่แต่ละฟาร์ม</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> เซ่งเฮง1
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> เซ่งเฮง2
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> แสลงพัน
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-warning"></i> สระสี่เหลี่ยม
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">การสูญเสียไก่รายเดือน</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
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
                        <span>Copyright &copy; 2024 NCP Group. All rights reserved.</span>
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

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ข้อมูลเล้าไก่</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ตารางแสดงข้อมูล -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>เล้า</th>
                                <th>ตัวเมีย</th>
                                <th>ตัวผู้</th>
                                <th>ตัวเมียสูญเสีย</th>
                                <th>ตัวผู้สูญเสีย</th>
                                <th>คงเหลือ</th>
                            </tr>
                        </thead>
                        <tbody id="farmData">
                            <!-- จะเติมข้อมูลด้วย Ajax -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ออกจากระบบ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">เลือก "ออกจากระบบ" ข้างล่างหากคุณพร้อมที่จะสิ้นสุดเซสชันปัจจุบันของคุณ</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                    <a class="btn btn-primary" href="login.html">ออกจากระบบ</a>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'get_sumCk.php',
                type: 'GET',
                dataType: 'json', 
                success: function(response) {
                    //console.log(response);
                    $.each(response, function(key, value) {
                        let total = Number(response.totalChickens).toLocaleString();
                        let totalD = Number(response.totalLost).toLocaleString();
                        $('#total').html(total);
                        $('#totalD').html(totalD);
                    });
                },
                error: function() {
                    alert('เกิดข้อผิดพลาดในการดึงข้อมูล');
                }
            });
        
            $.ajax({
                url: 'get_sengheng1.php',
                type: 'GET',
                dataType: 'json', 
                success: function(response) {
                    //console.log(response);
                    $.each(response, function(key, value) {
                        let SH1 = Number(response.totalCK).toLocaleString();
                        let totalSH1 = Number(response.difference).toLocaleString();
                        let totalSH1D = Number(response.totalD).toLocaleString();
                        $('#senghengT').html(SH1);
                        $('#sengheng').html(totalSH1);
                        $('#senghengD').html(totalSH1D);

                        const percentage = parseFloat(response.perD).toFixed(2);
                        $('#senghengPer').text(percentage + '%');
                        $('#sh1PB').css('width',percentage + '%');
                    });
                },
                error: function() {
                    alert('เกิดข้อผิดพลาดในการดึงข้อมูล');
                }
            });

            $.ajax({
                url: 'get_sengheng2.php',
                type: 'GET',
                dataType: 'json', 
                success: function(response) {
                    //console.log(response);
                    $.each(response, function(key, value) {
                        let SH2 = Number(response.totalCK).toLocaleString();
                        let totalSH2 = Number(response.difference).toLocaleString();
                        let totalSH2D = Number(response.totalD).toLocaleString();
                        $('#sengheng2T').html(SH2);
                        $('#sengheng2').html(totalSH2);
                        $('#sengheng2D').html(totalSH2D);

                        const percentage = parseFloat(response.perD).toFixed(2);
                        $('#sengheng2Per').text(percentage + '%');
                        $('#sh2PB').css('width',percentage + '%');
                    });
                },
                error: function() {
                    alert('เกิดข้อผิดพลาดในการดึงข้อมูล');
                }
            });

            $.ajax({
                url: 'get_salangphan.php',
                type: 'GET',
                dataType: 'json', 
                success: function(response) {
                    //console.log(response);
                    $.each(response, function(key, value) {
                        let SLP = Number(response.totalCK).toLocaleString();
                        let totalSLP = Number(response.difference).toLocaleString();
                        let totalSLPD = Number(response.totalD).toLocaleString();
                        $('#salangphanT').html(SLP);
                        $('#salangphan').html(totalSLP);
                        $('#salangphanD').html(totalSLPD);

                        const percentage = parseFloat(response.perD).toFixed(2);
                        $('#salangphanPer').text(percentage + '%');
                        $('#slpPB').css('width',percentage + '%');
                    });
                },
                error: function() {
                    alert('เกิดข้อผิดพลาดในการดึงข้อมูล');
                }
            });

            $.ajax({
                url: 'get_sasiliam.php',
                type: 'GET',
                dataType: 'json', 
                success: function(response) {
                    //console.log(response);
                    $.each(response, function(key, value) {
                        let SSL = Number(response.totalCK).toLocaleString();
                        let totalSSL = Number(response.difference).toLocaleString();
                        let totalSSLD = Number(response.totalD).toLocaleString();
                        $('#sasiliamT').html(SSL);
                        $('#sasiliam').html(totalSSL);
                        $('#sasiliamD').html(totalSSLD);

                        const percentage = parseFloat(response.perD).toFixed(2);
                        $('#sasiliamPer').text(percentage + '%');
                        $('#sslPB').css('width',percentage + '%');
                    });
                },
                error: function() {
                    alert('เกิดข้อผิดพลาดในการดึงข้อมูล');
                }
            });
        });

         // เรียกข้อมูลจาก PHP
         $.ajax({
            url: 'get_pieChart.php', // เปลี่ยนเป็นชื่อไฟล์ PHP ของคุณ
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                var dataValues = [];
                var labels = [];

                // สมมติว่า response มีโครงสร้างเป็น array ของ object
                response.forEach(function(item) {
                    dataValues.push(item.totalCK); // ใช้ข้อมูลที่คุณต้องการ
                    labels.push(item.FarmName); // ชื่อฟาร์ม
                });

                //console.log("Data Values: ", dataValues); // ตรวจสอบ data values
                //console.log("Labels: ", labels); // ตรวจสอบ labels

                // สร้าง Pie Chart
                var ctx = document.getElementById("myPieChart");
                var myPieChart = new Chart(ctx, {
                    type: 'doughnut', // หรือ 'pie'
                    data: {
                        labels: labels,
                        datasets: [{
                            data: dataValues.map(Number),
                            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
                            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#f6b232'],
                            hoverBorderColor: "rgba(234, 236, 244, 1)",
                        }],
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips: {
                            enabled: true,
                            callbacks: {
                                label: function(tooltipItem, data) {
                                    var label = data.labels[tooltipItem.index]; // ใช้ index เพื่อเข้าถึง label
                                    var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index]; // ใช้ datasetIndex เพื่อเข้าถึง value

                                    let percentage = ((value / data.datasets[tooltipItem.datasetIndex].data.reduce((a, b) => a + b, 0)) * 100).toFixed(2);
                                    return 'ฟาร์ม'+label + ': ' + value + ' (' + percentage + '%)';
                                }
                            },
                            backgroundColor: "rgb(255,255,255)",
                            bodyFontColor: "#858796",
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            xPadding: 15,
                            yPadding: 15,
                            displayColors: false,
                            caretPadding: 10,
                        },
                        legend: {
                            display: false // แสดง legend
                        },
                        cutoutPercentage: 80, // สำหรับ doughnut
                    },
                });
            },
            error: function(xhr, status, error) {
                console.error("Error fetching data: ", error);
            }
        });

        $.ajax({
            url: 'get_lineChart.php',  // URL ของไฟล์ PHP
            type: 'GET',
            dataType: 'json',
            success: function(jsonData) {
                var ctx = document.getElementById("myAreaChart").getContext('2d');
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: jsonData.labels,  // ชื่อเดือน
                        datasets: [{
                            label: "Chicken Mortality",
                            lineTension: 0.3,
                            backgroundColor: "rgba(255, 99, 132, 0.05)",
                            borderColor: "rgba(255, 99, 132, 1)",
                            pointRadius: 3,
                            pointBackgroundColor: "rgba(255, 99, 132, 1)",
                            pointBorderColor: "rgba(255, 99, 132, 1)",
                            pointHoverRadius: 3,
                            pointHoverBackgroundColor: "rgba(255, 99, 132, 1)",
                            pointHoverBorderColor: "rgba(255, 99, 132, 1)",
                            pointHitRadius: 10,
                            pointBorderWidth: 2,
                            data: jsonData.mortality  // ข้อมูลการตายของไก่
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    callback: function(value) {
                                        return value;  // แสดงตัวเลขการตาย
                                    }
                                }
                            }]
                        },
                        tooltips: {
                            callbacks: {
                                label: function(tooltipItem, chart) {
                                    return chart.datasets[tooltipItem.datasetIndex].label + ': ' + tooltipItem.raw;
                                }
                            }
                        }
                    }
                });
            },
            error: function(err) {
                console.error("Error loading data", err);
            }
        });

        document.getElementById("senghengModal").addEventListener("click", function() {
            
            // เปิด Modal
            $('#myModal').modal('show');

            // กำหนดพารามิเตอร์ที่จะส่งไป (ตัวอย่าง: farmID)
            var farmID = 'f-001';

            // ดึงข้อมูลจากเซิร์ฟเวอร์ด้วย Ajax
            $.ajax({
                url: 'get_detail_dashboard.php', // เปลี่ยนเป็นชื่อไฟล์ PHP ที่ใช้ดึงข้อมูล
                method: 'POST',
                dataType: 'json',
                data: {farmId: farmID},
                success: function(response) {
                    // เคลียร์ข้อมูลในตารางก่อน
                    $('#farmData').empty();

                    // เพิ่มข้อมูลแต่ละแถวในตาราง
                    response.forEach(function(item) {
                        var row = `
                            <tr>
                                <td>${item.CoopName}</td>
                                <td>${Number(item.ChickenF).toLocaleString()}</td>
                                <td>${Number(item.ChickenM).toLocaleString()}</td>
                                <td>${Number(item.DeadF).toLocaleString()}</td>
                                <td>${Number(item.DeadM).toLocaleString()}</td>
                                <td>${(Number(item.ChickenF) - Number(item.DeadF)).toLocaleString()}</td> <!-- แปลง ChickenF และ DeadF เป็นตัวเลขและจัดรูปแบบคอมม่า -->
                            </tr>
                        `;
                        $('#farmData').append(row);
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching data: ", error);
                }
            });
        });

        document.getElementById("sengheng2Modal").addEventListener("click", function() {
            
            // เปิด Modal
            $('#myModal').modal('show');

            // กำหนดพารามิเตอร์ที่จะส่งไป (ตัวอย่าง: farmID)
            var farmID = 'f-002';

            // ดึงข้อมูลจากเซิร์ฟเวอร์ด้วย Ajax
            $.ajax({
                url: 'get_detail_dashboard.php', // เปลี่ยนเป็นชื่อไฟล์ PHP ที่ใช้ดึงข้อมูล
                method: 'POST',
                dataType: 'json',
                data: {farmId: farmID},
                success: function(response) {
                    // เคลียร์ข้อมูลในตารางก่อน
                    $('#farmData').empty();

                    // เพิ่มข้อมูลแต่ละแถวในตาราง
                    response.forEach(function(item) {
                        var row = `
                            <tr>
                                <td>${item.CoopName}</td>
                                <td>${Number(item.ChickenF).toLocaleString()}</td>
                                <td>${Number(item.ChickenM).toLocaleString()}</td>
                                <td>${Number(item.DeadF).toLocaleString()}</td>
                                <td>${Number(item.DeadM).toLocaleString()}</td>
                                <td>${(Number(item.ChickenF) - Number(item.DeadF)).toLocaleString()}</td> <!-- แปลง ChickenF และ DeadF เป็นตัวเลขก่อนทำการลบ -->
                            </tr>
                        `;
                        $('#farmData').append(row);
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching data: ", error);
                }
            });
        });
        
        document.getElementById("salangphanModal").addEventListener("click", function() {
            
            // เปิด Modal
            $('#myModal').modal('show');

            // กำหนดพารามิเตอร์ที่จะส่งไป (ตัวอย่าง: farmID)
            var farmID = 'f-003';

            // ดึงข้อมูลจากเซิร์ฟเวอร์ด้วย Ajax
            $.ajax({
                url: 'get_detail_dashboard.php', // เปลี่ยนเป็นชื่อไฟล์ PHP ที่ใช้ดึงข้อมูล
                method: 'POST',
                dataType: 'json',
                data: {farmId: farmID},
                success: function(response) {
                    // เคลียร์ข้อมูลในตารางก่อน
                    $('#farmData').empty();

                    // เพิ่มข้อมูลแต่ละแถวในตาราง
                    response.forEach(function(item) {
                        var row = `
                            <tr>
                                <td>${item.CoopName}</td>
                                <td>${Number(item.ChickenF).toLocaleString()}</td>
                                <td>${Number(item.ChickenM).toLocaleString()}</td>
                                <td>${Number(item.DeadF).toLocaleString()}</td>
                                <td>${Number(item.DeadM).toLocaleString()}</td>
                                <td>${(Number(item.ChickenF) - Number(item.DeadF)).toLocaleString()}</td> <!-- แปลง ChickenF และ DeadF เป็นตัวเลขก่อนทำการลบ -->
                            </tr>
                        `;
                        $('#farmData').append(row);
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching data: ", error);
                }
            });
        });
        
        document.getElementById("sasiliamModal").addEventListener("click", function() {
            
            // เปิด Modal
            $('#myModal').modal('show');

            // กำหนดพารามิเตอร์ที่จะส่งไป (ตัวอย่าง: farmID)
            var farmID = 'f-004';

            // ดึงข้อมูลจากเซิร์ฟเวอร์ด้วย Ajax
            $.ajax({
                url: 'get_detail_dashboard.php', // เปลี่ยนเป็นชื่อไฟล์ PHP ที่ใช้ดึงข้อมูล
                method: 'POST',
                dataType: 'json',
                data: {farmId: farmID},
                success: function(response) {
                    // เคลียร์ข้อมูลในตารางก่อน
                    $('#farmData').empty();

                    // เพิ่มข้อมูลแต่ละแถวในตาราง
                    response.forEach(function(item) {
                        var row = `
                            <tr>
                                <td>${item.CoopName}</td>
                                <td>${Number(item.ChickenF).toLocaleString()}</td>
                                <td>${Number(item.ChickenM).toLocaleString()}</td>
                                <td>${Number(item.DeadF).toLocaleString()}</td>
                                <td>${Number(item.DeadM).toLocaleString()}</td>
                                <td>${(Number(item.ChickenF) - Number(item.DeadF)).toLocaleString()}</td> <!-- แปลง ChickenF และ DeadF เป็นตัวเลขก่อนทำการลบ -->
                            </tr>
                        `;
                        $('#farmData').append(row);
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching data: ", error);
                }
            });
        });
        
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>