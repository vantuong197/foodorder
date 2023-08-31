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

function sendDataToServer(e){
    e.preventDefault();
    let formEl = document.querySelector('#formOrder');
    let qty = formEl.querySelectorAll('input[name="qty"], input[name="id"]');
    const orderObject = {}
    for(let i =0; i < qty.length; i+=2){
        orderObject[qty[i].value] = qty[i+1].value;
    }
}