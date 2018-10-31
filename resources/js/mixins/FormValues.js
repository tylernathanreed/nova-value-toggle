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
         * @return {VueComponent|undefined}
         */
        getField(key) {

            // Determine the fields
            let fields = this.getFormFieldComponents();

            // Search the fields for the specified field
            for(let i = 0; i < fields.length; i++) {

                // Determine the field
                let field = fields[i];

                // Return the field on a match
                if(field.fieldAttribute == key) {
                    return field;
                }

            }

            // Unknown
            return undefined;

        },

        /**
         * Returns all of the form field components.
         *
         * @return {Array}
         */
         getFormFieldComponents() {

            // Determine the form descendants
            let descendants = this.getFormDescendants();

            // Return the form field components
            return descendants.filter(function(component) {

                // All of the form field elements are forced to begin with "form".
                // If a Vue Component doesn't have name, or it doesn't use the
                // correct convention, we can immediately exclude it here.

                // Make sure the component name begins with "form-"
                if(component.$options.name.substring(0, 5) !== 'form-') {
                    return false;
                }

                // We're only interested in fields that contain a value. Since
                // labels used the "form-" convention, this will knock them
                // out, as well as anything else without a known value.

                // Make sure the component can provide a value
                if(!component.hasOwnProperty('value')) {
                    return false;
                }

                // Just in case something both follows the condition, and has
                // a value, we'll also make sure that a field attribute is
                // provided, since we'll need to know that eventually.

                // Make sure the component has a field attribute
                if(typeof component.fieldAttribute === 'undefined' || component.fieldAttribute === '') {
                    return false;
                }

                // Component is a form field
                return true;

            });

         },

        /**
         * Returns all of the descendants for the form.
         *
         * @return {Array}
         */
        getFormDescendants() {
            return this.getComponentDescendants(this.getFormComponent());
        },

        /**
         * Returns the node that contains the fields for the form.
         *
         * @return {object|null}
         */
        getFormComponent() {

            // Start with the parent
            let node = this.$parent;

            // Walk up the parent chain
            while(typeof node !== 'undefined' && node !== null) {

                // Check for a "fields" property
                if(node.hasOwnProperty('fields')) {
                    return node;
                }

                // Walk up the chain
                node = node.$parent;

            }

            // Unknown
            return null;

        },

        /**
         * Returns all of the descendants for the specified component.
         *
         * @param  {VueComponent}  component
         *
         * @return {Array}
         */
        getComponentDescendants(component) {

            // Initialize the list of descendants
            let descendants = [];

            // Determine the direct children of the component
            let children = component.$children;

            // Iterate through each child
            for(let i = 0; i < children.length; i++) {

                // Determine the current child
                let child = children[i];

                // Add the child to the list of descendants
                descendants.push(child);

                // Determine the grandchildren
                let grandchildren = this.getComponentDescendants(child);

                // Push the grandchildren to the list of descendants
                descendants.push(...grandchildren);

            }

            // Return the descendants
            return descendants;

        }
    }
}