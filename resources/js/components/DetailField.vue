<template>
    <component
        :is="'detail-' + field.field.component"
        :resource-id="resourceId"
        :resource-name="resourceName"
        :field="field.field"
        :resource="resource"
        v-if="conditionIsTrue()"
    />
</template>

<script>

import { DetailValues, ToggleBuilder } from '../mixins/mixins'

export default {

	mixins: [DetailValues, ToggleBuilder],

    props: ['resource', 'resourceName', 'resourceId', 'field', 'resource'],

    methods: {

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
}
</script>
