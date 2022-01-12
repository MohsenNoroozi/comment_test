export default {
    namespaced: true,
    state: {
        message: null,
    },

    getters: {
        message: state => state.message,
    },

    mutations: {
        setMessage(state, message) {
            state.message = message;
        },
    },

    actions: {},

    modules: {}
}
