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
    
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    
    <script src="./js/jquery-3.7.1.min.js"></script>

    <style>
        .btn-sd:hover{
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
        }

        .action-buttons {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
        }

        .action-buttons button {
            margin: 0 5px; /* กำหนดระยะห่างระหว่างปุ่ม */
        }

        th {
            text-align: center;
        }

        th.five-col {
            width: 5%;
        }

        th.ten-col {
            width: 10%;
        }

        th.fivteen-col {
            width: 15%;
        }

        th.twenty-col {
            width: 20%; /* คอลัมน์ Actions */
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
                        <h1 class="h3 mb-0 text-gray-800">บันทึกข้อมูลไก่ลงเล้า</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" id="addBtn">
                            <i class="fas fa-plus fa-sm text-white-50"></i> เพิ่มข้อมูล
                        </a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-7">
                            <div class="card shadow mb-4">
                                
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="chickenTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th class="five-col">รหัสไก่</th>
                                                    <th class="ten-col">ฟาร์ม</th>
                                                    <th class="ten-col">เล้า</th>
                                                    <th class="ten-c0l">อายุไก่(สัปดาห์)</th>
                                                    <th class="ten-c0l">อายุไก่(วัน)</th>
                                                    <th class="ten-col">พันธุ์ไก่</th>
                                                    <th class="ten-col">จำนวนตัวเมีย</th>
                                                    <th class="ten-col">จำนวนตัวผู้</th>
                                                    <th class="ten-col">สถานะ</th>
                                                    <th class="ten-col">วันที่ลงเล้า</th>
                                                    <th class="ten-col">ดำเนินการ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
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

    <!-- Modal สำหรับเพิ่มข้อมูล -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">บันทึกข้อมูลไก่ลงเล้า</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="close" onclick="closeModal('addModal')">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addForm">
                        <div class="row">
                            <div class="col-sm-4 mt-3">
                                <label for="inputDate">วันที่</label>
                                <input type="date" class="form-control" id="inputDate" placeholder="" name="inputDate">
                            </div>
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
                        </div>
                        <div class="row">
                            <div class="col-sm-4 mt-5">
                                <label for="breedDropdown">ไก่</label>
                                <select class="form-select" id="breedDropdown" name="breedDropdown">
                                    <option value="">เลือกไก่นำเข้า</option>
                                </select> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 mt-1">
                                <label for="chickenF">จำนวนตัวเมีย</label>
                                <input type="text" class="form-control" id="chickenF" placeholder="" name="chickenF">
                            </div>
                            <div class="col-sm-4 mt-1">
                                <label for="chickenM">จำนวนตัวผู้</label>
                                <input type="text" class="form-control" id="chickenM" placeholder="" name="chickenM"> 
                            </div>
                            <div class="col-sm-4 mt-1">
                                <label for="chickenQTY">จำนวนทั้งหมด</label>
                                <input type="text" class="form-control" id="chickenQTY" placeholder="" name="chickenQTY" readonly> 
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="saveAddBtn">บันทึก</button>
                    <button class="btn btn-danger" onclick="clearText()">ยกเลิก</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Modal สำหรับการแก้ไขข้อมูล -->
    <div class="modal fade" id="editModalChicken" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">แก้ไขข้อมูลไก่ลงเล้า</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="close" onclick="closeModal('editModalChicken')">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" id="editId">
                        <div class="row">
                            <div class="col-sm-4 mt-3">
                                <label for="editDate">วันที่</label>
                                <input type="date" class="form-control" id="editDate" placeholder="" name="editDate">
                            </div>
                            <div class="col-sm-4 mt-3">
                                <label for="editFarm">ฟาร์ม</label>
                                <select class="form-select" id="editFarm" name="editFarm">
                                    <option value="">เลือกฟาร์ม</option>
                                </select> 
                            </div>
                            <div class="col-sm-4 mt-3">
                                <label for="editCoop">เล้าที่</label>
                                <select class="form-select" id="editCoop" name="editCoop">
                                    <option value="">เลือกเล้า</option>
                                </select>
                            </div>    
                        </div>
                        <div class="row">
                            <div class="col-sm-2 mt-5">
                                <label for="editBreed">ไก่</label>
                                <select class="form-select" id="editBreed" name="editBreed">
                                    <option value="">เลือกไก่นำเข้า</option>
                                </select> 
                            </div>
                            <div class="col-sm-2 mt-5">
                                <label for="editPrice">ราคา</label>
                                <input type="text" class="form-control" id="editPrice" placeholder="" name="editPrice">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 mt-1">
                                <label for="editChickenF">จำนวนตัวเมีย</label>
                                <input type="text" class="form-control" id="editChickenF" placeholder="" name="editChickenF">
                            </div>
                            <div class="col-sm-2 mt-1">
                                <label for="editChickenM">จำนวนตัวผู้</label>
                                <input type="text" class="form-control" id="editChickenM" placeholder="" name="editChickenM"> 
                            </div>
                            <div class="col-sm-2 mt-1">
                                <label for="sum">จำนวนทั้งหมด</label>
                                <input type="text" class="form-control" id="sum" placeholder="" name="sum" readonly> 
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="editBtn">บันทึก</button>
                    <button class="btn btn-danger" onclick="clearText()">ยกเลิก</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span class="close" onclick="closeModal('editModalChicken')">&times;</span>
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
            var table = $('#chickenTable').DataTable({
                "ajax": {
                    "url": "get_chicken.php",  // เรียกใช้ PHP ที่ดึงข้อมูล
                    "dataSrc": ""                 // กำหนด data source เป็น empty string สำหรับ JSON แบบ array
                },
                "columns": [
                    { "data": "ChickenID" },
                    { "data": "FarmName" },
                    { "data": "CoopName" },
                    {
                        "data": null,
                        "render": function(data, type, row) {
                            // Calculate weeks and days based on two date fields
                            var startDate = new Date(row.ChickenDate);
                            var endDate = new Date();
                            var timeDiff = Math.abs(endDate - startDate);
                            var totalDays = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
                            var weeks = Math.floor(totalDays / 7);
                            return weeks + ' สัปดาห์';
                        }
                    },
                    {
                        "data": null,
                        "render": function(data, type, row) {
                            // Calculate weeks and days based on two date fields
                            var startDate = new Date(row.ChickenDate);
                            var endDate = new Date();
                            var timeDiff = Math.abs(endDate - startDate);
                            var totalDays = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
                            return totalDays + ' วัน';
                        }
                    },
                    { "data": "breedName" },
                    { "data": "ChickenF" },
                    { "data": "ChickenM" },
                    {
                        "data": "ChickenStatus",
                        "render": function(data, type, row) {
                            var statusText = data == 1 ? "กำลังเลี้ยง" : "จำหน่าย";
                            var colorClass = data == 1 ? "text-success" : "text-danger";
                            return '<span class="' + colorClass + '">' + statusText + '</span>';
                        }
                    },
                    { "data": "ChickenDate" },
                    {
                        "data": null,  // คอลัมน์นี้ไม่มีข้อมูลในฐานข้อมูล
                        "render": function (data, type, row) {
                            return '<div class="action-buttons">' +
                                    '<button class="edit-btn btn btn-warning shadow-sm" ' + 
                                    'data-id="' + row.ChickenID + '" ' +
                                    'data-farm="' + row.FarmID + '" ' + 
                                    'data-coop="' + row.CoopID + '" ' +
                                    'data-import="' + row.importID + '" ' +
                                    'data-breed="' + row.breedID + '" ' +
                                    'data-f="' + row.ChickenF + '" ' +
                                    'data-m="' + row.ChickenM + '" ' +
                                    'data-status="' + row.ChickenStatus + '" ' + 
                                    'data-date="' + row.ChickenDate + '"><i class="far fa-edit"></i></button>' +
                                    ' <button class="del-btn btn btn-danger shadow-sm" data-id="' + row.ChickenID + '"><i class="far fa-trash-alt"></i></button>' +
                                    '</div>';
                        }
                    }
                ]
            });
        });

        function clearText(){
            event.preventDefault();
            $('input[type="text"]').val('');
            $('select').prop('selectedIndex', 0);
            $('input[type="date"]').val('');
        }
        
        function closeModal(modalId) {
            $('#' + modalId).modal('hide');
        }
    
        $(document).ready(function() {
            // เปิด modal เมื่อคลิกปุ่ม "Add New Cause"
            $('#addBtn').on('click', function() {

                $.ajax({
                    url: 'checkChicken.php', // ไฟล์ PHP สำหรับเช็คจำนวนไก่
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // สมมติให้ response.returnCode = 1 เมื่อจำนวนไก่เต็มแล้ว
                        if (response.result === 1) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'จำนวนไก่นำเข้าครบแล้ว',
                                text: 'ไม่สามารถเพิ่มไก่ลงเล้าได้อีก',
                                confirmButtonText: 'ตกลง'
                            });
                        } else {
                            // ถ้าจำนวนไก่ยังไม่เต็ม สามารถทำการเพิ่มไก่ได้
                            $('#addModal').modal('show');
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด',
                            text: 'ไม่สามารถเช็คจำนวนไก่ได้',
                            confirmButtonText: 'ตกลง'
                        });
                    }
                });

            });

            // เมื่อผู้ใช้คลิกปุ่มบันทึกใน modal (บันทึกข้อมูลใหม่)
            $('#saveAddBtn').on('click', function() {
                var formData = {
                    farm: $('#farmDropdown').val(),
                    coop: $('#coopDropdown').val(),
                    chicken: $('#breedDropdown').val(),
                    chickenF: $('#chickenF').val(),
                    chickenM: $('#chickenM').val(),
                    inputDate: $('#inputDate').val()
                };

                console.log(formData);

                $.ajax({
                    url: 'chicken_add.php', // URL ของไฟล์ PHP
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        console.log(response);
                        if (response.status === 'success') {
                            Swal.fire('Success!', response.message, 'success').then(() => {
                                $('#addModal').modal('hide');
                                $('#addForm')[0].reset();
                                $('#chickenTable').DataTable().ajax.reload(null, false);  // รีเฟรช DataTable
                            });
                        } else {
                            Swal.fire('Error!', response.message, 'error');
                        }
                    },
                    error: function(xhr, status, error) {  // เพิ่ม parameter xhr ในฟังก์ชัน error
                        Swal.fire('Error!', 'An error occurred while adding the record: ' + xhr.responseText, 'error');
                    }
                });
            });

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

            $.ajax({
                url: 'get_import.php', // ไฟล์ PHP ที่ดึงข้อมูลจากฐานข้อมูล
                type: 'GET',
                dataType: 'json', // คาดหวังข้อมูลในรูปแบบ JSON
                success: function(response) {
                    //console.log(response);
                    // ลูปข้อมูลที่ได้จาก AJAX เพื่อเพิ่มลงใน dropdown
                    $.each(response, function(key, value) {
                        $('#breedDropdown').append('<option value="' + value.importID + '">' + value.importID + ' - ' + value.breedName + '</option>');
                    });
                },
                error: function() {
                    alert('เกิดข้อผิดพลาดในการดึงข้อมูล');
                }
            });

            function calculateSum() {
                // ดึงค่าจาก textbox number1 และ number2
                var num1 = parseFloat($('#chickenF').val()) || 0; // ถ้าไม่มีค่าให้เป็น 0
                var num2 = parseFloat($('#chickenM').val()) || 0;

                // คำนวณผลลัพธ์
                var sum = num1 + num2;

                // แสดงผลลัพธ์ใน textbox sum
                $('#chickenQTY').val(sum);
            }

            // ตรวจจับการเปลี่ยนแปลงใน textbox number1 และ number2
            $('#chickenF, #chickenM').on('input', function() {
                calculateSum();
            });

        });

        // ฟังก์ชัน AJAX เพื่อดึงค่าจำนวนที่นำเข้าจากฐานข้อมูล
        function fetchImportQTY(importID) {
            $.ajax({
                url: 'checkChicken.php', // URL ของ PHP หรือ endpoint ที่ดึงข้อมูล
                type: 'GET',
                data: { importID: importID }, // ส่ง importID ที่ต้องการ
                success: function(response) {
                    // สมมุติว่า response คือจำนวนที่นำเข้า importQTY
                    let importQTY = response.importQTY;
                    // เรียกใช้งานฟังก์ชัน updateTotal และส่ง importQTY ไปตรวจสอบ
                    updateTotal(importQTY);
                },
                error: function(error) {
                    console.error("Error fetching importQTY", error);
                }
            });
        }

        // ฟังก์ชันเพื่อคำนวณและตรวจสอบจำนวนที่กรอก
        function updateTotal(importQTY) {
            const chickenF = parseInt(document.getElementById("chickenF").value) || 0;
            const chickenM = parseInt(document.getElementById("chickenM").value) || 0;
            const total = chickenF + chickenM;

            // แสดงจำนวนทั้งหมด
            document.getElementById("chickenQTY").value = total;

            // คำนวณจำนวนที่ยังสามารถกรอกได้
            const remaining = importQTY - total;

            // ตรวจสอบว่าผลรวมเกิน importQTY หรือไม่
            if (total > importQTY) {
                alert(`จำนวนรวมเกินจำนวนที่นำเข้าที่กำหนดไว้! คุณสามารถกรอกได้อีก ${remaining} ตัว`);
                document.getElementById("saveAddBtn").disabled = true; // ปิดการใช้งานปุ่มบันทึก
            } else {
                document.getElementById("saveAddBtn").disabled = false; // เปิดใช้งานปุ่มบันทึก
            }
        }

        // เมื่อเลือกไก่ใน dropdown, ให้ดึงค่าจำนวนที่นำเข้า
        document.getElementById("breedDropdown").addEventListener("change", function() {
            let selectedImportID = this.value; // ค่าของ importID ที่เลือก
            fetchImportQTY(selectedImportID); // เรียกฟังก์ชัน fetchImportQTY
        });

        // ฟังก์ชันเมื่อกรอกจำนวนไก่ เพื่ออัพเดทการตรวจสอบ
        document.getElementById("chickenF").addEventListener("input", function() {
            let selectedImportID = document.getElementById("breedDropdown").value; // ค่าของ importID ที่เลือก
            if (selectedImportID) {
                fetchImportQTY(selectedImportID); // เรียกฟังก์ชัน fetchImportQTY
            }
        });

        document.getElementById("chickenM").addEventListener("input", function() {
            let selectedImportID = document.getElementById("breedDropdown").value; // ค่าของ importID ที่เลือก
            if (selectedImportID) {
                fetchImportQTY(selectedImportID); // เรียกฟังก์ชัน fetchImportQTY
            }
        });


        ///ส่วนแก้ไข
        $(document).ready(function() {
            // เมื่อคลิกปุ่ม Edit
            $('#chickenTable tbody').on('click', '.edit-btn', function() {
                // ดึงข้อมูลจากปุ่มที่คลิก
                var id = $(this).data('id');
                var farm = $(this).data('farm');
                var coop = $(this).data('coop');
                var breed = $(this).data('breed');
                var f = $(this).data('f');
                var m = $(this).data('m');
                var status = $(this).data('status');
                var date = $(this).data('date');

                // ตรวจสอบค่าที่ดึงมา
                console.log("ID: " + id);
                console.log("Breeds: " + breed);

                // ใส่ข้อมูลในฟอร์มของ Modal
                $('#editId').val(id);
                $('#editFarm').val(farm);
                $('#editCoop').val(coop);
                $('#editBreed').val(breed);
                $('#editChickenF').val(f);
                $('#editChickenM').val(m);
                $('#editPrice').val(price);
                $('#editDate').val(date);

                //คำนวนจำนวนที่ตายทั้งหมด
                var totalSort = parseInt(f) + parseInt(m);
                $('#sum').val(totalSort);

                // เปิด Modal
                $('#editModalChicken').modal('show');
            });

            $.ajax({
                url: 'get_farm.php', // ไฟล์ PHP ที่ดึงข้อมูลจากฐานข้อมูล
                type: 'GET',
                dataType: 'json', // คาดหวังข้อมูลในรูปแบบ JSON
                success: function(response) {
                    //console.log(response);
                    // ลูปข้อมูลที่ได้จาก AJAX เพื่อเพิ่มลงใน dropdown
                    $.each(response, function(key, value) {
                        $('#editFarm').append('<option value="' + value.FarmID + '">' + value.FarmName + '</option>');
                    });
                },
                error: function() {
                    alert('เกิดข้อผิดพลาดในการดึงข้อมูล');
                }
            });

            $.ajax({
                url: 'get_coop.php', // ไฟล์ PHP ที่ดึงข้อมูลจากฐานข้อมูล
                type: 'GET',
                dataType: 'json', // คาดหวังข้อมูลในรูปแบบ JSON
                success: function(response) {
                    //console.log(response);
                    // ลูปข้อมูลที่ได้จาก AJAX เพื่อเพิ่มลงใน dropdown
                    $.each(response, function(key, value) {
                        $('#editCoop').append('<option value="' + value.CoopID + '">' + value.CoopName + '</option>');
                    });
                },
                error: function() {
                    alert('เกิดข้อผิดพลาดในการดึงข้อมูล');
                }
            });

            $.ajax({
                url: 'get_import.php', // ไฟล์ PHP ที่ดึงข้อมูลจากฐานข้อมูล
                type: 'GET',
                dataType: 'json', // คาดหวังข้อมูลในรูปแบบ JSON
                success: function(response) {
                    //console.log(response);
                    // ลูปข้อมูลที่ได้จาก AJAX เพื่อเพิ่มลงใน dropdown
                    $.each(response, function(key, value) {
                        $('#editBreed').append('<option value="' + value.importID + '">' + value.importID + ' - ' + value.breedName + '</option>');
                    });
                },
                error: function() {
                    alert('เกิดข้อผิดพลาดในการดึงข้อมูล');
                }
            });

            function calculateSum() {
                // ดึงค่าจาก textbox number1 และ number2
                var num1 = parseFloat($('#editChickenF').val()) || 0; // ถ้าไม่มีค่าให้เป็น 0
                var num2 = parseFloat($('#editChickenM').val()) || 0;

                // คำนวณผลลัพธ์
                var sum = num1 + num2;

                // แสดงผลลัพธ์ใน textbox sum
                $('#sum').val(sum);
            }

            // ตรวจจับการเปลี่ยนแปลงใน textbox number1 และ number2
            $('#editChickenF, #editChickenM').on('input', function() {
                calculateSum();
            });

            // เมื่อส่งฟอร์มใน Modal
            $('#editBtn').on('click', function(e) {
                e.preventDefault();

                // ดึงข้อมูลที่แก้ไขจากฟอร์ม
                var formData = {
                    id: $('#editId').val(),
                    farm: $('#editFarm').val(),
                    coop: $('#editCoop').val(),
                    chicken: $('#editBreed').val(),
                    chickenF: $('#editChickenF').val(),
                    chickenM: $('#editChickenM').val(),
                    price: $('#editPrice').val(),
                    inputDate: $('#editDate').val()
                };

                // ส่งข้อมูลไปยังเซิร์ฟเวอร์เพื่อบันทึกการแก้ไข
                $.ajax({
                    url: 'chicken_edit.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        console.log(response.message);
                        if (response.status === 'success') {
                            Swal.fire('Success!', response.message, 'success').then(() => {
                                        $('#editModalChicken').modal('hide'); // ปิด Modal
                                        $('#chickenTable').DataTable().ajax.reload(null, false);
                                    });
                        } else {
                            Swal.fire('Error!', response.message, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error!', 'An error occurred while updating the record.', 'error');
                    }
                });
            });

            $('#chickenTable tbody').on('click', '.del-btn', function() {
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // ถ้าผู้ใช้ยืนยันการลบ ส่ง AJAX ไปที่ delete.php
                        $.ajax({
                            url: 'chicken_del.php',
                            type: 'POST',
                            dataType: 'json',
                            data: { id: id },
                            success: function(response) {
                                if (response.status === 'success') {
                                    Swal.fire('Success!', response.message, 'success').then(() => {
                                        $('#chickenTable').DataTable().ajax.reload(null, false);
                                    });
                                } else {
                                    Swal.fire('Error!', response.message, 'error');
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.error("Error details: ", textStatus, errorThrown);  // ตรวจสอบรายละเอียดข้อผิดพลาด
                                Swal.fire('Error!', 'An error occurred while deleting the record.', 'error');
                            }
                        });
                    }
                });
            });

        });
        
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

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

   

</body>

</html>