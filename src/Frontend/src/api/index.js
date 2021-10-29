import request from '@/utils/request';


export const fetchLogin = (url, params) => request.post(url, params);
export const fetchList = (url, params) => request.get(url, {params});