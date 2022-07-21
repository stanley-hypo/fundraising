import axios from 'axios';

const url = '/';

export default {
    login(credentials) {
        return axios
            .post(url + 'api/login', credentials)
            .then(response => response.data);
    },
    register(credentials) {
        return axios
            .post(url + 'api/register', credentials)
            .then(response => response.data);
    },
    logout() {
        return axios
            .post(url + 'api/logout')
            .then(response => response.data);
    },
    getme() {
        return axios
            .post(url + 'api/me')
            .then(response => response.data);
    }
};
