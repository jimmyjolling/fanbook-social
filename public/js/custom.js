$(function () {

    

    // Get the output text
    var text = document.getElementById("relation");

    text.style.display = "none";

    $('#relation_status').click(function() {
        // If the checkbox is checked, display the output text
        if ($('#relation_status').is(':checked')){
            text.style.display = "block";
        } else {
            text.style.display = "none";
        }
    })
    
    
});