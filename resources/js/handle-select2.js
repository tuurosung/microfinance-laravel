document.addEventListener('DOMContentLoaded', function () {

    initializeSelect2()

    /**
     * Initializes select2 elements with the class 'select2-inputs'
     */
    function initializeSelect2() {
        $('.select2-input').each(function () {
            if (!$(this).data('select2')) {
                $(this).select2({
                    placeholder: 'Select an option',
                    dropdownParent: $(this).parent(),
                });
            }
        });
    }

});
