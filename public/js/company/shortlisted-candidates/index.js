
$(function () {
    $(document).on('click', '.btn-send-invitation', function (event) {
        $('#sending-invitation-loader').fadeIn();
        $('#sending-invitation-loader').addClass('d-flex justify-content-center align-items-center flex-column');

        $(this).closest('form').trigger('submit');
    });
});