$(document).ready(function() {
    $('#formSubmit').on('submit', function(e) {
        e.preventDefault();

        var $submitButton = $(this).find('button[type="submit"]');
        var $spinner ='<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';

        // Disable the button and add the spinner
        $submitButton.prop('disabled', true).html($spinner);

        // Create FormData object from the form
        var formData = new FormData(this); // 'this' refers to the form element
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting contentType (we let the browser set it)
            success: function(response) {
                // Handle success response
                if (response.success) {
                    alert(response.message);
                    // Clear the form
                    if(response.redirect) {
                        window.location.href = response.redirect;   
                    }
                } else {
                    // Handle validation errors
                    // First, remove any existing validation errors
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').remove();

                    // Then, add the new validation errors
                    $.each(response.errors, function(key, value) {
                        var $input = $('[name="' + key + '"]');
                        $input.addClass('is-invalid');
                        $input.after('<span class="invalid-feedback">' + value + '</span>');
                    });
                }
            },
            error: function(xhr, status, error) {
                // Handle error response
                alert('Form submission failed: ' + error);
            },
            complete: function() {
                // Re-enable the button and remove the spinner
                $submitButton.prop('disabled', false).html('Submit');
            }
        });
    });
});



$('#document').on('change', function(e) {
    var fileInput = $(this);
    var files = fileInput[0].files;
    var validFileTypes = ['image/jpeg','image/jpg','image/png', 'image/gif', 'application/pdf'];
    var maxSize = 20 * 1024 * 1024; // 20 MB

    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        if ($.inArray(file.type, validFileTypes) === -1) {
            alert('Invalid file type. Only images and PDFs are allowed.');
            fileInput.val(''); // Clear the input
            break;
        } else if (file.size > maxSize) {
            alert('File size must be less than 20 MB.');
            fileInput.val(''); // Clear the input
            break;
        }
    }
});
