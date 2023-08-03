$(document).ready(function(event){
    document.querySelectorAll("ul.pagination > li").forEach(function (item){
       item.classList.add('btn', 'btn-outline-info');
    });
});

function saveSelection(selectElement) {
    var selectedValues = $(selectElement).val();

    // Send the selected values to the backend using AJAX
    $.ajax({
        url: '/hotel/onrequest', // Replace with the correct URL to your backend action
        type: 'POST',
        data: {
            selectedValues: selectedValues,
        },
        success: function(response) {
            // Handle the success response if needed
        },
        error: function(xhr, status, error) {
            // Handle the error response if needed
        }
    });
}