<template>

    <AdminLayout v-if="userRole == 'admin'" />
    <GuardLayout v-else-if="userRole == 'guard'" />
    <HomeLayout v-else />

</template>

<script>
import AdminLayout from "./layouts/AdminLayout.vue"
import HomeLayout from "./layouts/HomeLayout.vue"
import GuardLayout from "./layouts/GuardLayout.vue"


export default {

    components: {
        AdminLayout,
        HomeLayout,
        GuardLayout
    },

    computed: {

        userRole() {
            return localStorage.getItem('user_role')
        }

    }

}
</script>