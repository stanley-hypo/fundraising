import Auth from "../store/Auth";

const NotifyService = {
    commitNotify(alert) {
        Auth.commit(
            'alert/updateMessage',
            alert
        )
    },
}

export {NotifyService};
