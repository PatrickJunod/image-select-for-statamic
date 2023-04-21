# Image Select

> The "Image Select FieldType" addon is a versatile tool for Statamic users who want to create custom fields for selecting images in various contexts.

With this addon, you can easily add a new fieldtype to your Statamic site that allows users to select images from a predefined set of options. 

Whether you're building a template selection page or an e-commerce site where users can select products, this addon makes it easy to incorporate images into your control panel. With its user-friendly interface and powerful functionality, the "Image Select FieldType" addon is an essential tool for any Statamic developer looking to streamline their image selection process and enhance the user experience for their site visitors.


## Features

- Create your own image selection field
- It saves the selection as a value defined in your field

## Coming soon

- Multi-select
- Disabling options
- Deselect
- And many more !

## How to Install

You can search for this addon in the `Tools > Addons` section of the Statamic control panel and click **install**, or run the following command from your project root:

``` bash
composer require patrickjunod/image-select
```

## How to Use

Publish the assets files if not already the case
``` bash
php artisan vendor:publish --tag=image-select
```

You can also publish the config file
``` bash
php artisan vendor:publish --tag=image-select-config
```

You will then find the image_select.php config file in your `config > statamic` folder.

There, you will be able to choose an asset container in which the user can choose images.

You can also adjust if the user can upload images or not.