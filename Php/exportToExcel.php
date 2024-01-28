<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function exportToExcel()
{
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set headers
    $headers = ['ID Number', 'Firstname', 'Lastname', 'Gender', 'Email'];
    $column = 1;
    foreach ($headers as $header) {
        $sheet->setCellValueByColumnAndRow($column, 1, $header);
        $column++;
    }

    // Set data
    include 'C:\xampp\htdocs\MBRMIS\Php\db.php';
    $sql = "SELECT firstname, lastname, idnumber, email, gender FROM staff";
    $result = $conn->query($sql);

    if ($result) {
        $rowNumber = 2;
        while ($row = $result->fetch_assoc()) {
            $class = (strtolower(trim($row["account_status"])) == 'activated') ? 'delivered' : 'cancelled';
            $sheet->setCellValueByColumnAndRow(1, $rowNumber, $row["idnumber"]);
            $sheet->setCellValueByColumnAndRow(2, $rowNumber, $row["firstname"]);
            $sheet->setCellValueByColumnAndRow(3, $rowNumber, $row["lastname"]);
            $sheet->setCellValueByColumnAndRow(4, $rowNumber, $row["gender"]);
            $sheet->setCellValueByColumnAndRow(5, $rowNumber, $row["email"]);
            $rowNumber++;
        }
        $result->close();
    } else {
        echo "<tr><td colspan='7'>No data found</td></tr>";
    }

    $conn->close();

    // Create XLSX writer
    $writer = new Xlsx($spreadsheet);

    // Save the file
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="staff.xlsx"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
}
