import service from '@/utils/request';


export const Login = (url, params) => service.post(url, params);