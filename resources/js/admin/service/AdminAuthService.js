import axios from 'axios';
import router from "../router/webrouter";
import {NotifyService} from "./Service";

export default {
    //User
    checkUnique(credentials) {
        return axios
            .post(import.meta.env.VITE_APP_URL + 'adminapi/checkUnique', credentials)
            .then(response => response.data);
    },
    register(credentials) {
        return axios
            .post(import.meta.env.VITE_APP_URL + 'adminapi/register', credentials)
            .then(response => response.data)
            .catch(function (error) {
                NotifyService.commitNotify( { color: 'negative', message: error?.message??'Error', dangerous: 'check', position: '' });
            });
    },
    update(credentials) {
        return axios
            .post(import.meta.env.VITE_APP_URL + 'adminapi/user/update', credentials)
            .then(response => response.data)
            .catch(function (error) {
                NotifyService.commitNotify( { color: 'negative', message: error?.message??'Error', dangerous: 'check', position: '' });
            });
    },
    updatepwd(credentials) {
        return axios
            .post(import.meta.env.VITE_APP_URL + 'adminapi/user/updatepwd', credentials)
            .then(response => response.data)
            .catch(function (error) {
                NotifyService.commitNotify( { color: 'negative', message: error?.message??'Error', dangerous: 'check', position: '' });
            });
    },
    login(credentials) {
        return axios
            .post(import.meta.env.VITE_APP_URL + 'adminapi/login', credentials)
            .then(response => response.data)
            .catch(function (error) {
                NotifyService.commitNotify( { color: 'negative', message: error?.message??'Error', dangerous: 'check', position: '' });
            });
    },
    logout() {
        return axios
            .post(import.meta.env.VITE_APP_URL + 'adminapi/logout')
            .then(response => response.data);
    },
    getuser(credentials){
        return axios
            .post(import.meta.env.VITE_APP_URL + 'adminapi/user/show', credentials)
            .then(response => response.data)
            .catch(function (error) {
                NotifyService.commitNotify( { color: 'negative', message: error?.message??'Error', dangerous: 'check', position: '' });
            });
    },
    //only get 自己的info
    getme() {
        return axios
            .post(import.meta.env.VITE_APP_URL + 'adminapi/getme')
            .then(response => response.data)

    },
    roleList(){
        //stanley 我用左黎做roles list 個頁
        return axios
            .post(import.meta.env.VITE_APP_URL + 'adminapi/roleList')
            .then(response => response.data)
            .catch(function (error) {
                NotifyService.commitNotify( { color: 'negative', message: error.response?.data?.message??'Error', dangerous: 'check', position: '' });
            });
    },
    getRoleDetail(credentials){
        return axios
            .post(import.meta.env.VITE_APP_URL + 'adminapi/role/show', credentials)
            .then(response => response.data)
            .catch(function (error) {
                NotifyService.commitNotify( { color: 'negative', message: error.response?.data?.message??'Error', dangerous: 'check', position: '' });
            });
    },
    updateRole(credentials){
        return axios
            .post(import.meta.env.VITE_APP_URL + 'adminapi/role/update', credentials)
            .then(response => response.data)
            .catch(function (error) {
                NotifyService.commitNotify( { color: 'negative', message: error.response?.data?.message??'Error', dangerous: 'check', position: '' });
            });
    },

    //setting
    getSetting(){
        return axios
            .post(import.meta.env.VITE_APP_URL + 'adminapi/settings/index')
            .then(response => response.data)
            .catch(function (error) {
                NotifyService.commitNotify( { color: 'negative', message: error.response?.data?.message??'Error', dangerous: 'check', position: '' });
            });
    },
    updateSetting(credentials){
        const config = {
            headers: {
                'content-type': 'multipart/form-data'
            }
        }
        return axios
            .post(import.meta.env.VITE_APP_URL + 'adminapi/settings/update', credentials, config)
            .then(response => response.data)
            .catch(function (error) {
                NotifyService.commitNotify( { color: 'negative', message: error.response?.data?.message??'Error', dangerous: 'check', position: '' });
            });
    },
};
