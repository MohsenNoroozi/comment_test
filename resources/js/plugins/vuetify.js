import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import config from "./config"

Vue.use(Vuetify)

const opts = {
    theme: {
        dark: false,
        options: {
            customProperties: true,
        },
        themes: {
            dark: config.dark,
            light: config.light,
        }
    }
}

export default new Vuetify(opts)
