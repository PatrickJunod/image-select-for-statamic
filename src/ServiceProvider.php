<?php

namespace Patrickjunod\ImageSelect;

use Patrickjunod\ImageSelect\Fieldtypes\ImageSelect as ImageSelectFieldType;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{

    protected $fieldtypes = [
        ImageSelectFieldType::class,
    ];

    protected $scripts = [
        __DIR__.'/../dist/js/image-select.js'
    ];

    protected $stylesheets = [
        __DIR__.'/../dist/css/image-select.css'
    ];
    
    protected function bootConfig()
    {

        $this->publishes([
            __DIR__.'/../config/image-select.php' => config_path('statamic/image_select.php'),
        ], 'image-select-config');

        return $this;
    }
}
