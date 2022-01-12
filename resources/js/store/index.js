import Vue from 'vue'
import Vuex from 'vuex'
import errors from "./errors";
import notifications from "./notifications";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        errors,
        notifications,
    }
});
