
$(function () {
    $(document).on('click', '.btn-send-invitation', function(e) {

        var title;
        var text;

        if ($(this).hasClass('invited')) {
            title = 'Send again?';
            text = 'Candidate already invited through email.';
        } else {
            title = 'Send invitation email?';
            text = "Invitation email is sent to the candidate's email.";
        }

        Swal.fire({
            title: title,
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#c78100',
            cancelButtonColor: '#5630bd',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#sending-invitation-loader').fadeIn();
                $('#sending-invitation-loader').addClass('d-flex justify-content-center align-items-center flex-column');

                $(this).closest('form').trigger('submit');
            }
        });
    });
});