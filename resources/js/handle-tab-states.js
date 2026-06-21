document.addEventListener('DOMContentLoaded', function () {

    if (typeof $ === 'undefined' || typeof jQuery === 'undefined') {
        return;
    }

    $('a[data-toggle="pill"], a[data-toggle="tab"], a[data-bs-toggle="pill"], a[data-bs-toggle="tab"]').on('show.bs.tab', function (e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });

    var activeTab = localStorage.getItem('activeTab');

    if (activeTab) {
        $('.nav a[href="' + activeTab + '"]').tab('show');
    }


    $(function () {

        $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
            localStorage.setItem('lastTab', $(this).attr('href'));
        });
        var lastTab = localStorage.getItem('lastTab');

        if (lastTab) {
            $('[href="' + lastTab + '"]').tab('show');
        }

    });

    $(window).on('resize', function () {
        if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
    })
    $(window).on('resize', function () {
        if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
    })

});
