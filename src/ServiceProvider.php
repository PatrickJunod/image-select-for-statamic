<?php

namespace Patrickjunod\ImageSelect;

use Patrickjunod\ImageSelect\Fieldtypes\ImageSelect as ImageSelectFieldType;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $vite = [
        'input' => [
            'resources/js/image-select.js',
            'resources/css/image-select.css',
        ],
        'publicDirectory' => 'dist',
    ];

    protected $fieldtypes = [
        ImageSelectFieldType::class,
    ];
    
    protected function bootConfig()
    {

        $this->publishes([
            __DIR__.'/../config/image-select.php' => config_path('statamic/image_select.php'),
        ], 'image-select-config');

        return $this;
    }
}
