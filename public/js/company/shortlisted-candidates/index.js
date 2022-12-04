
$(function () {
    $(document).on('click', '.btn-send-invitation', (e) => {
        Swal.fire({
            title: 'Send invitation email?',
            text: "Invitation email is sent to the candidate's email.",
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