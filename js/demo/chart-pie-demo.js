// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// เลือก canvas element ที่จะใช้วาดกราฟ
var ctx = document.getElementById("myPieChart");

// สร้าง Pie Chart
var myPieChart = new Chart(ctx, {
    type: 'doughnut', // กำหนดประเภทของกราฟเป็น doughnut
    data: {
        labels: ["เซ่งเฮง1", "เซ่งเฮง2", "แสลงพัน", "สระสี่เหลี่ยม"], // ชื่อหมวดหมู่ในกราฟ
        datasets: [{
            data: [40, 30, 20, 10], // ปรับค่าตามข้อมูลที่ต้องการ
            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#6c757d'], // สีพื้นหลังของแต่ละหมวดหมู่
            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#5a6268'], // สีเมื่อ hover
            hoverBorderColor: "rgba(234, 236, 244, 1)", // สีขอบเมื่อ hover
        }],
    },
    options: {
        maintainAspectRatio: false, // ไม่ต้องรักษาสัดส่วนของกราฟ
        tooltips: {
            backgroundColor: "rgb(255,255,255)", // สีพื้นหลังของ tooltips
            bodyFontColor: "#858796", // สีตัวอักษรใน tooltips
            borderColor: '#dddfeb', // สีขอบของ tooltips
            borderWidth: 1, // ความกว้างของขอบ
            xPadding: 15, // Padding ด้านข้าง
            yPadding: 15, // Padding ด้านบนและล่าง
            displayColors: false, // ไม่แสดงสีของข้อมูลใน tooltips
            caretPadding: 10, // Padding ของ caret ใน tooltips
        },
        legend: {
            display: false // ไม่แสดง legend
        },
        cutoutPercentage: 80, // กำหนดเปอร์เซ็นต์ของพื้นที่ที่ถูกตัดออกในกราฟ doughnut
    },
});
