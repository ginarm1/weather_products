<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap core CSS -->
    <link href = {{ asset("bootstrap/css/bootstrap.css") }} rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href = {{ asset("bootstrap/css/sticky-footer-navbar.css") }} rel="stylesheet" />

    <title>Weather Products</title>

</head>
<body>
    <div class="container">
        <h2>Products for the weather</h2>

        @foreach($products as $product)
            <p>Product SKU: {{$product->sku}}</p>
            <p>Product name: {{$product->name}}</p>
            <p>Cost: {{$product->cost}}</p>
        @endforeach
    </div>
</body>
</html>
