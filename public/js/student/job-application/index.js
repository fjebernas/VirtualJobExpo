$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.btn-delete-job-application', function (event) {
        event.preventDefault();

        $.ajax({
            type: 'DELETE',
            url: $(this).closest('span').attr('data-action-delete'),
            dataType: 'json',
            success: (data) => {
                $(this).closest('.job-application').remove();
                toast(data['report']);
                console.log(data);
            },
            error: function (data) {
                console.log(data);
            }
        });
    });

    let toast = (report) => {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: report,
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
    }
});