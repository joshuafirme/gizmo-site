<template>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow" style="width: 400px;">
            <div class="card-body">
                <h4 class="card-title text-center mb-3">Admin Login</h4>

                <div v-if="error" class="alert alert-danger">{{ error }}</div>

                <form @submit.prevent="login">

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control" v-model="email" required>
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" class="form-control" v-model="password" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import { auth } from '@/auth'
export default {
    data() {
        return {
            email: '',
            password: '',
            error: ''
        }
    },
    methods: {
        login() {
            axios.post('/api/admin/login', {
                email: this.email,
                password: this.password
            })
                .then(res => {
                    // save token in localStorage
                    localStorage.setItem('admin_token', res.data.token)
                    localStorage.setItem('user_role', res.data.user.role)
                    const token = localStorage.getItem('admin_token')
                    auth.token = token;
                    console.log('admin_token', res.data.token)
                    axios.defaults.headers.common['Authorization'] = `Bearer ${res.data.token}`

                    if (res.data.user.role == 'guard') {
                        window.location.href = '/admin/guard/release'
                        return;
                    }
                    window.location.href = '/admin/dashboard'


                })
                .catch(err => {
                    this.error = err.response.data.message || 'Login failed'
                })
        }
    }
}
</script>