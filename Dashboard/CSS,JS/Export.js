function fnExcelReport() {
    // Get the table element
    var tab = document.getElementById('headerTable');

    // Convert the table to a workbook
    var wb = XLSX.utils.table_to_book(tab);

    // Save the workbook as an Excel file
    XLSX.writeFile(wb, 'filename.xlsx');
}