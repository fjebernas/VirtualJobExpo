$(function () {
    $('#form-submit').on('submit', (e) => {
        e.preventDefault();
        Swal.fire({
            title: 'Submit job application?',
            text: "Please double check all fields before submitting.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#c78100',
            cancelButtonColor: '#5630bd',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                $(e.target).unbind('submit').submit();
            }
        });
    });
});