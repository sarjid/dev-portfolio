import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],

    theme: {
        // extend: {
        //     fontFamily: {
        //         sans: ["Figtree", ...defaultTheme.fontFamily.sans],
        //     },
        // },

        boxShadow: {
            profile: "0 4px 4px rgb(0 0 0 / 40%)",
            pdtDetail: "0px 4px 4px 0px #EDEDED",
            timeline: "0 1px 6px rgba(0, 0, 0, 0.05)",
        },
        extend: {
            screens: {
                "media-max-w-xs": { max: "639.98px" },
                "media-min-w-md": { min: "992px" },
                "media-max-w-sm": { max: "767.98px" },
                "media-max-w-md": { max: "991.98px" },
                "media-max-w-lg": { max: "1199.98px" },
            },
            colors: {
                themePrimary: "#0f0715",
                themeCancel: "#637381",
                borderCard: "rgba(0,0,0,.125)",
                borderDropdown: "rgba(0,0,0,.15)",
                borderCarousel: "#292D32",
                customFile: "rgba(27, 85, 226, 0.23)",
                modalContent: "rgba(0,0,0,.2)",
                sidebarOverlay: "rgba(0,0,0,.6)",
                cardFooter: "rgba(0,0,0,.1)",
                checkToggle: "rgba(115, 103, 240, 0.2)",
                headerBtn: "rgba(255, 255, 255, 0.7)",
                inboxMenu: "rgba(33, 33, 33, 0.05)",
                headerBtnborder: "rgba(255, 255, 255, 0.15)",
                btnPos: "rgba(234, 84, 85, 0.06)",
                borderFormgroup: "rgba(145, 158, 171, 0.32)",
                dashWidget: "rgba(249, 110, 111, 0.12)",
                tablePrimary: "#cfe2ff",
                tableSecondary: "#e2e3e5",
                tableSuccess: "#d1e7dd",
                tableDanger: "#f8d7da",
                tableWarning: "#fff3cd",
                tableInfo: "#cff4fc",
                tableLight: "#f8f9fa",
                tableDark: "#212529",
                alertPrimary: {
                    fontColor: "#084298",
                    bgColor: "#cfe2ff",
                    borderColor: "#b6d4fe",
                },
                alertSecondary: {
                    fontColor: "#41464b",
                    bgColor: "#e2e3e5",
                    borderColor: "#d3d6d8",
                },
                alertWarning: {
                    fontColor: "#664d03",
                    bgColor: "#fff3cd",
                    borderColor: "#ffecb5",
                },
                alertDanger: {
                    fontColor: "#842029",
                    bgColor: "#f8d7da",
                    borderColor: "#f5c2c7",
                },
                alertSuccess: {
                    fontColor: "#0f5132",
                    bgColor: "#d1e7dd",
                    borderColor: "#badbcc",
                },
                alertInfo: {
                    fontColor: "#055160",
                    bgColor: "#cff4fc",
                    borderColor: "#b6effb",
                },
                alertLight: {
                    fontColor: "#636464",
                    bgColor: "#fefefe",
                    borderColor: "#fdfdfe",
                },
                alertDark: {
                    fontColor: "#141619",
                    bgColor: "#d3d3d4",
                    borderColor: "#bcbebf",
                },
                btnPrimary: {
                    fontColor: "#ffffff",
                    bgColor: "#ff9b44",
                    borderColor: "#ff9b44",
                    hoverbgColor: "#ff851a",
                    hoverborderColor: "#ff851a",
                },
                btnSecondary: {
                    fontColor: "#ffffff",
                    bgColor: "#6c757d",
                    borderColor: "#6c757d",
                    hoverbgColor: "#5c636a",
                    hoverborderColor: "#5c636a",
                },
                btnSuccess: {
                    fontColor: "#ffffff",
                    bgColor: "#55ce63",
                    borderColor: "#55ce63",
                    hoverbgColor: "#4ab657",
                    hoverborderColor: "#4ab657",
                },
                btnDanger: {
                    fontColor: "#ffffff",
                    bgColor: "#f62d51",
                    borderColor: "#f62d51",
                    hoverbgColor: "#e6294b",
                    hoverborderColor: "#e6294b",
                },
                btnWarning: {
                    fontColor: "#000000",
                    bgColor: "#ffbc34",
                    borderColor: "#ffbc34",
                    hoverbgColor: "#e9ab2e",
                    hoverborderColor: "#e9ab2e",
                },
                btnInfo: {
                    fontColor: "#000000",
                    bgColor: "#009efb",
                    borderColor: "#009efb",
                    hoverbgColor: "#028ee1",
                    hoverborderColor: "#028ee1",
                },
                btnLight: {
                    fontColor: "#000000",
                    bgColor: "#f8f9fa",
                    borderColor: "#f8f9fa",
                    hoverbgColor: "#f9fafb",
                    hoverborderColor: "#f9fafb",
                },
                btnDark: {
                    fontColor: "#ffffff",
                    bgColor: "#212529",
                    borderColor: "#212529",
                    hoverbgColor: "#1c1f23",
                    hoverborderColor: "#1c1f23",
                },
                btnLink: {
                    fontColor: "#333333",
                    hoverfontColor: "#0a58ca",
                },
            },
            fontFamily: {
                Nunito: ["Nunito", "sans-serif"],
                FontAwesome: ["Font Awesome 5 Free"],
            },
        },
    },

    plugins: [require("flowbite/plugin"), forms],
};
