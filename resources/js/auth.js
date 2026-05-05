import { reactive } from 'vue'

import axios from 'axios'

export const auth = reactive({
    token: localStorage.getItem('admin_token')
})


axios.interceptors.request.use(config => {

    const token = localStorage.getItem('admin_token')

    if (token) {
        config.headers.Authorization = `Bearer ${token}`
    }

    return config
})