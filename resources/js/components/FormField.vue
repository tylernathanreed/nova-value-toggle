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

            // Only fill the form data if the child is defined
            if(!this.child) {
                return;
            }

            // Fill the form data through the child
            this.child.field.fill(formData);

        },

        /**
         * Update the field's internal value.
         *
         * @param  {mixed}  value
         *
         * @return {void}
         */
        handleChange(value) {

            // Only handle the change if the child is defined
            if(!this.child) {
                return;
            }

            // Handle the change through the child
            this.child.handleChange(value);

        },

        /**
         * Initializes the specified script grammar.
         *
         * @param  {ScriptGrammar}  grammar
         *
         * @return {void}
         */
        initializeScriptGrammar(grammar) {

            // Set the column resolver
            grammar.setColumnResolver(this.attr);

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
