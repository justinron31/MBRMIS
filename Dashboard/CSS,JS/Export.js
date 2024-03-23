/** EXPORT TO EXCEL INDIGENCY REQUEST*/
function fnIndigencyReport() {
    var tab = document.getElementById('headerTable');

    var wb = XLSX.utils.table_to_book(tab);

    XLSX.writeFile(wb, 'indigency-report.xlsx');
}

/** EXPORT TO EXCEL RESIDENCY REQUEST*/
function fnResidencyReport() {
    var tab = document.getElementById('headerTable');

    var wb = XLSX.utils.table_to_book(tab);

    XLSX.writeFile(wb, 'residency-report.xlsx');
}

/** EXPORT TO EXCEL JOBSEEKER REQUEST*/
function fnJobseekerReport() {
    var tab = document.getElementById('headerTable');

    var wb = XLSX.utils.table_to_book(tab);

    XLSX.writeFile(wb, 'jobseeker-report.xlsx');
}

/** EXPORT TO EXCEL RESIDENT REPORT*/
function fnResidentReport() {
    var tab = document.getElementById('headerTable');

    var wb = XLSX.utils.table_to_book(tab);

    XLSX.writeFile(wb, 'resident-report.xlsx');
}

/** EXPORT TO EXCEL ALL REQUEST*/
function fnRequestAllReport() {
    var tab = document.getElementById('headerTable');

    var wb = XLSX.utils.table_to_book(tab);

    XLSX.writeFile(wb, 'all-request-report.xlsx');
}

/** EXPORT TO EXCEL MANAGE USER REPORT*/
function fnManageReport() {
    var tab = document.getElementById('headerTable');

    var wb = XLSX.utils.table_to_book(tab);

    XLSX.writeFile(wb, 'manage-user.xlsx');
}
