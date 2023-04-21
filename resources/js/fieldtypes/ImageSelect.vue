<template>
    <fieldset class="flex items-center space-x-2">
        <label :class="{ 'ring-offset-1 border-blue-500 scale-[102%]' : value === option.image_value, 'scale-[100%] border-opacity-10' : value !== option.image_value }" class="relative rounded border-2 transition-all flex flex-col cursor-pointer items-center justify-center px-1 py-0.5 focus:outline-none ring-blue-500"
               v-for="(option, index) in options" :key="$index">
            <input type="radio"
                   ref="images"
                   :name="name"
                   @input="update($event.target.value)"
                   :value="option.image_value"
                   :disabled="isReadOnly"
                   :checked="value === option.image_value"
                   class="sr-only"
                   :aria-labelledby="name + '-' + index + '-label'"
            />
            <span v-if="value === option.image_value" class="absolute backdrop-blur flex items-center justify-center h-12 w-12 border border-gray-200 bg-white/60 text-gray-500 rounded-full top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
            </span>
            <img :src="option.image_src" aria-hidden="true" class="h-20 w-20 object-cover"/>
            <div :id="name + '-' + index + '-label'" :class="{'sr-only' : ! option.label }" class="">{{ option.label || option.image_value }}</div>
        </label>
    </fieldset>

</template>

<script>

export default {

    mixins: [Fieldtype],

    computed: {
        options() {
            return this.meta.options;
        },

        replicatorPreview() {
            var option = _.findWhere(this.config.options, {value: this.value});
            return (option) ? option.label : this.value;
        },
    },

    methods: {

        focus() {
            this.$refs.images[0].focus();
        },

    }


};
</script>
