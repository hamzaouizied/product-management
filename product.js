$(document).ready(function(){
    // click on button submit
    $("#productForm").submit(function (event) {
        event.preventDefault();
        // send ajax
        $.ajax({
            url: 'product.php', // url where to submit the request
            type : "POST", // type of action POST || GET
            dataType : 'json', // data type
            data : $("#productForm").serialize(), // post data || get data
            success : function(data) {
                location.reload();

            },
            error: function(error) {
                console.log(error)
            }
        })
    });
});