import ScriptGrammar from '../ScriptGrammar.js';

export default {

	data: function() {

		return {
			'expression': this.newToggleExpression()
		};

	},

	methods: {

		conditionIsTrue() {
			return this.expression() == true;
		},

		newToggleExpression() {
			return this.newScriptGrammar().compile(this.field.condition);
		},

		/**
		 * Creates and returns a new script grammar.
		 *
		 * @return {ScriptGrammar}
		 */
		newScriptGrammar() {

			let grammar = new ScriptGrammar;

			this.initializeScriptGrammar(grammar);

			return grammar;

		},

		/**
		 * Initializes the specified script grammar.
		 *
		 * @param  {ScriptGrammar}  grammar
		 *
		 * @return {void}
		 */
		initializeScriptGrammar(grammar) {

			//

		}

	}

}