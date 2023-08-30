function addToCart(itemId, redirectFlag){
    $.ajax({
        url: '../frontend/add-cart.php',
        type: 'POST',
        data: {itemId: itemId},
        success: function(response) {
            // Handle the response from the server if needed
            console.log(response);
            if(redirectFlag){
                window.location.href = 'order.php';
            }else{
                window.alert(response);
            }
          },
          error: function(xhr, status, error) {
            // Handle any errors that occurred during the AJAX request
            console.error(error);
        }
    });
}

function removeToCart(itemId){
    $.ajax({
        url: '../frontend/remove-cart.php',
        type: 'POST',
        data: {itemId: itemId},
        success: function(response) {
            // Handle the response from the server if needed
            console.log(response);
            window.location.href = 'order.php';
          },
          error: function(xhr, status, error) {
            // Handle any errors that occurred during the AJAX request
            console.error(error);
        }
    });
}