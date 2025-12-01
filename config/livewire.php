<?php

return [
    'class_namespace' => 'App\\Http\\Livewire',
    'component_namespace' => 'App\\Http\\Livewire',
    'view_path' => resource_path('views/livewire'),
    'cache' => storage_path('framework/cache/livewire'),
    'prefix' => 'wire',
    'manifest_path' => storage_path('framework/cache/livewire-components.php'),
    'aliases' => [
        'sales-cart' => \App\Http\Livewire\Admin\SalesCart::class,
    ],
];
