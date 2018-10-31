<template>
    <component
        :is="'form-' + field.field.component"
        :errors="errors"
        :resource-id="resourceId"
        :resource-name="resourceName"
        :field="field.field"
        v-if="conditionIsTrue()"
    />
</template>

<script>

import { HandlesValidationErrors } from 'laravel-nova'
import { FormValues, ToggleBuilder } from '../mixins/mixins'

export default {

    mixins: [HandlesValidationErrors, FormValues, ToggleBuilder],

    props: ['resourceName', 'resourceId', 'field'],

    data: function() {
        return {};
    },

    mounted: function() {

        // Add a default fill method for the field
        this.field.fill = this.fill;

        // Register a global event for setting the field's value
        Nova.$on(this.attribute + '-value', value => {
            this.value = value;
        });
    },

    destroyed: function() {
        Nova.$off(this.attribute + '-value');
    },

    methods: {

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {

            if(!this.child) {
                return;
            }

            this.child.field.fill(formData);
        },

        /**
         * Update the field's internal value.
         */
        handleChange(value) {

            if(!this.child) {
                return;
            }

            this.child.handleChange(value);
        }

    },

    computed: {

        form() {
            return this.getFormComponent();
        },

        child() {
            return this.$children[0];
        },

        value() {
            return this.child ? this.child.value : null;
        },

        attribute() {
            return this.field.field.attribute;
        }

    }

}
</script>
