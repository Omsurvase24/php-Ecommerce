$(document).ready(function () {
  $(document).on('click', '.increment-btn', function (e) {
    e.preventDefault();

    var qty = $(this).closest('.product_data').find('.product-qty').val();

    var value = parseInt(qty);
    value = isNaN(value) ? 1 : value; // if user changed the value of qty input box using inspect and set it to value other than number, then it will assign 1 as value of that qty input box

    if (value < 10) {
      value++;
      $(this).closest('.product_data').find('.product-qty').val(value);
    }
  });

  $(document).on('click', '.decrement-btn', function (e) {
    e.preventDefault();

    var qty = $(this).closest('.product_data').find('.product-qty').val();

    var value = parseInt(qty);
    value = isNaN(value) ? 0 : value;

    if (value > 1) {
      value--;
      $(this).closest('.product_data').find('.product-qty').val(value);
    }
  });

  $(document).on('click', '.add-to-cart-btn', function (e) {
    e.preventDefault();

    var qty = $(this).closest('.product_data').find('.product-qty').val();
    var price = $(this)
      .closest('.product_data')
      .find('.product-selling-price')
      .val();
    var product_id = $(this).val();

    $.ajax({
      method: 'POST',
      url: 'functions/handlecart.php',
      data: {
        product_id: product_id,
        product_qty: qty,
        price: price,
        scope: 'add',
      },
      success: function (response) {
        console.log(response);
        if (response == 201) {
          alertify.success('Product added to cart.');
        } else if (response == 'existing') {
          alertify.error('Product already in the cart.');
        } else if (response == 401) {
          alertify.error('Login to continue.');
        } else if (response == 500) {
          alertify.error('Something went wrong. Please try again.');
        }
      },
    });
  });

  $(document).on('click', '.update_qty', function (e) {
    e.preventDefault();

    var qty = $(this).closest('.product_data').find('.product-qty').val();
    var product_id = $(this).closest('.product_data').find('.product_id').val();

    $.ajax({
      method: 'POST',
      url: 'functions/handlecart.php',
      data: {
        product_id: product_id,
        product_qty: qty,
        scope: 'update',
      },
      success: function (response) {
        console.log(response);
        if (response == 401) {
          alertify.error('Login to continue.');
        } else if (response == 500) {
          alertify.error('Something went wrong. Please try again.');
        }
      },
    });
  });

  $(document).on('click', '.delete_product', function (e) {
    e.preventDefault();

    var cart_id = $(this).val();

    $.ajax({
      method: 'POST',
      url: 'functions/handlecart.php',
      data: {
        cart_id: cart_id,
        scope: 'delete',
      },
      success: function (response) {
        console.log(response);
        if (response == 200) {
          alertify.success('Product removed from cart.');
          $('#cart').load(location.href + ' #cart');
        } else if (response == 401) {
          alertify.error('Login to continue.');
        } else if (response == 500) {
          alertify.error('Something went wrong. Please try again.');
        }
      },
    });
  });
});
