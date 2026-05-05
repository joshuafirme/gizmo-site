<template>
    <div>

        <header class="header">
            <div class="navbar-area">
                <div class="container">
                    <nav class="navbar navbar-expand-lg">

                        <a class="navbar-brand" href="#">
                            <img width="120px;" src="../assets/images/logo.png" alt="Logo" />
                        </a>

                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav m-auto">

                                <li class="nav-item">
                                    <router-link class="nav-link fw-medium"
                                        :class="{ active: $route.path === '/admin/guard/release' }"
                                        to="/admin/guard/release">
                                        <font-awesome-icon icon="note-sticky" /> Release Sticker
                                    </router-link>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Settings
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li class="nav-item fw-medium">

                                            <a class="nav-link" href="#" @click.prevent="logout"><font-awesome-icon
                                                    icon="right-from-bracket" /> Logout</a>
                                        </li>
                                    </ul>
                                </li>

                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </header>

        <!-- Main content -->
        <div class="container mt-200">
            <router-view></router-view>
        </div>

    </div>

    <a href="#" class="scroll-top btn-hover">
        <font-awesome-icon icon="angle-up" />
    </a>
</template>

<script>
import axios from 'axios'
import { auth } from '@/auth'
export default {
    methods: {
        logout() {
            axios.post('/api/admin/logout', {}, {
                headers: {
                    'Authorization': `Bearer ${auth.token}`
                }
            }).then(res => {
                localStorage.setItem('admin_token', '')
                localStorage.setItem('user_role', '')
                auth.token = null;
                window.location.href = '/admin/login'
            })
        }
    }
}
</script>