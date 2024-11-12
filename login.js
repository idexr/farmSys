$(document).ready(function() {
    $('#form').on('submit', function(event) {
        event.preventDefault(); // ป้องกันการส่งฟอร์มแบบปกติ

        // รับค่าจากฟอร์ม
        const username = $('#username').val();
        const password = $('#password').val();

        // ส่งข้อมูลไปยัง server
        $.ajax({
            url: 'login.php', // ไฟล์ PHP ที่ใช้ตรวจสอบล็อกอิน
            type: 'POST',
            data: {username: username, password: password},
            success: function(response) {
                console.log(response);  
                try {
                    const result = JSON.parse(response);
                    if (result.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Login Successful',
                            text: `Welcome, ${username}! Level: ${result.level}`,
                        }).then(() => {
                            if (result.level === 'sa') {
                                window.location.href = 'index.php';
                            } else if (result.level === 'admin') {
                                window.location.href = 'index.php';
                            } else {
                                window.location.href = 'chickendead.php';
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Login Failed',
                            text: 'Invalid username or password',
                        });
                    }
                } catch (error) {
                    console.error("Error parsing JSON:", error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to process server response',
                    });
                }
            }
        });
    });
});