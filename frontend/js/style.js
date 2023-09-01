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
    let formEl = document.getElementById('formOrder');
    let qty = formEl.querySelectorAll('input[name="qty"], input[name="id"]');
    const orderObject = {
        listFood: [],
        userInfor: [

        ]
    }
    for(let i =0; i < qty.length; i+=2){
        let obj = {
            id: qty[i].value,
            qty: qty[i+1].value
        }
        orderObject.listFood.push(obj);
    }
    let userInfoEl = document.querySelector('#user-infor');
    let listInfor = userInfoEl.querySelectorAll('input[name="full-name"],input[name="contact"],input[name="email"],textarea[name="address"]')
    let user ={
        fullname: listInfor[0].value,
        contact: listInfor[1].value,
        email: listInfor[2].value,
        address: listInfor[3].value
    }
    orderObject.userInfor.push(user);
    $.ajax({
        url: '../frontend/order-process.php',
        type: 'POST',
        data: {data:orderObject},
        success: function(response) {
            // Handle the response from the server if needed
            window.location.href = 'order-sucess.php';
          },
          error: function(xhr, status, error) {
            // Handle any errors that occurred during the AJAX request
            console.error(error);
        }
    });
    
}