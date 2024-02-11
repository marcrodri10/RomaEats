

<div style="width: {{ $width }};" class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <h1 class="text-3xl text-center">Personaliza tus comida en 3 sencillos pasos</h1>
    <div class="steps flex flex-col md:flex-row justify-center">
        <div class="step flex flex-col justify-center items-center lg:w-1/3 md:w-100 gap-5">
            <div class="img h-50 flex justify-center items-center w-100">
                <img src="{{URL::to('img/step1.svg')}}" alt="shop-cart" class="h-50 md:w-auto w-20">
            </div>
            <h2 class="text-lg text-center h-25 flex items-start">1. Añade los alimentos a tu lista de productos</h2>
        </div>
        <div class="step flex flex-col justify-center items-center lg:w-1/3 md:w-100 gap-5">
            <div class="img h-50 flex justify-center items-center w-100">
                <img src="{{URL::to('img/step2.svg')}}" alt="recipe" class="h-50 md:w-auto w-20">
            </div>
            <h2 class="text-lg text-center h-25 flex items-start">2. Crea tu propia receta y personalízala</h2>
        </div>
        <div class="step flex flex-col justify-center items-center lg:w-1/3 md:w-100 gap-5">
            <div class="img h-50 flex justify-center items-center w-100">
                <img src="{{URL::to('img/step3.svg')}}" alt="calendar" class="h-50 md:w-auto w-20">
            </div>
            <h2 class="text-lg text-center h-25 flex items-start"class="text-lg h-25 flex items-center">3. Escoge la fecha en la que quieres tu pedido</h2>
        </div>
    </div>

</div>
