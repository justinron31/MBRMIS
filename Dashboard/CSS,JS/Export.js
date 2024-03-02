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

function fnJobseekerReport() {
    var tab = document.getElementById('headerTable');

    var wb = XLSX.utils.table_to_book(tab);

    XLSX.writeFile(wb, 'jobseeker-report.xlsx');
}

function fnResidentReport() {
    var tab = document.getElementById('headerTable');

    var wb = XLSX.utils.table_to_book(tab);

    XLSX.writeFile(wb, 'resident-report.xlsx');
}


function fnManageReport() {
    var tab = document.getElementById('headerTable');

    var wb = XLSX.utils.table_to_book(tab);

    XLSX.writeFile(wb, 'manage-user.xlsx');
}
