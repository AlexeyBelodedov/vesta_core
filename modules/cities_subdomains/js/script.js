(function ($) {
    $(document).ready(function () {
        $('select#cities-select').change(function(){
            window.location.href = $(this).val();
        });
    });
})(jQuery);

