const search = document.querySelector('.input-group input'),
    table_rows = document.querySelectorAll('tbody tr'),
    table_headings = document.querySelectorAll('thead th');

// 1. Searching for specific data of HTML table
search.addEventListener('input', searchTable);

function searchTable() {
    table_rows.forEach((row, i) => {
        let table_data = row.textContent.toLowerCase(),
            search_data = search.value.toLowerCase();

        row.classList.toggle('hide', table_data.indexOf(search_data) < 0);
        row.style.setProperty('--delay', i / 25 + 's');
    })

    document.querySelectorAll('tbody tr:not(.hide)').forEach((visible_row, i) => {
        visible_row.style.backgroundColor = (i % 2 == 0) ? 'transparent' : '#0000000b';
    });
}



// 2. Sorting | Ordering data of HTML table

table_headings.forEach((head, i) => {
    let sort_asc = true;
    head.onclick = () => {
        table_headings.forEach(head => head.classList.remove('active'));
        head.classList.add('active');

        document.querySelectorAll('td').forEach(td => td.classList.remove('active'));
        table_rows.forEach(row => {
            row.querySelectorAll('td')[i].classList.add('active');
        })

        head.classList.toggle('asc', sort_asc);
        sort_asc = head.classList.contains('asc') ? false : true;

        sortTable(i, sort_asc);
    }
})


function sortTable(column, sort_asc) {
    [...table_rows].sort((a, b) => {
        let first_row = a.querySelectorAll('td')[column].textContent.toLowerCase(),
            second_row = b.querySelectorAll('td')[column].textContent.toLowerCase();

        return sort_asc ? (first_row < second_row ? 1 : -1) : (first_row < second_row ? -1 : 1);
    })
        .map(sorted_row => document.querySelector('tbody').appendChild(sorted_row));
}


/*EXPORT BUTTON POPUP*/

function togglePopup() {
    var popup = document.getElementById("popupEX");
    if (popup.style.display === "none" || popup.style.display === "") {
        popup.style.display = "block";
        // Add event listener to close the popup when clicking anywhere on the screen
        document.addEventListener("click", closePopupOutside);
    } else {
        popup.style.display = "none";
    }
}

// Function to close the popup when clicking outside of it
function closePopupOutside(event) {
    var popup = document.getElementById("popupEX");
    var button = document.querySelector('.export__file-btn');

    if (!popup.contains(event.target) && !button.contains(event.target)) {
        popup.style.display = "none";
        // Remove the event listener after closing the popup
        document.removeEventListener("click", closePopupOutside);
    }
}


/*FORM ACCOUNT STATUS EDIT*/
function openCustomModal(userId, currentStatus) {
    $('#customUserId').val(userId);
    $('#customStatus').val(currentStatus);
    $('#customEditModal').css('display', 'block');
}

function closeCustomModal() {
    $('#customEditModal').css('display', 'none');
}

$(document).ready(function () {
    $('#customEditForm').submit(function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Serialize the form data
        var formData = $(this).serialize();

        // Send an AJAX request to updateAstatus.php
        $.ajax({
            type: 'POST',
            url: '/MBRMIS/Php/updateAstatus.php',
            data: formData,
            dataType: 'json', // Specify that you expect JSON in the response
            success: function (data) {
                // Check the status in the response
                if (data.status === 'success') {
                    // Update the status in the table using DOM manipulation
                    var userId = $('#customUserId').val();
                    var newStatus = data.data.account_status;
                    $('.status_' + userId).text(newStatus);

                    // Close the modal
                    closeCustomModal();

                    // Show a custom success popup
                    showCustomPopup(data.message);
                } else {
                    // Show a custom error popup
                    showCustomPopup(data.message);
                }
            },
            error: function (error) {
                console.log('Error updating status: ', error);

                // Show a custom error popup
                showCustomPopup('Error updating account status');
            }
        });
    });
});

// Function to show a custom popup
function showCustomPopup(message) {
    var popupContainer = $('<div class="custom-popup"></div>').text(message);
    $('body').append(popupContainer);

    // Display the popup and remove it after a certain time
    popupContainer.fadeIn(300).delay(2500).fadeOut(300, function () {
        $(this).remove();
    });
}


