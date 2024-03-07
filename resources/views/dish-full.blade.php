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
        @extends('layouts.card-info-image')
        @section('img', '../img/' . $dish->dish_image)
        @section('content')

            <div class="dish-data flex flex-col gap-8 w-100 p-2">
               <p><span class="text-2xl font-bold">{{$dish->dish_name}}</span> <span class="text-xl">({{$dish->quantity}}g)</span></p>
               <p>{{$dish->dish_description}}</p>
               <div class="mt-6 nutrients flex w-100 justify-around flex-wrap bg-green-100 rounded">
                    <div class="text-num-col">
                        <p>{{$dish->calories}}g</p>
                        <p>Calorías</p>
                    </div>
                    <div class="text-num-col">
                        <p>{{$dish->proteins}}g</p>
                        <p>Proteínas</p>
                    </div>
                    <div class="text-num-col">
                        <p>{{$dish->carbohydrates}}g</p>
                        <p>Carbohidratos</p>
                    </div>
                    <div class="text-num-col">
                        <p>{{$dish->fats}}g</p>
                        <p>Grasas</p>
                    </div>

               </div>
               <p class="text-2xl font-bold mt-10">{{$dish->dish_price}}€</p>
            </div>


        @endsection



</body>

</html>
