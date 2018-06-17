<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Coalition test</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script>
        function saveProduct(){
            $.ajax({
               type:'POST',
               url:'/save_product',
               data:{_token: '<?php echo csrf_token() ?>',
               product_name: $('#product_name').val(),
               quantity_in_stock: $('#quantity_in_stock').val(),
               price_per_item: $('#price_per_item').val()},
               success: function (data) {
                  $("#message").html("<div class='confirmation'>" + $('#product_name').val() + " was saved</div>");
                  let jsonLine = JSON.parse(data.json_line);
                  $('#product_log tr:last').after(`<tr><td>${jsonLine.product_name}</td><td>${jsonLine.quantity_in_stock}</td><td>${jsonLine.price_per_item}</td><td>${jsonLine.datetime_submitted}</td><td>${jsonLine.total_value_number}</td></tr>`);
                  $('#product_name').val('');
                  $('#quantity_in_stock').val('');
                  $('#price_per_item').val('');
               },
               error: function (jqXHR, textStatus, errorThrown) {
                 //console.log ("error: " + errorThrown + " - " + jqXHR.responseJSON.message);
                 $("#message").html("<div class='alert'>"  + jqXHR.responseJSON.message + "</div>");
               }
            });
         }

         $(document).ready(function () {
           $('#save-btn').click(function () {
             $("#message").html('&nbsp;');
             if ($('#product_name').val() != '' && $("#quantity_in_stock") != '' && $("#price_per_item") != ''){
               saveProduct();
             } else {
               $("#message").html("<div class='alert'>All fields are required</div>");
             }
           });
         });
       </script>


        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            input[type="text"] {
              width: 80%;
            }

            input[type=button], input[type=reset] {
              border: none;
              font-size: 11px;
              line-height: 22px;
              font-weight: 500;
              text-transform: uppercase;
              color: white;
              background-color: #325d88;
              border-color: transparent;
              display: inline-block;
              margin-bottom: 0;
              font-weight: normal;
              text-align: center;
              vertical-align: middle;
              touch-action: manipulation;
              cursor: pointer;
              background-image: none;
              border: 1px solid transparent;
              white-space: nowrap;
              padding: 12px 16px;
              font-size: 14px;
              line-height: 1.428571429;
              border-radius: 4px;
              -webkit-user-select: none;
              -moz-user-select: none;
              -ms-user-select: none;
              user-select: none;
            }

            input[type=reset] {
              background-color: #3e3f3a;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
              width: 60%;
              margin: auto auto;
            }

            fieldset {
              margin: 10px;
              text-align: left;
            }

            input {
              margin-bottom: 10px;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 60px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .center {
              text-align: center;
            }

            .alert {
              color: red;
            }

            .confirmation {
              color: green;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md">
                    Coalition test
                </div>

                <fieldset>
                  <form>
                    <div id="message">&nbsp;</div>
                    <label for="product_name">Product Name</label><br>
                    <input type="text" name="product_name" id="product_name" placeholder="Product name" value=""><br>
                    <label for="quantity_in_stock">Quantity in Stock</label><br>
                    <input type="text" name="quantity_in_stock" id="quantity_in_stock" placeholder="Quanity in stock" value=""><br>
                    <label for="price_per_item">Price per Item</label><br>
                    <input type="text" name="price_per_item" id="price_per_item" placeholder="Price per item" value="">
                    <div class="center"><input type="button" value="Save" class="save-btn" id="save-btn"> <input type="reset" value="clear" class="reset-btn" id="reset-btn"></div><br><br>
                    <table id="product_log" style="width:100%;">
                      <thead><tr><th>Product Name</th><th>Quantity in Stock</th><th>Price per Item</th><th>Date time Submitted</th><th>Total Value Number</th></tr></thead>
                      <tbody></tbody>
                    </table>
            </div>
        </div>
    </body>
</html>
