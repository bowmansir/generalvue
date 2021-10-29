import axios from 'axios'
import router from '@/router';

const service = axios.create({
    baseURL: "http://localhost:8000/api",
    timeout: 60000,
})

service.interceptors.request.use((config) => {
    if(localStorage.getItem("token")) {
        config.headers.Authorization = localStorage.getItem("token");
    }
    return config;
}, (err) => {
    return Promise.resolve(err);
})

service.interceptors.response.use((response) => {
    const res = response.data;
    if(response.status == 201) {
        const token = `${res.token_type} ${res.access_token}`
        localStorage.setItem("token", token);
        //跳转到其他登录后的页面
        router.push("home");
    }
    return res;
}, (error) => {
    if(error.response.status === 401 && window.location.href.indexOf("login") < 0)
    {
        router.push("login");
    }
    return Promise.resolve(error);
})

export default service;