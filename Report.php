<?php
    include 'connect.php';
    require_once('TCPDF/tcpdf.php');

    class MYPDF extends TCPDF {
        public function Header() {
            $this->SetFont('thsarabunnew', 'B', 20);
            $this->Cell(0, 27, 'รายงานการเลี้ยงไก่', 0, 1, 'C');
        }
    }

    $pdf = new MYPDF('L', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetFont('thsarabunnew', '', 14);

    try {
        $conn = new PDO("sqlsrv:server=$serverName;Database=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // คิวรีข้อมูลฟาร์มและเล้าทั้งหมด
        $coopSql = "SELECT DISTINCT f.FarmID, co.CoopID
                    FROM Farm AS f
                    JOIN Chicken AS c ON f.FarmID = c.FarmID
                    JOIN Coop AS co ON c.CoopID = co.CoopID
                    ORDER BY f.FarmID ASC
                    ";

        $coopStmt = $conn->prepare($coopSql);
        $coopStmt->execute();
        $coops = $coopStmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($coops as $coop) {
            $pdf->AddPage();
            $coopID = $coop['CoopID'];
            $farmID = $coop['FarmID'];

            //เรียกข้อมูลการตายสะสม
            $dsSQL = "SELECT 
                            SUM(ISNULL(d.DeadF, 0)) AS DeadF,
                            SUM(ISNULL(d.DeadM, 0)) AS DeadM,
                            SUM(ISNULL(s.SortF, 0)) AS SortF,
                            SUM(ISNULL(s.SortM, 0)) AS SortM,
                            SUM(ISNULL(d.DeadF, 0) + ISNULL(s.SortF, 0)) AS sumF,
                            SUM(ISNULL(d.DeadM, 0) + ISNULL(s.SortM, 0)) AS sumM,
                            SUM(ISNULL(d.DeadF, 0) + ISNULL(s.SortF, 0) + ISNULL(d.DeadM, 0) + ISNULL(s.SortM, 0)) AS total
                        FROM 
                            Dead AS d
                        LEFT JOIN 
                            Sort AS s ON d.ChickenID = s.ChickenID
                            AND (
                                MONTH(s.SortDate) <> MONTH(GETDATE()) 
                                OR YEAR(s.SortDate) <> YEAR(GETDATE())
                            )
                        WHERE 
                            d.FarmID = 'f-003' 
                            AND d.CoopID = 'c-005'
                            AND (
                                MONTH(d.DeadDate) <> MONTH(GETDATE()) 
                                OR YEAR(d.DeadDate) <> YEAR(GETDATE())
                            )";
            $dsStmt = $conn->prepare($dsSQL);
            $dsStmt->execute();
            $ds = $dsStmt->fetchAll(PDO::FETCH_ASSOC);

            $cum = $ds['total'] ?? 0;
            $cumF = $ds['sumF'] ?? 0;
            $cumM = $ds['sumM'] ?? 0;

            // คิวรีข้อมูลสำหรับเล้านั้นๆ
            $dataSql = "SELECT f.FarmName,
                            co.CoopName,
                            b.breedName,
                            ISNULL(c.ChickenF, 0) AS ChickenF,
                            ISNULL(c.ChickenM, 0) AS ChickenM
                        FROM Chicken AS c
                        LEFT JOIN Farm AS f ON c.FarmID = f.FarmID
                        LEFT JOIN Coop AS co ON c.CoopID = co.CoopID
                        LEFT JOIN importChicken AS imp ON c.importID = imp.importID
                        LEFT JOIN Breeds AS b ON imp.breedID = b.breedID
                        WHERE c.FarmID = '" . $farmID . "' 
                            AND c.CoopID = '" . $coopID . "'
                        GROUP BY 
                            c.ChickenF,
                            c.ChickenM,
                            f.FarmName,
                            co.CoopName,
                            b.breedName
                        ";
            $dataStmt = $conn->prepare($dataSql);
            $dataStmt->execute();
            $firstRow = $dataStmt->fetch(PDO::FETCH_ASSOC);

            $ChickenF = $firstRow['ChickenF'] ?? 0;
            $ChickenM = $firstRow['ChickenM'] ?? 0;

            if ($firstRow) { // ตรวจสอบว่ามีข้อมูลอยู่
        
                // เพิ่มข้อมูลในตาราง
                $html = '
                <table border="0">
                    <tr>
                        <td rowspan="4">
                            <img src="./img/S__36020230.jpg" alt="Description of the image" width="70" height="50">
                        </td>
                        <td>ชื่อฟาร์ม: ' . $firstRow['FarmName'] . '</td>
                        <td>เล้า: ' . $firstRow['CoopName'] . '</td>
                        <td>พันธุ์ไก่: ' . $firstRow['breedName'] . '</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>ยอดเริ่มเลี้ยง: ' . $firstRow['ChickenF'] + $firstRow['ChickenM'] . '</td>
                        <td>ตัวเมีย: ' . $firstRow['ChickenF'] . '</td>
                        <td>ตัวผู้: ' . $firstRow['ChickenM'] . '</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>ยอดสูญเสียสะสม: ' . $cum . '</td>
                        <td>ตัวเมีย: ' . $cumF . '</td>
                        <td>ตัวผู้: ' . $cumM . '</td>
                        <td></td>
                    </tr>
                </table>
                ';
            } else {
                $html = '
                <table border="0">
                    <tr>
                        <td rowspan="4">
                            <img src="./img/S__36020230.jpg" alt="Description of the image" width="70" height="50">
                        </td>
                        <td>ชื่อฟาร์ม: ไม่มีพบข้อมูล</td>
                        <td>เล้า: ไม่มีพบข้อมูล</td>
                        <td>พันธุ์ไก่: ไม่มีพบข้อมูล</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>ยอดเริ่มเลี้ยง: ไม่มีพบข้อมูล</td>
                        <td>ตัวเมีย: ไม่มีพบข้อมูล</td>
                        <td>ตัวผู้: ไม่มีพบข้อมูล</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>ยอดสูญเสียสะสม: ไม่มีพบข้อมูล</td>
                        <td>ตัวเมีย: ไม่มีพบข้อมูล</td>
                        <td>ตัวผู้: ไม่มีพบข้อมูล</td>
                        <td></td>
                    </tr>
                </table>
                ';
            }

            $html .= '<table border="1" align="center">
            <thead>
                <tr style="background-color: #CCCCCC;">
                    <th rowspan="3">ว/ด/ป</th>
                    <th rowspan="3">วันเริ่ม เลี้ยง</th>
                    <th colspan="2">อายุ</th>
                    <th colspan="7">จำนวนไก่ตัวเมีย</th>
                    <th colspan="7">จำนวนไก่ตัวผู้</th>
                </tr>
                <tr style="background-color: #CCCCCC;">
                    <th rowspan="2">สัปดาห์</th>
                    <th rowspan="2">วัน</th>
                    <th colspan="6">สูญเสีย</th>
                    <th rowspan="2">คงเหลือ</th>
                    <th colspan="6">สูญเสีย</th>
                    <th rowspan="2">คงเหลือ</th>
                </tr>
                <tr style="background-color: #CCCCCC;">
                    <th>ตาย</th>
                    <th>คัด</th>
                    <th>รวม</th>
                    <th>สะสม</th>
                    <th>%day</th>
                    <th>%Cum</th>
                    <th>ตาย</th>
                    <th>คัด</th>
                    <th>รวม</th>
                    <th>สะสม</th>
                    <th>%day</th>
                    <th>%Cum</th>
                </tr>
            </thead>
            <tbody>';

            $sql = "SELECT FORMAT(d.DeadDate, 'dd/MM/yy') AS ReportDate,
                            FORMAT(c.ChickenDate, 'dd/MM/yy') AS StartDate,
                            c.ChickenDate,
                            d.DeadDate,
                            f.FarmName,
                            co.CoopName,
                            b.breedName,
                            ISNULL(c.ChickenF, 0) AS ChickenF,
                            ISNULL(c.ChickenM, 0) AS ChickenM,
                            SUM(ISNULL(d.DeadF, 0)) AS DeadF,
                            SUM(ISNULL(d.DeadM, 0)) AS DeadM,
                            SUM(ISNULL(s.SortF, 0)) AS SortF,
                            SUM(ISNULL(S.SortM, 0)) AS SortM,
                            SUM(ISNULL(d.DeadF, 0) + ISNULL(s.SortF, 0)) AS sumF,
                            SUM(ISNULL(d.DeadM, 0) + ISNULL(S.SortM, 0)) AS sumM
                    FROM Chicken AS c
                    LEFT JOIN Dead AS d ON c.ChickenID = d.ChickenID
                    LEFT JOIN Sort AS s ON c.ChickenID = s.ChickenID
                    LEFT JOIN Farm AS f ON c.FarmID = f.FarmID
                    LEFT JOIN Coop AS co ON c.CoopID = co.CoopID
                    LEFT JOIN importChicken AS imp ON c.importID = imp.importID
                    LEFT JOIN Breeds AS b ON imp.breedID = b.breedID
                    WHERE c.FarmID = '" . $farmID . "' 
                        AND c.CoopID = '" . $coopID . "' 
                        AND MONTH(d.DeadDate) = MONTH(GETDATE())
                        AND YEAR(d.DeadDate) = YEAR(GETDATE())
                    GROUP BY d.DeadDate,
                            c.ChickenDate,
                            f.FarmName,
                            co.CoopName,
                            b.breedName,
                            c.ChickenF,
                            c.ChickenM
                    ";

            $checkstmt = $conn->prepare($sql);
            $checkstmt->execute();

            if ($checkstmt->fetchColumn() > 0) {

                $rowCount = 0;
                $totalDeadF = 0;
                $totalSortF = 0;
                $totalF = 0;
                $totalDeadM = 0;
                $totalSortM = 0;
                $totalM = 0;
                $sumPercentDayF = 0;
                $sumPercentDayM = 0;
    
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    //echo json_encode($row);
    
                    $startDate = $row['ChickenDate'];
                    $endDate = $row['DeadDate'];
                    $result = calculateWeeksAndDays($startDate, $endDate);
    
                    $deadF = $row['DeadF'] ?? 0; 
                    $sortF = $row['SortF'] ?? 0;
                    $sumF = $row['sumF'] ?? 0;
                    $deadM = $row['DeadM'] ?? 0;
                    $sortM = $row['SortM'] ?? 0;
                    $sumM = $row['sumM'] ?? 0;
                    
                    $ChickenF -= $sumF;
                    $ChickenM -= $sumM;
    
                    $percentDayF = ($ChickenF != 0) ? ($sumF / $ChickenF * 100) : 0;
                    $percentDayM = ($ChickenM != 0) ? ($sumM / $ChickenM * 100) : 0;
    
                    // เพิ่มยอดรวม
                    $totalDeadF += $deadF;
                    $totalSortF += $sortF;
                    $totalF += $sumF;
                    $totalDeadM += $deadM;
                    $totalSortM += $sortM;
                    $totalM += $sumM;
                    $sumPercentDayF += $percentDayF;
                    $sumPercentDayM += $percentDayM;
    
                    $html .= '<tr>
                        <td>' . $row['ReportDate'] . '</td>
                        <td>' . $row['StartDate'] . '</td>
                        <td>' . $result['weeks'] . '</td>
                        <td>' . $result['days'] . '</td>
                        <td>' . $deadF . '</td>
                        <td>' . $sortF . '</td>
                        <td>' . $sumF . '</td>
                        <td>' . $totalF . '</td>
                        <td>' . number_format($percentDayF, 2) . '%</td>
                        <td>' . number_format($sumPercentDayF, 2) . '%</td>
                        <td>' . $ChickenF . '</td>
                        <td>' . $deadM . '</td>
                        <td>' . $sortM . '</td>
                        <td>' . $sumM . '</td>
                        <td>' . $totalM . '</td>
                        <td>' . number_format($percentDayM, 2) . '%</td>
                        <td>' . number_format($sumPercentDayM, 2) . '%</td>
                        <td>' . $ChickenM . '</td>
                    </tr>';
    
                    $rowCount++;
                    if ($rowCount == 7) {
                        $html .= '<tr style="background-color: #CCCCCC;">
                            <td colspan="4">รวมยอด</td>
                            <td>' . $totalDeadF . '</td>
                            <td>' . $totalSortF . '</td>
                            <td>' . $totalF . '</td>
                            <td>0</td>
                            <td>' . number_format($sumPercentDayF, 2) . '%</td>
                            <td>0</td>
                            <td>' . $ChickenF . '</td>
                            <td>' . $totalDeadM . '</td>
                            <td>' . $totalSortM . '</td>
                            <td>' . $totalM . '</td>
                            <td>0</td>
                            <td>' . number_format($sumPercentDayM, 2) . '%</td>
                            <td>0</td>
                            <td>' . $ChickenM . '</td>
                        </tr>';
                        
                        // รีเซ็ตตัวแปรรวมยอด และเริ่มนับแถวใหม่
                        $rowCount = 0;
                        $totalDeadF = 0;
                        $totalSortF = 0;
                        $totalChickenF = 0;
                        $totalDeadM = 0;
                        $totalSortM = 0;
                        $totalChickenM = 0;
                    } 
                }
                if ($rowCount > 0 && $rowCount < 7) {
                    $html .= '<tr style="background-color: #CCCCCC;">
                        <td colspan="4">รวมยอด</td>
                        <td>' . $totalDeadF . '</td>
                        <td>' . $totalSortF . '</td>
                        <td>' . $totalF . '</td>
                        <td>0</td>
                        <td>' . number_format($sumPercentDayF, 2) . '%</td>
                        <td>0</td>
                        <td>' . $ChickenF . '</td>
                        <td>' . $totalDeadM . '</td>
                        <td>' . $totalSortM . '</td>
                        <td>' . $totalM . '</td>
                        <td>0</td>
                        <td>' . number_format($sumPercentDayM, 2) . '%</td>
                        <td>0</td>
                        <td>' . $ChickenM . '</td>
                    </tr>';
                }
            } else {
                // ไม่มีข้อมูล
                $html .= '<tr><td colspan="18">ไม่มีข้อมูลในชุดผลลัพธ์</td></tr>';
            }
            $html .= '</tbody></table>';
            $pdf->writeHTML($html, true, false, true, false, '');
        }

        // Output the PDF
        $pdf->Output('ChickenReport_AllFarms.pdf', 'I');
    } catch (PDOException $e) {
        echo 'Database Error: ' . $e->getMessage();
    }

    function calculateWeeksAndDays($startDate, $endDate) {
        $start = strtotime($startDate);
        $end = strtotime($endDate);
        $totalDays = floor(($end - $start) / (60 * 60 * 24));
        return array('weeks' => floor($totalDays / 7), 'days' => $totalDays);
    }
?>
