function fnIndigencyReport() {
    var tab = document.getElementById('headerTable');

    var wb = XLSX.utils.table_to_book(tab);

    XLSX.writeFile(wb, 'indigency-report.xlsx');
}

function fnResidencyReport() {
    var tab = document.getElementById('headerTable');

    var wb = XLSX.utils.table_to_book(tab);

    XLSX.writeFile(wb, 'residency-report.xlsx');
}

function fnManageReport() {
    var tab = document.getElementById('headerTable');

    var wb = XLSX.utils.table_to_book(tab);

    XLSX.writeFile(wb, 'file.xlsx');
}
