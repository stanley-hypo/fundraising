import axios from "axios";
import router from "../router/webrouter";
import { NotifyService } from "./Service";

export default {
    //donation

    showMonthly() {
        return axios
            .post(
                import.meta.env.VITE_APP_URL + "adminapi/donation/showMonthly"
            )
            .then((response) => response.data)
            .catch(function (error) {
                NotifyService.commitNotify({
                    color: "negative",
                    message: error.response?.data?.message ?? "",
                    icon: "report_problem",
                    position: "",
                });
            });
    },

    getMonthlyDetail(credentials) {
        return axios
            .post(
                import.meta.env.VITE_APP_URL +
                    "adminapi/donation/getMonthlyDetail",
                credentials
            )
            .then((response) => response.data)
            .catch(function (error) {
                NotifyService.commitNotify({
                    color: "negative",
                    message: error?.message ?? "Error",
                    dangerous: "check",
                    position: "",
                });
            });
    },
};
