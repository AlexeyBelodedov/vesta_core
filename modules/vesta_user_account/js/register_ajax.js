(function ($, Drupal) {

    'use strict';

    Drupal.behaviors.registerAjax = {
        attach: function (context) {
            // Attach AJAX behavior to the user registration form.
            $('#user-register-form', context).once('vesta-user-account-ajax').each(function () {
                var form = $(this);
                var submitButton = form.find('input[type="submit"]');

                // Submit the form via AJAX.
                submitButton.click(function (event) {
                    event.preventDefault();
                    var formData = form.serialize();
                    var url = form.attr('action');

                    $.ajax({
                        url: url,
                        data: formData,
                        type: 'post',
                        dataType: 'json',
                        success: function (response) {
                            // Replace the form with the response.
                            form.replaceWith(response.form);

                            // Display a success message.
                            if (response.message) {
                                $('#register-message').html(response.message);
                            }
                        },
                        error: function (xhr, status, error) {
                            // Replace the form with the response.
                            form.replaceWith(xhr.responseText);
                        }
                    });
                });
            });
        }
    };

})(jQuery, Drupal);