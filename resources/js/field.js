Nova.booting((Vue, router) => {
    Vue.component('index-value-toggle', require('./components/IndexField').default);
    Vue.component('detail-value-toggle', require('./components/DetailField').default);
    Vue.component('form-value-toggle', require('./components/FormField').default);
})
