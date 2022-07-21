import Auth from "../store/Auth";

const AlertService = {
    commitAlert(content, alert_type) {
        Auth.commit(
            'alert/updateMessage',
            {
                content: content,
                alert_type: alert_type
            }
        )
    },
}

const NotifyService = {
    commitNotify(alert) {
        Auth.commit(
            'alert/updateMessage',
            alert
        )
    },
}

export {AlertService, NotifyService};
