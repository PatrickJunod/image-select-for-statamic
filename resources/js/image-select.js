import ImageSelectField from './fieldtypes/ImageSelect.vue';

Statamic.booting(() => {
    Statamic.$components.register('image_select-fieldtype', ImageSelectField);
});