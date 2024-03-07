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
        <x-card-info :array="$dish" img=0 :exceptions="['created_at', 'updated_at', 'user_dish_id', 'user_id', 'user_recipe_id']"></x-card-info>
    </main>


</body>
</html>
