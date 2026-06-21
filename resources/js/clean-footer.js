document.addEventListener('DOMContentLoaded', function () {
    if (typeof $ === 'undefined' || typeof jQuery === 'undefined') {
        return;
    }

    $.fn.modal.Constructor.prototype._enforceFocus = function () { };

    $(function () {

        $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
            localStorage.setItem('lastTab', $(this).attr('href'));
        });
        var lastTab = localStorage.getItem('lastTab');

        if (lastTab) {
            $('[href="' + lastTab + '"]').tab('show');
        }

    });

    $(function () {

        $('a[data-toggle="tab"], a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            localStorage.setItem('lastTab', $(this).attr('href'));
        });
        var lastTab = localStorage.getItem('lastTab');

        if (lastTab) {
            $('[href="' + lastTab + '"]').tab('show');
        }

    });

    $('#start_date,#end_date,.datepicker').datepicker()

    $('#start_date,#end_date,.datepicker').on('change', function (event) {
        event.preventDefault();
        $(this).datepicker('hide')
    });

    function print_popup(url) {
        window.open(url, 'popupWindow', 'height=900,width=600,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes');
    }

    $('#activity_type').on('change', function (event) {
        event.preventDefault();
        if ($(this).val() === 'break' || $(this).val() === 'leave') {
            $('#destination').prop('readonly', false)
        } else if ($(this).val() === 'attendance') {
            $('#destination').prop('readonly', true)
            $('#destination').val('N/A')
        }
    });

    $('#clock_in_frm').on('submit', function (event) {
        event.preventDefault();
        bootbox.confirm("Record Attendance?", function (r) {
            if (r === true) {

                $.ajax({
                    url: '../serverscripts/admin/Employees/clock_in_frm.php',
                    type: 'GET',
                    data: $('#clock_in_frm').serialize(),
                    success: function (msg) {
                        if (msg === 'save_successful') {
                            bootbox.alert("Attendance recorded successfully", function () {
                                window.location.reload()
                            })
                        } else {
                            bootbox.alert(msg)
                        }
                    }
                }) //end ajax

            }
        })
    }); //end submit


    $('#activity_log_frm').one('submit', function (event) {
        event.preventDefault()
        bootbox.confirm("Log this activity?", function (r) {
            if (r === true) {
                $.ajax({
                    url: '../serverscripts/admin/activity_log_frm.php',
                    type: 'GET',
                    data: $('#activity_log_frm').serialize(),
                    success: function (msg) {
                        if (msg === 'save_successful') {
                            bootbox.alert('Activity logged successfully', function () {
                                window.location.reload()
                            })
                        } else {
                            bootbox.alert(msg)
                        }
                    }
                })
            }
        })
    });

}); // End DOMContentLoaded
