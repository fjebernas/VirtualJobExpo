$(function () {
    $('.btn-brief-details').on('click', function () 
    {
        var jobPost = $(this).attr('data-job-post');
        fillDetails(JSON.parse(jobPost));
    });

    function fillDetails(jobPost) 
    {
        $('#position').text(jobPost['position']);
        $('#company').text(jobPost['company']['name']);
        $('#location').text(jobPost['location']);
        $('#level').text(jobPost['level']);
        $('#employment').text(jobPost['employment']);
        $('#salary_range').text(`${formatter.format(jobPost['salary_range']['low'])} 
                            to ${formatter.format(jobPost['salary_range']['high'])}`);
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.btn-delete-saved-job', function (event) {
        event.preventDefault();

        $.ajax({
            type: 'DELETE',
            url: $(this).closest('span').attr('data-action-delete'),
            dataType: 'json',
            success: (data) => {
                $(this).closest('.saved_job').remove();
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

    const formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'PHP',
        minimumFractionDigits: 0,
    });
});