import AdminStore from "../store/AdminStore";

const NotifyService = {
    commitNotify(alert) {
        AdminStore.commit(
            'alert/updateMessage',
            alert
        )
    },
}

export {NotifyService};
