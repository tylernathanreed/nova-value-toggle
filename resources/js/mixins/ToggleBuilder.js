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

		newScriptGrammar() {

			let grammar = new ScriptGrammar;

			grammar.setColumnResolver(this.attr);

			return grammar;

		}

	}

}