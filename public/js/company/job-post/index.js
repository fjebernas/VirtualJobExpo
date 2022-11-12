$(document).ready(function () {
    $(document).on('change', '#select-status', function (event) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "PATCH",
            url: $(this).closest('form').attr('action'),
            data: {
                status: $(this).find(':selected').val()
            },
            dataType: 'json',
            success: function (data) {
                console.log(data);
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Updated job application status',
                    showConfirmButton: false,
                    timer: 2500
                });
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
});