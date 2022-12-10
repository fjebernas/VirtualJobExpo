
$(function () {
    $(document).on('click', '.btn-send-invitation', (e) => {

        var title;
        var text;

        // e.target.parentNode because e.target is the box icon
        if ($(e.target.parentNode).hasClass('invited')) {
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

                $(e.target).closest('form').trigger('submit');
            }
        });
    });
});