$(function() {
    apiroute = "/api/v2/"
    $.post(apiroute + "panier",
        function(data, textStatus, jqXHR) {
            console.log(data)
        },
        "dataType"
    );
    $.ajax({
        type: "DELETE",
        url: apiroute + "panier",
        data: "data",
        dataType: "dataType",
        success: function(response) {
            console.log(response)
        }
    });
})