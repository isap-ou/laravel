import {createStore} from "vuex";

export default createStore({
    state: () => ({
        settings: {},
        links: {},
        supportedLocales: {},
    }),

    mutations: {
        setSettings: (state, data) => {
            for (let key in data) {
                state[key] = data[key]
            }
        }
    }
})