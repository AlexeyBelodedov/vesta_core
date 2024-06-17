(function ($) {
    $(document).ready(function () {
        function scrollToTopAuth() {
            $('html, body').animate({scrollTop: 0}, 0);
        }

        $('.user-auth-block .user-auth-wrapper .user-auth').removeClass('disable-form');
        var pass_form = $('.user-auth-block .user-auth-wrapper .user-auth-password');
        pass_form.addClass('disable-form');

        var tab = $('.user-auth-block .user-auth-wrapper .user-auth .user-auth-content .tabs-item'),
            tab_link = $('.user-auth-block .user-auth-wrapper .user-auth .user-auth-toggle a.tab-target'),
            remember_link = $('.user-auth-block .user-auth-wrapper .user-auth .user-auth-content .tabs-item .user-login-form .remember-passwd .link-passwd a');

        tab.filter(':not(:first)').addClass('disable-tab');
        tab.filter(':first').addClass('enable-tab');

        // Клики по вкладкам.
        tab_link.click(function(){
            //window.location.hash = this.hash;
            scrollToTopAuth();
            tab.removeClass('disable-tab')
                .removeClass('enable-tab');
            tab.addClass('disable-tab');

            pass_form.removeClass('disable-form');
            pass_form.removeClass('enable-form');
            pass_form.addClass('disable-form');

            tab.filter(this.hash).addClass('enable-tab');
            tab_link.removeClass('active-tab');
            $(this).addClass('active-tab');
            return false;
        }).filter(':first').click();

        // форма восстановления пароля
        remember_link.click(function(){
            //window.location.hash = this.hash;
            scrollToTopAuth();
            pass_form.removeClass('disable-form')
                .addClass('enable-form');
            $('.user-auth-block .user-auth-wrapper .user-auth').removeClass('enable-form')
                .addClass('disable-form');
            return false;
        });

        $('.user-auth-block .user-auth-wrapper .user-auth-password .back-form-btn a').click(function(){
            scrollToTopAuth();
            pass_form.removeClass('enable-form')
                .addClass('disable-form');
            $('.user-auth-block .user-auth-wrapper .user-auth').removeClass('disable-form')
                .addClass('enable-form');
            if(tab_link.hasClass('active-tab')){
                //window.location.hash = this.hash;
            }
            return false;
        });

        // Клики по якорным ссылкам.
        $('.user-auth-block .user-auth-wrapper .user-auth .user-auth-toggle a.tab-target').click(function(){
            if (!$(this).hasClass('active-tab')) {
                $('.user-auth-block .user-auth-wrapper .user-auth .user-auth-toggle a.tab-target[href="' + $(this).attr('href') + '"]').click();
                //window.location.hash = this.hash;
                scrollToTopAuth();
            }
        });
    });
})(jQuery);

