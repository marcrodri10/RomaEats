import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/app-employee.js',
                'resources/css/components/landing.css',
                'resources/css/components/orders.css',
                'resources/css/components/products.css',
                'resources/js/components/delivery-route.js',
                'resources/js/components/dishes.js',
                'resources/js/components/order_id.js',
                'resources/js/components/order-dish.js',
                'resources/js/components/orders.js',
                'resources/js/components/payment.js',
                'resources/js/components/products.js',
                'resources/js/components/recipe.js',
                'resources/js/components/user-dish.js',
                'resources/js/library/library.js',

            ],
            refresh: true,
        }),
    ],
});
