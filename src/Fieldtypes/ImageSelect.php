<?php

namespace Patrickjunod\ImageSelect\Fieldtypes;

use Statamic\Fields\Fieldtype;
use Statamic\Facades\Asset;

class ImageSelect extends Fieldtype
{

    protected $categories = ['controls', 'special'];

    protected $icon = '<svg width="27" height="24" viewBox="0 0 27 24" fill="none">
<path d="M2.25 15.75L7.409 10.591C7.61793 10.3821 7.86597 10.2163 8.13896 10.1033C8.41194 9.99018 8.70452 9.93198 9 9.93198C9.29548 9.93198 9.58806 9.99018 9.86104 10.1033C10.134 10.2163 10.3821 10.3821 10.591 10.591L15.75 15.75M14.25 14.25L15.659 12.841C15.8679 12.6321 16.116 12.4663 16.389 12.3533C16.6619 12.2402 16.9545 12.182 17.25 12.182C17.5455 12.182 17.8381 12.2402 18.111 12.3533C18.384 12.4663 18.6321 12.6321 18.841 12.841L21.75 15.75M21.75 9.93198V18C21.75 18.3978 21.592 18.7794 21.3107 19.0607C21.0294 19.342 20.6478 19.5 20.25 19.5H3.75C3.35218 19.5 2.97064 19.342 2.68934 19.0607C2.40804 18.7794 2.25 18.3978 2.25 18V6C2.25 5.60218 2.40804 5.22064 2.68934 4.93934C2.97064 4.65804 3.35218 4.5 3.75 4.5H17M14.25 8.25H14.258V8.258H14.25V8.25ZM14.625 8.25C14.625 8.34946 14.5855 8.44484 14.5152 8.51517C14.4448 8.58549 14.3495 8.625 14.25 8.625C14.1505 8.625 14.0552 8.58549 13.9848 8.51517C13.9145 8.44484 13.875 8.34946 13.875 8.25C13.875 8.15054 13.9145 8.05516 13.9848 7.98484C14.0552 7.91451 14.1505 7.875 14.25 7.875C14.3495 7.875 14.4448 7.91451 14.5152 7.98484C14.5855 8.05516 14.625 8.15054 14.625 8.25Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M19.5 6.0625L20.4375 7L21.2188 5.90625L22 4.8125" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M24.5 5.75C24.5 6.24246 24.403 6.73009 24.2145 7.18506C24.0261 7.64003 23.7499 8.05343 23.4016 8.40165C23.0534 8.74987 22.64 9.02609 22.1851 9.21455C21.7301 9.403 21.2425 9.5 20.75 9.5C20.2575 9.5 19.7699 9.403 19.3149 9.21455C18.86 9.02609 18.4466 8.74987 18.0983 8.40165C17.7501 8.05343 17.4739 7.64003 17.2855 7.18506C17.097 6.73009 17 6.24246 17 5.75C17 4.75544 17.3951 3.80161 18.0983 3.09835C18.8016 2.39509 19.7554 2 20.75 2C21.7446 2 22.6984 2.39509 23.4016 3.09835C24.1049 3.80161 24.5 4.75544 24.5 5.75Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>';

    protected function configFieldItems(): array
    {
        return [
            'default' => [
                'display' => __('Default Value'),
                'instructions' => __('statamic::messages.fields_default_instructions'),
                'type' => 'text',
                'width' => 50,
            ],
            'options' => [
                'display' => __('Options'),
                'instructions' => __('statamic::fieldtypes.select.config.options'),
                'type' => 'grid',
                'mode' => 'table',
                'reorderable' => true,
                'fields' => [
                    [
                        'handle' => 'image',
                        'field' => [
                            'mode' => 'list',
                            'max_files' => 1,
                            'validate' => [
                                'required'
                            ],
                            'restrict' => false,
                            'allow_uploads' => config('statamic.image_select.allow_uploads',  true),
                            'show_filename' => false,
                            'display' => 'Image',
                            'type' => 'assets',
                            'width' => 33,
                            'container' => config('statamic.image_select.container', 'assets')
                        ],
                    ],
                    [
                        'handle' => 'image_value',
                        'field' => [
                            'input_type' => 'text',
                            'display' => 'Value',
                            'validate' => [
                                'required'
                            ],
                            'type' => 'text',
                            'width' => 33,
                        ],
                    ],
                    [
                        'handle' => 'label',
                        'field' => [
                            'input_type' => 'text',
                            'display' => 'Label (optional)',
                            'type' => 'text',
                            'width' => 33,
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * The blank/default value.
     *
     * @return array
     */
    public function defaultValue()
    {
        return $this->config('default');
    }

    public function preload() {

        $options = $this->config('options');

        foreach($options as $key => $option) {
            $options[$key]['image_src'] = Asset::query()->where('container', config('statamic.image_select.container'))
                ->where('path', $option['image'])->first()?->url();
        }

        return [
            'options' => $options
        ];
    }


    /**
     * Pre-process the data before it gets sent to the publish page.
     *
     * @param mixed $data
     * @return array|mixed
     */
    public function preProcess($data)
    {
        return $data;
    }

    /**
     * Process the data before it gets saved.
     *
     * @param mixed $data
     * @return array|mixed
     */
    public function process($data)
    {
        return $data;
    }
}
