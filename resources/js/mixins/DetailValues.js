export default {

    methods: {

        /**
         * Returns the value for the specified attibute key.
         *
         * @param  {string}  key
         *
         * @return {mixed}
         */
        attr(key) {
            return this.getFieldValue(key);
        },

        /**
         * Returns the value for the specified field.
         *
         * @param  {string}  key
         *
         * @return {mixed}
         */
        getFieldValue(key) {

            // Determine the field
            let field = this.getField(key) || {};

            // Return the value
            return field.value;

        },

        /**
         * Returns the field with the specified attribute name.
         *
         * @param  {string}  key
         *
         * @return {object|undefined}
         */
        getField(key) {

            // Determine the fields
            let fields = this.resource.fields;

            // Search the fields for the specified field
            for(let i = 0; i < fields.length; i++) {

                // Determine the field
                let field = fields[i];

                // Return the field on a match
                if(field.attribute == key) {
                    return field;
                }

            }

            // Unknown
            return undefined;

        }

    }
}