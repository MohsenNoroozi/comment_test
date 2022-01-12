import axios from 'axios';
import store from '../store/index';

const handleError = err => {
    store.commit('errors/setMessage', null)
    let msg = null
    if (!err.response) {
        msg = "Connection lost. Please check your settings and try again later."
    } else if (err.response.status === 422 || err.response.status === 403) {
        msg = (Object.values(err?.response?.data?.errors ?? {})?.[0]?.[0]) || err?.response?.data?.message || 'The given data was invalid.'
    } else if (err.response.status === 401) {
        msg = err?.response?.data?.message || 'The credentials do not match our records.'
    } else if (err.response.status >= 500) {
        msg = "An error occurred, please try again later."
    }
    store.commit('errors/setMessage', msg)
    return Promise.reject(err);
}

export const api = () => {
    store.commit('notifications/setMessage', null)
    let api = axios.create({
        baseURL: '/api',
        withCredentials: true,
        headers: {
            'Content-Type': 'application/json',
        },
    })
    api.interceptors.response.use(r => r, handleError);
    return api;
}
