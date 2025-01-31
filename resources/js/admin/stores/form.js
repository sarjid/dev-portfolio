import { defineStore } from "pinia";
// import axiosInstance from "@/services/axiosService";
export const useFormStore = defineStore("form", {
    state: () => ({
        data: {
            // name: null,
            // status: null,
            // image: null,
            // variants: [],
        },

        arrayForm: {
            form: [
                {
                    value: "",
                },
            ],
        },
        errors: null,
        processing: false,
    }),

    getters: {
        getAttrValues: (state) => {
            // return state.items;
        },
    },

    actions: {
        // async getAttributeValue(attrID) {
        //     try {
        //         const res = await axiosInstance.get(
        //             `/attribute-value/${attrID}`
        //         );
        //         if (res.status === 200) {
        //             this.items = res.data;
        //         }
        //     } catch (error) {
        //         if (error.response.data) {
        //             throw error.response.data.errors;
        //         }
        //     }
        // },
        // async fatchColors() {
        //     try {
        //         const res = await axiosInstance.get("/product-colors");
        //         if (res.status === 200) {
        //             this.colors = res.data;
        //         }
        //     } catch (error) {
        //         if (error.response.data) {
        //             throw error.response.data.errors;
        //         }
        //     }
        // },
    },
});
