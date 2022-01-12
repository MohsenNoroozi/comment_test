import axios from 'axios';
import store from '../store/index';

const handleError = err => {
    store.commit('errors/setMessage', null)
    if (!err.response) {
        store.commit('errors/setMessage', "Connection lost. Please check your settings and try again later.");
    } else if (err.response.status === 422 || err.response.status === 403) {
        store.commit('errors/setMessage', (Object.values(err?.response?.data?.errors ?? {})?.[0]?.[0]) || err?.response?.data?.message || 'The given data was invalid.');
    } else if (err.response.status === 401) {
        store.commit('errors/setMessage', err?.response?.data?.message || 'The credentials do not match our records.');
        store.commit("setUserData", null);
        localStorage.removeItem("locatorToken");
    } else if (err.response.status >= 500) {
        store.commit('errors/setMessage', "An error occurred, please try again later.");
    }
    return Promise.reject(err);
}

export const web = () => {
    let web = axios.create({
        baseURL: process.env.VUE_APP_API_URL,
        withCredentials: true,
        headers: {
            "Content-Type": "application/json",
        },
    })
    web.interceptors.response.use(r => r, handleError);
    return web;
}
