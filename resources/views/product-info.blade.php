<!DOCTYPE html>
<html lang="800px !important">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/components/product-full.css'])
</head>
<body>
    <x-navbar></x-navbar>
    <x-shoping-cart-modal></x-shoping-cart-modal>
    <main>
        <x-card-info :array="$product" img=1 :exceptions="['user_id', 'created_at', 'updated_at', 'user_product_id', 'user_product_image']"></x-card-info>
    </main>


</body>
</html>
