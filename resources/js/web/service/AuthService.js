import axios from 'axios';
import {NotifyService} from "../../admin/service/Service";

const url = '/';

export default {
    login(credentials) {
        return axios
            .post(url + 'api/login', credentials)
            .then(response => response.data)
            .catch(function (error) {
                NotifyService.commitNotify( { color: 'negative', message: error??'Error', dangerous: 'check', position: '' });
            });
    },
    register(credentials) {
        return axios
            .post(url + 'api/register', credentials)
            .then(response => response.data)
            .catch(function (error) {
                NotifyService.commitNotify( { color: 'negative', message: error??'Error', dangerous: 'check', position: '' });
            });
    },
    logout() {
        return axios
            .post(url + 'api/logout')
            .then(response => response.data)
            .catch(function (error) {
                NotifyService.commitNotify( { color: 'negative', message: error??'Error', dangerous: 'check', position: '' });
            });
    },
    getme() {
        return axios
            .post(url + 'api/me')
            .then(response => response.data)
            .catch(function (error) {
                NotifyService.commitNotify( { color: 'negative', message: error??'Error', dangerous: 'check', position: '' });
            });
    },
    showicon() {
        return axios
            .get(
                import.meta.env.VITE_APP_URL + "api/settingicon/get"
            )
            .then((response) => response.data)
            .catch(function (error) {
                NotifyService.commitNotify({
                    color: "negative",
                    message: error??'Error',
                    dangerous: 'check',
                    position: ''
                });
            });
    },
};
