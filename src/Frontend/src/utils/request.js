import axios from 'axios'

const service = axios.create({
    baseURL: 'http://localhost:8000/api',
    timeout: 10000,
})

service.interceptors.request.use((config) => {
    config.headers.Authorized = "Barear"
    return Promise.resolve(config);
}, (err) => {
    return Promise.resolve(err);
})

service.interceptors.response.use((response) => {
    return Promise.resolve(response);
}, (err) => {
    return Promise.resolve(err);
})

export default service;