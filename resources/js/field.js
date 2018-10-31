Nova.booting((Vue, router) => {
    Vue.component('index-value-toggle', require('./components/IndexField'));
    Vue.component('detail-value-toggle', require('./components/DetailField'));
    Vue.component('form-value-toggle', require('./components/FormField'));
})
