$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.btn-delete-job-application', (e) => {
        Swal.fire({
            title: 'Withdraw job application?',
            text: "You can always apply again if the job is still available.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#c78100',
            cancelButtonColor: '#5630bd',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'DELETE',
                    url: $(e.target).closest('span').attr('data-action-delete'),
                    dataType: 'json',
                    success: (data) => {
                        $(e.target).closest('.job-application').remove();
                        toast(data['report']);
                        console.log(data);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
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