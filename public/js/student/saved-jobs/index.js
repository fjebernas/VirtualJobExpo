$(document).ready(function () 
{
    $('.btn-view-more-details').on('click', function () 
    {
        var jobPost = $(this).attr('data-job-post');
        fillDetails(JSON.parse(jobPost));
    });

    function fillDetails(jobPost) 
    {
        $('#position').text(jobPost['position']);
        $('#company').text(jobPost['company']);
        $('#location').text(jobPost['location']);
        $('#level').text(jobPost['level']);
        $('#employment').text(jobPost['employment']);
        $('#salary_range').text(`₱${jobPost['salary_range']['low']} to ${jobPost['salary_range']['high']}`);
    }
});