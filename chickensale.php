<?php
include 'checkSession.php';
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
        .btn-sd:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .action-buttons {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
        }

        .action-buttons button {
            margin: 0 5px;
            /* กำหนดระยะห่างระหว่างปุ่ม */
        }

        th.ten-col {
            width: 10%;
        }

        th.five-col {
            width: 5%;
        }

        th.twenty-col {
            width: 20%;
            /* คอลัมน์ Actions */
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
                        <h1 class="h3 mb-0 text-gray-800">บันทึกข้อมูลขายไก่</h1>
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
                                        <table class="table table-bordered" id="saleTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th class="ten-col">พันธุ์ไก่</th>
                                                    <th class="ten-col">ฟาร์ม</th>
                                                    <th class="ten-col">เล้า</th>
                                                    <th class="ten-col">จำนวนตัวเมียที่ขาย</th>
                                                    <th class="ten-col">จำนวนตัวผู้ที่ขาย</th>
                                                    <th class="ten-col">หมายเหตุ</th>
                                                    <th class="ten-col">ราคา</th>
                                                    <th class="ten-col">วันที่บันทึก</th>
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
                    <h5 class="modal-title" id="addModalLabel">บันทึกข้อมูลขาย</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="close" onclick="closeModal('addModal')">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
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
                            <div class="col-sm-4 mt-3">
                                <label for="sale_f">จำนวนตัวเมียที่ขาย</label>
                                <input type="text" class="form-control" id="sale_f" placeholder="" name="sale_f">
                            </div>
                            <div class="col-sm-4 mt-3">
                                <label for="sale_m">จำนวนตัวผู้ที่ขาย</label>
                                <input type="text" class="form-control" id="sale_m" placeholder="" name="sale_m">
                            </div>
                            <div class="col-sm-4 mt-3">
                                <label for="sale">จำนวนที่ขายทั้งหมด</label>
                                <input type="cause" class="form-control" id="sale" placeholder="" name="sale" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 mt-3">
                                <label for="price">ราคา</label>
                                <input type="text" class="form-control" id="price" placeholder="" name="price">
                            </div>
                            <div class="col-sm-4 mt-3">
                                <label for="saleDropdown">หมายเหตุ</label>
                                <select class="form-select" id="saleDropdown" name="saleDropdown">
                                    <option value="">เลือกหมายเหตุ</option>
                                </select>
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

    <!-- Bootstrap Modal สำหรับการแก้ไขข้อมูล ตารางตาย -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">แก้ไขข้อมูลคัดทิ้ง</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="close" onclick="closeModal('editModal')">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" id="editId">
                        <div class="row">
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
                            <div class="col-sm-4 mt-3">
                                <label for="editDate">วันที่</label>
                                <input type="date" class="form-control" id="editDate" placeholder="" name="editDate">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 mt-3">
                                <label for="editF">จำนวนตัวเมียที่ขาย</label>
                                <input type="text" class="form-control" id="editF" placeholder="" name="editF">
                            </div>
                            <div class="col-sm-4 mt-3">
                                <label for="editM">จำนวนตัวผู้ที่ขาย</label>
                                <input type="text" class="form-control" id="editM" placeholder="" name="editM">
                            </div>
                            <div class="col-sm-4 mt-3">
                                <label for="sum">จำนวนที่ขายทั้งหมด</label>
                                <input type="text" class="form-control" id="sum" placeholder="" name="sum" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 mt-3">
                                <label for="editPrice">ราคา</label>
                                <input type="text" class="form-control" id="editPrice" placeholder="" name="editPrice">
                            </div>
                            <div class="col-sm-4 mt-3">
                                <label for="editType">หมายเหตุ</label>
                                <select class="form-select" id="editType" name="editType">
                                    <option value="">เลือกหมายเหตุ</option>
                                </select>
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
                        <span class="close" onclick="closeModal('logoutModal')"></span>
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
            var table = $('#saleTable').DataTable({
                "ajax": {
                    "url": "get_sale.php", // เรียกใช้ PHP ที่ดึงข้อมูล
                    "dataSrc": "" // กำหนด data source เป็น empty string สำหรับ JSON แบบ array
                },
                "columns": [{
                        "data": "breedName"
                    },
                    {
                        "data": "FarmName"
                    },
                    {
                        "data": "CoopName"
                    },
                    {
                        "data": "SaleF"
                    },
                    {
                        "data": "SaleM"
                    },
                    {
                        "data": "SaleTypeName"
                    },
                    {
                        "data": "SalePrice"
                    },
                    {
                        "data": "SaleDate"
                    },
                    {
                        "data": null, // คอลัมน์นี้ไม่มีข้อมูลในฐานข้อมูล
                        "render": function(data, type, row) {
                            return '<div class="action-buttons">' +
                                '<button class="edit-btn btn btn-warning shadow-sm" ' +
                                'data-id="' + row.SaleID + '" ' +
                                'data-farm="' + row.FarmID + '" ' +
                                'data-coop="' + row.CoopID + '" ' +
                                'data-saleF="' + row.SaleF + '" ' +
                                'data-saleM="' + row.SaleM + '" ' +
                                'data-price="' + row.SalePrice + '" ' +
                                'data-type="' + row.SaleTypeID + '" ' +
                                'data-date="' + row.SaleDate + '"><i class="far fa-edit"></i></button>' +
                                ' <button class="del-btn btn btn-danger shadow-sm" data-id="' + row.SaleID + '"><i class="far fa-trash-alt"></i></button>' +
                                '</div>';
                        }
                    }
                ]
            });
        });

        $(document).ready(function() {
            // ฟังก์ชันคำนวณผลลัพธ์
            function calculateSum() {
                // ดึงค่าจาก textbox number1 และ number2
                var num1 = parseFloat($('#sale_f').val()) || 0; // ถ้าไม่มีค่าให้เป็น 0
                var num2 = parseFloat($('#sale_m').val()) || 0;

                // คำนวณผลลัพธ์
                var sum = num1 + num2;

                // แสดงผลลัพธ์ใน textbox sum
                $('#sale').val(sum);
            }

            // ตรวจจับการเปลี่ยนแปลงใน textbox number1 และ number2
            $('#sale_f, #sale_m').on('input', function() {
                calculateSum();
            });
        });

        function clearText() {
            event.preventDefault();
            $('input[type="text"]').val('');
            $('select').prop('selectedIndex', 0);
            $('input[type="date"]').val('');
        }

        function closeModal(modalId) {
            $('#' + modalId).modal('hide');
        }

        //เพิ่ม-ลบ-แก้ไข
        $(document).ready(function() {

            // Add
            $('#addBtn').on('click', function() {
                $('#addModal').modal('show');
            });

            // เมื่อผู้ใช้คลิกปุ่มบันทึกใน modal (บันทึกข้อมูลใหม่)
            $('#saveAddBtn').on('click', function() {
                var formData = {
                    farm: $('#farmDropdown').val(),
                    coop: $('#coopDropdown').val(),
                    sale_f: $('#sale_f').val(),
                    sale_m: $('#sale_m').val(),
                    type: $('#saleDropdown').val(),
                    price: $('#price').val(),
                    inputDate: $('#inputDate').val()
                };
                //console.log(formData);
                // ส่งข้อมูลด้วย AJAX
                $.ajax({
                    url: 'chickensale_add.php', // PHP ที่จัดการการเพิ่มข้อมูล
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire('Success!', response.message, 'success').then(() => {
                                $('#addModal').modal('hide'); // ปิด modal
                                $('input[type="text"]').val(''); // เคลียร์ textbox ทั้งหมด
                                $('select').prop('selectedIndex', 0); // รีเซ็ต dropdown ทั้งหมดกลับเป็นค่าแรก
                                $('input[type="date"]').val('');
                                $('#saleTable').DataTable().ajax.reload(null, false); // รีเฟรช DataTable
                            });
                        } else {
                            Swal.fire('Error!', response.message, 'error');
                        }
                    },
                    error: function(xhr, status, error) { // เพิ่ม parameter xhr ในฟังก์ชัน error
                        Swal.fire('Error!', 'An error occurred while adding the record: ' + xhr.responseText, 'error');
                    }
                });
            });

            $.ajax({
                url: 'get_farm.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    //console.log(response);
                    $.each(response, function(key, value) {
                        $('#farmDropdown').append('<option value="' + value.FarmID + '">' + value.FarmName + '</option>');
                    });
                },
                error: function() {
                    alert('เกิดข้อผิดพลาดในการดึงข้อมูล');
                }
            });

            $.ajax({
                url: 'get_coop.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    //console.log(response);
                    $.each(response, function(key, value) {
                        $('#coopDropdown').append('<option value="' + value.CoopID + '">' + value.CoopName + '</option>');
                    });
                },
                error: function() {
                    alert('เกิดข้อผิดพลาดในการดึงข้อมูล');
                }
            });

            $.ajax({
                url: 'get_sortType.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    //console.log(response);
                    $.each(response, function(key, value) {
                        $('#sortDropdown').append('<option value="' + value.SortTypeID + '">' + value.SortTypeName + '</option>')
                    });
                },
                error: function() {
                    alert('เกิดข้อผิดพลาดในการดึงข้อมูล');
                }
            });

            //Edit
            $('#saleTable tbody').on('click', '.edit-btn', function() {
                // ดึงข้อมูลจากปุ่มที่คลิก
                var id = $(this).attr('data-id');
                var farm = $(this).attr('data-farm');
                var coop = $(this).attr('data-coop');
                var saleF = $(this).attr('data-saleF');
                var saleM = $(this).attr('data-saleM');
                var type = $(this).attr('data-type');
                var price = $(this).attr('data-price');
                var date = $(this).attr('data-date');

                // ตรวจสอบค่าที่ดึงมา
                /*console.log("ID: " + id);
                console.log("Farm: " + farm);
                console.log("Coop: " + coop);
                console.log("saleF: " + saleF);
                console.log("saleM: " + saleM);
                console.log("Type: " + type);
                console.log("price: " + price);
                console.log("Date: " + date);*/

                // ใส่ข้อมูลในฟอร์มของ Modal
                $('#editId').val(id);
                $('#editFarm').val(farm);
                $('#editCoop').val(coop);
                $('#editF').val(saleF);
                $('#editM').val(saleM);
                $('#editType').val(type);
                $('#editPrice').val(price);
                $('#editDate').val(date);

                //คำนวนจำนวนที่ตายทั้งหมด
                var total = parseInt(saleF) + parseInt(saleM);
                $('#sum').val(total);

                // เปิด Modal
                $('#editModal').modal('show');
            });

            $.ajax({
                url: 'get_farm.php', // ไฟล์ PHP ที่ดึงข้อมูลจากฐานข้อมูล
                type: 'GET',
                dataType: 'json', // คาดหวังข้อมูลในรูปแบบ JSON
                success: function(response) {
                    //console.log(response);
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
                    $.each(response, function(key, value) {
                        $('#editCoop').append('<option value="' + value.CoopID + '">' + value.CoopName + '</option>');
                    });
                },
                error: function() {
                    alert('เกิดข้อผิดพลาดในการดึงข้อมูล');
                }
            });

            $.ajax({
                url: 'get_saleType.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    //console.log(response);
                    $.each(response, function(key, value) {
                        $('#editType').append('<option value="' + value.SaleTypeID + '">' + value.SaleTypeName + '</option>')
                    });
                },
                error: function() {
                    alert('เกิดข้อผิดพลาดในการดึงข้อมูล');
                }
            });

            $(document).ready(function() {
                // ฟังก์ชันคำนวณผลลัพธ์
                function calculateSum() {
                    // ดึงค่าจาก textbox number1 และ number2
                    var num1 = parseFloat($('#editF').val()) || 0; // ถ้าไม่มีค่าให้เป็น 0
                    var num2 = parseFloat($('#editM').val()) || 0;

                    // คำนวณผลลัพธ์
                    var sum = num1 + num2;

                    // แสดงผลลัพธ์ใน textbox sum
                    $('#sum').val(sum);
                }

                // ตรวจจับการเปลี่ยนแปลงใน textbox number1 และ number2
                $('#editF, #editM').on('input', function() {
                    calculateSum();
                });
            });


            // เมื่อส่งฟอร์มใน Modal
            $('#editBtn').on('click', function(e) {
                e.preventDefault();

                // ดึงข้อมูลที่แก้ไขจากฟอร์ม
                var formData = {
                    id: $('#editId').val(),
                    farm: $('#editFarm').val(),
                    coop: $('#editCoop').val(),
                    sale_f: $('#editF').val(),
                    sale_m: $('#editM').val(),
                    price: $('#editPrice').val(),
                    type: $('#editType').val(),
                    inputDate: $('#editDate').val()
                };
                console.log(formData);
                // ส่งข้อมูลไปยังเซิร์ฟเวอร์เพื่อบันทึกการแก้ไข
                $.ajax({
                    url: 'chickensale_edit.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        //console.log(response.message);
                        if (response.status === 'success') {
                            Swal.fire('Success!', response.message, 'success').then(() => {
                                $('#editModal').modal('hide'); // ปิด Modal
                                $('#saleTable').DataTable().ajax.reload(null, false);
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

            $('#saleTable tbody').on('click', '.del-btn', function() {
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
                            url: 'chickensale_del.php',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                id: id
                            },
                            success: function(response) {
                                if (response.status === 'success') {
                                    Swal.fire('Success!', response.message, 'success').then(() => {
                                        $('#editModal').modal('hide'); // ปิด Modal
                                        $('#saleTable').DataTable().ajax.reload(null, false);
                                    });
                                } else {
                                    Swal.fire('Error!', response.message, 'error');
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.error("Error details: ", textStatus, errorThrown); // ตรวจสอบรายละเอียดข้อผิดพลาด
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