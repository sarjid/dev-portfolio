import { ElNotification } from "element-plus";
export default function useNotify() {
    /**
     *
     * @param {message} message
     * @param {type of alert} type
     * positions: "top-right","top-left","bottom-right","bottom-left"
     */
    function notify(message, type) {
        ElNotification({
            title: type.charAt(0).toUpperCase() + type.slice(1), //Success
            message: message,
            type: type.toLowerCase(), //success
            position: "top-right",
        });
    }

    return {
        notify,
    };
}
