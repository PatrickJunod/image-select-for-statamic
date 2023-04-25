<template>
    <fieldset class="flex items-center space-x-2 select-none">
        <label :class="exists(option.image_value) ? 'ring-offset-1 border-blue-500 scale-[102%]' : 'scale-[100%] border-opacity-10'" class="relative rounded border-2 transition-all flex flex-col cursor-pointer items-center justify-center px-1 py-0.5 focus:outline-none ring-blue-500"
               v-for="(option, index) in options" :key="$index">
            <input type="checkbox"
                   ref="images"
                   :value="option.image_value"
                   :true-value="option.image_value"
                   :false-value="null"
                   v-model="values"
                   :disabled="isReadOnly"
                   class="sr-only"
                   :aria-labelledby="name + '-' + index + '-label'"
            />
            <span v-if="exists(option.image_value)" class="absolute backdrop-blur flex items-center justify-center h-8 w-8 border-2 border-blue-500 bg-blue-500/70 text-blue-50 rounded-full top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
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

    data() {
        return {
            values: ((this.config.multiple && !Array.isArray(this.value)) ? [this.value] : this.value) || (this.config.multiple ? [] : ''),
        }
    },

    computed: {

        options() {
            return this.meta.options;
        },

        replicatorPreview() {
            return Array.isArray(this.values)
                    ?  this.values.map(value => {
                            const option = _.findWhere(this.options, { value });
                            return option ? option.label : value;
                        }).join(', ')
                    : this.values;

        },
    },

    methods: {

        focus() {
            this.$refs.images[0].focus();
        },

        exists(value) {
            if(this.config.multiple && Array.isArray(this.values)) {
                return this.values.includes(value)
            }

            return this.values === value;
        }

    },

    watch: {

        values(values, oldValues) {

            this.update(values);

        },

        value(value, oldValue) {

            this.values = value;

        }

    },


};
</script>
