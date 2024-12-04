"use strict";

var KTUsersList = function () {
    // Define shared variables
    var table = document.getElementById('kt_table_users');
    var datatable;
    var toolbarBase;
    var toolbarSelected;
    var selectedCount;

    function convertDatetimeToFormattedString(datetime) {
        if (!datetime) return '';

        const dateObj = new Date(datetime);

        // Array nama bulan
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
            "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

        // Mendapatkan bagian-bagian tanggal dan waktu
        const day = String(dateObj.getDate()).padStart(2, '0');
        const month = monthNames[dateObj.getMonth()];
        const year = dateObj.getFullYear();

        const hours = String(dateObj.getHours()).padStart(2, '0');
        const minutes = String(dateObj.getMinutes()).padStart(2, '0');

        // Format akhir
        return `${day} ${month} ${year} ${hours}:${minutes}`;
    }

    function convertToDate(dateString) {
        // Array nama bulan
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
            "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

        // Memisahkan tanggal, bulan, tahun, jam, dan menit
        const [day, month, year, time] = dateString.split(" ");
        const [hour, minute] = time.split(":");

        // Menemukan bulan (dalam angka)
        const monthIndex = monthNames.indexOf(month);

        // Membuat objek Date
        const date = new Date(year, monthIndex, day, hour, minute);

        // Mengonversi ke format ISO (YYYY-MM-DDTHH:MM)
        const isoString = date // Mengambil bagian sampai menit

        return isoString;
    }

    function stripTags(input) {
        var doc = new DOMParser().parseFromString(input, 'text/html');
        return doc.body.textContent || doc.body.innerText || "";
    }
    function removeExtraSpaces(str) {
        return str.replace(/\s+/g, ' ').trim();
    }

    // Private functions
    var initUserTable = function () {
        // Set date data order
        const tableRows = table.querySelectorAll('tbody tr');

        // tableRows.forEach(row => {
        //     const dateRow = row.querySelectorAll('td');
        //     const lastLogin = dateRow[3].innerText.toLowerCase(); // Get last login time
        //     let timeCount = 0;
        //     let timeFormat = 'minutes';

        //     // Determine date & time format -- add more formats when necessary
        //     if (lastLogin.includes('yesterday')) {
        //         timeCount = 1;
        //         timeFormat = 'days';
        //     } else if (lastLogin.includes('mins')) {
        //         timeCount = parseInt(lastLogin.replace(/\D/g, ''));
        //         timeFormat = 'minutes';
        //     } else if (lastLogin.includes('hours')) {
        //         timeCount = parseInt(lastLogin.replace(/\D/g, ''));
        //         timeFormat = 'hours';
        //     } else if (lastLogin.includes('days')) {
        //         timeCount = parseInt(lastLogin.replace(/\D/g, ''));
        //         timeFormat = 'days';
        //     } else if (lastLogin.includes('weeks')) {
        //         timeCount = parseInt(lastLogin.replace(/\D/g, ''));
        //         timeFormat = 'weeks';
        //     }

        //     // Subtract date/time from today -- more info on moment datetime subtraction: https://momentjs.com/docs/#/durations/subtract/
        //     const realDate = moment().subtract(timeCount, timeFormat).format();

        //     // Insert real date to last login attribute
        //     dateRow[3].setAttribute('data-order', realDate);

        //     // Set real date for joined column
        //     const joinedDate = moment(dateRow[5].innerHTML, "DD MMM YYYY, LT").format(); // select date from 5th column in table
        //     dateRow[5].setAttribute('data-order', joinedDate);
        // });

        // Init datatable --- more info on datatables: https://datatables.net/manual/
        datatable = $(table).DataTable({
            "info": false,
            'order': [],
            "pageLength": 10,
            "lengthChange": false,
            'columnDefs': [
                { orderable: false, targets: 0 }, // Disable ordering on column 0 (checkbox)
                // { orderable: false, targets: 9 }, // Disable ordering on column 9 (actions)
            ]
        });

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        datatable.on('draw', function () {
            initToggleToolbar();
            handleDeleteRows();
            toggleToolbars();
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-user-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }

    var datatable_date_filter = [];

    // Filter Datatable
    var handleFilterDatatable = () => {
        // Select filter options
        const filterForm = document.querySelector('[data-kt-user-table-filter="form"]');
        const filterButton = filterForm.querySelector('[data-kt-user-table-filter="filter"]');

        const start_exams = filterForm.querySelector('[data-kt-user-table-filter="start_exams"]');
        const end_exams = filterForm.querySelector('[data-kt-user-table-filter="end_exams"]');

        const selectOptions = filterForm.querySelectorAll('select');

        // Filter datatable on submit
        filterButton.addEventListener('click', function () {
            var filterString = '';

            // Get filter values
            selectOptions.forEach((item, index) => {
                if (item.value && item.value !== '') {
                    if (index !== 0) {
                        filterString += ' ';
                    }

                    // Build filter value options
                    filterString += item.value;
                }
            });
            // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
            datatable.search(filterString).draw();

            // 03 Dec 2024 07:30 <br> s/d <br> 03 Dec 2024 09:00"
            var startDate = start_exams.value ? new Date(start_exams.value) : 0;
            var endDate = end_exams.value ? new Date(end_exams.value) : 0;

            console.log(startDate, endDate);



            var data_columns2 = [];
            datatable.columns(2).data().each(function (value, index) {
                data_columns2 = data_columns2.concat(value);

            });

            data_columns2.forEach(function (value, index) {
                var result = stripTags(value);
                var result = removeExtraSpaces(result);

                var [start, end] = result.replace('Sedang Berlangsung ', '').replace('Selesai ', '').replace('Terjadwal ', '').split(' s/d ');
                start = convertToDate(start);
                end = convertToDate(end);

                datatable_date_filter.push({
                    id: index,
                    start: start,
                    end: end
                });

            });

            console.log(datatable_date_filter);

            var removeIndex = [];

            datatable_date_filter.map(function (value, index) {
                if (startDate !== 0 && endDate !== 0) {
                    if (value.start < startDate || value.end > endDate) {
                        removeIndex.push(value.id);
                    }
                }

                if (startDate !== 0 && endDate === 0) {
                    if (value.start < startDate) {
                        removeIndex.push(value.id);
                    }
                }

                if (startDate === 0 && endDate !== 0) {
                    if (value.end > endDate) {
                        removeIndex.push(value.id);
                    }
                }

            });

            console.log(removeIndex);

            // datatable.rows(function (idx, data, node) {
            //     return removeIndex.includes(idx);
            // }).remove().draw();

            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    if (removeIndex.includes(dataIndex)) {
                        return false;
                    }
                    return true;
                }
            );
            datatable.draw();

        });
    }

    // Reset Filter
    var handleResetForm = () => {
        // Select reset button
        const resetButton = document.querySelector('[data-kt-user-table-filter="reset"]');

        // Reset datatable
        resetButton.addEventListener('click', function () {
            // Select filter options
            const filterForm = document.querySelector('[data-kt-user-table-filter="form"]');
            var startexams = filterForm.querySelector('[data-kt-user-table-filter="start_exams"]')
            var endexams = filterForm.querySelector('[data-kt-user-table-filter="end_exams"]')
            const selectOptions = filterForm.querySelectorAll('select');

            // Reset select2 values -- more info: https://select2.org/programmatic-control/add-select-clear-items
            selectOptions.forEach(select => {
                $(select).val('').trigger('change');
            });

            if (startexams.value || endexams.value) {
                startexams.value = '';
                endexams.value = '';
                $.fn.dataTable.ext.search.pop();
                datatable.draw();

            }

            // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
            datatable.search('').draw();
        });
    }


    // Delete subscirption
    var handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = table.querySelectorAll('[data-kt-users-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get user name
                const userName = parent.querySelectorAll('td')[1].querySelectorAll('a')[1].innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete " + userName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        Swal.fire({
                            text: "You have deleted " + userName + "!.",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        }).then(function () {
                            // Remove current row
                            datatable.row($(parent)).remove().draw();
                        }).then(function () {
                            // Detect checked checkboxes
                            toggleToolbars();
                        });
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: customerName + " was not deleted.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        });
                    }
                });
            })
        });
    }

    // Init toggle toolbar
    var initToggleToolbar = () => {
        // Toggle selected action toolbar
        // Select all checkboxes
        const checkboxes = table.querySelectorAll('[type="checkbox"]');

        // Select elements
        toolbarBase = document.querySelector('[data-kt-user-table-toolbar="base"]');
        toolbarSelected = document.querySelector('[data-kt-user-table-toolbar="selected"]');
        selectedCount = document.querySelector('[data-kt-user-table-select="selected_count"]');
        const deleteSelected = document.querySelector('[data-kt-user-table-select="delete_selected"]');

        // Toggle delete selected toolbar
        checkboxes.forEach(c => {
            // Checkbox on click event
            c.addEventListener('click', function () {
                setTimeout(function () {
                    toggleToolbars();
                }, 50);
            });
        });

        // Deleted selected rows
        deleteSelected.addEventListener('click', function () {
            // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
            Swal.fire({
                text: "Are you sure you want to delete selected customers?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then(function (result) {
                if (result.value) {
                    Swal.fire({
                        text: "You have deleted all selected customers!.",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    }).then(function () {
                        // Remove all selected customers
                        checkboxes.forEach(c => {
                            if (c.checked) {
                                datatable.row($(c.closest('tbody tr'))).remove().draw();
                            }
                        });

                        // Remove header checked box
                        const headerCheckbox = table.querySelectorAll('[type="checkbox"]')[0];
                        headerCheckbox.checked = false;
                    }).then(function () {
                        toggleToolbars(); // Detect checked checkboxes
                        initToggleToolbar(); // Re-init toolbar to recalculate checkboxes
                    });
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Selected customers was not deleted.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    });
                }
            });
        });
    }

    // Toggle toolbars
    const toggleToolbars = () => {
        // Select refreshed checkbox DOM elements
        const allCheckboxes = table.querySelectorAll('tbody [type="checkbox"]');

        // Detect checkboxes state & count
        let checkedState = false;
        let count = 0;

        // Count checked boxes
        allCheckboxes.forEach(c => {
            if (c.checked) {
                checkedState = true;
                count++;
            }
        });

        // Toggle toolbars
        // if (checkedState) {
        //     selectedCount.innerHTML = count;
        //     toolbarBase.classList.add('d-none');
        //     toolbarSelected.classList.remove('d-none');
        // } else {
        //     toolbarBase.classList.remove('d-none');
        //     toolbarSelected.classList.add('d-none');
        // }
    }

    return {
        // Public functions
        init: function () {
            if (!table) {
                return;
            }

            initUserTable();
            initToggleToolbar();
            handleSearchDatatable();
            handleResetForm();
            handleDeleteRows();
            handleFilterDatatable();


        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTUsersList.init();
});
