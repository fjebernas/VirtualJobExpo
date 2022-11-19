
$(function () {
    $(document).on('input', '#salary-range', function () {
        $('#range-value').text(formatter.format($(this).val()));
    });

    const formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'PHP',
        minimumFractionDigits: 0,
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.btn-saved-job', function (event) {
        event.preventDefault();

        let method;
        let url;
        let postData;

        if ($(this).hasClass('create')){
            method = 'POST';
            url = $(this).closest('span').attr('data-action-create');
            postData = {
                job_post_id: $(this).attr('value')
            };
        } 
        else if ($(this).hasClass('delete')){
            method = 'DELETE';
            url = $(this).closest('span').attr('data-action-delete');
            postData = {};
        }

        $.ajax({
            type: method,
            url: url,
            data: postData,
            dataType: 'json',
            success: (data) => {
                toggleProperties(this);
                toast(data['report']);
                console.log(data);
            },
            error: function (data) {
                console.log(data);
            }
        });
    });

    let toggleProperties = (element) => {
        $(element).toggleClass('create delete');
        $(element).toggleClass('btn-primary btn-danger');
        $(element).text(
            $(element).hasClass('create') ? 'Save' : 'Remove'
        );
    }

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