import { ref, computed } from "vue";
export default function useStatus() {
    const status = ref(false);
    const search = ref(false);
    const flag = ref(false);
    const notify = ref(false);
    const sidebar = ref(false);
    const profile = ref(false);
    const collapseStatus = ref(false);

    function toggleBtn(name) {
        if (name === "search") {
            search.value = !search.value;
        } else if (name === "flag") {
            flag.value = !flag.value;
        } else if (name === "notify") {
            notify.value = !notify.value;
        } else if (name === "sidebar") {
            sidebar.value = !sidebar.value;
        } else if (name === "profile") {
            profile.value = !profile.value;
        } else if (name === "collapse") {
            if (document.body.className === "expand-menu") {
                document.body.className = "mini-sidebar";
            } else if (document.body.className === "mini-sidebar") {
                document.body.className = "expand-menu";
            } else {
                document.body.className = "mini-sidebar";
            }
            collapseStatus.value = !collapseStatus.value;
        }

        status.value = !status.value;
    }

    const iconChange = computed(() =>
        status.value ? "fa solid fa-times" : "fa solid fa-bars-staggered"
    );

    return {
        status,
        search,
        flag,
        notify,
        sidebar,
        profile,
        toggleBtn,
        iconChange,
    };
}
