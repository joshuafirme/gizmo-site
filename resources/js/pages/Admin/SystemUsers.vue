<template>
    <div>

        <h3>System Users</h3>

        <button class="btn btn-success mb-3" @click="openCreate">+ Add User</button>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="u in users" :key="u.id">
                    <td>{{ u.name }}</td>
                    <td>{{ u.email }}</td>
                    <td>{{ u.role }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <button class="btn btn-sm btn-primary" @click="edit(u)">Edit</button>
                            <button class="btn btn-sm btn-warning ml-1" @click="openPassword(u)">Change Password</button>
                            <button class="btn btn-sm btn-danger ml-1" @click="remove(u.id)">Delete</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- CREATE / EDIT MODAL -->
        <div class="modal fade" id="userModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5>{{ isEdit ? 'Edit User' : 'Add User' }}</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <form @submit.prevent="save">

                            <div class="mb-2">
                                <label>Name</label>
                                <input v-model="form.name" class="form-control">
                            </div>

                            <div class="mb-2">
                                <label>Email</label>
                                <input v-model="form.email" class="form-control">
                            </div>

                            <div class="mb-2">
                                <label>Role</label>
                                <select v-model="form.role" class="form-control">
                                    <option value="admin">Admin</option>
                                    <option value="staff">Staff</option>
                                    <option value="guard">Guard</option>
                                </select>
                            </div>

                            <div class="mb-2" v-if="!isEdit">
                                <label>Password</label>
                                <input type="password" v-model="form.password" class="form-control">
                            </div>

                            <button class="btn btn-success mt-2">Save</button>

                        </form>

                    </div>

                </div>
            </div>
        </div>

        <!-- CHANGE PASSWORD MODAL -->
        <div class="modal fade" id="passwordModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5>Change Password</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <form @submit.prevent="changePassword">

                            <div class="mb-2">
                                <label>New Password</label>
                                <input type="password" v-model="passwordForm.password" class="form-control">
                            </div>

                            <button class="btn btn-warning mt-2">Update Password</button>

                        </form>

                    </div>

                </div>
            </div>
        </div>

    </div>
</template>

<script>
import axios from 'axios'
import { confirmDialog, alertDialog, handleError } from '../../utils/helper'

export default {

    data() {
        return {
            users: [],

            form: {
                id: null,
                name: '',
                email: '',
                role: 'admin',
                password: ''
            },

            passwordForm: {
                id: null,
                password: ''
            },

            isEdit: false
        }
    },

    mounted() {
        this.load()
    },

    methods: {

        // LOAD USERS
        load() {
            axios.get('/api/admin/users')
                .then(res => {
                    this.users = res.data
                })
                .catch(err => {
                    alertDialog('Failed to load users', 'error')
                })
        },

        // OPEN CREATE
        openCreate() {
            this.isEdit = false
            this.form = { name: '', email: '', role: 'admin', password: '' }
            new bootstrap.Modal(document.getElementById('userModal')).show()
        },

        // EDIT
        edit(u) {
            this.isEdit = true
            this.form = { ...u, password: '' }
            new bootstrap.Modal(document.getElementById('userModal')).show()
        },

        // SAVE (CREATE / UPDATE)
        save() {

            if (this.isEdit) {

                axios.put('/api/admin/users/' + this.form.id, this.form)
                    .then(res => {
                        this.load()
                        alertDialog('User updated successfully', 'success')
                        bootstrap.Modal.getInstance(document.getElementById('userModal')).hide()
                    })
                    .catch(err => {
                        handleError(err)
                    })

            } else {

                axios.post('/api/admin/users', this.form)
                    .then(res => {
                        this.load()
                        alertDialog('User created successfully', 'success')
                        bootstrap.Modal.getInstance(document.getElementById('userModal')).hide()
                    })
                    .catch(err => {
                        handleError(err)
                    })

            }

        },

        // DELETE
        async remove(id) {

            if (!await confirmDialog('Delete this user?')) return

            axios.delete('/api/admin/users/' + id)
                .then(res => {
                    this.load()
                    alertDialog('User deleted successfully', 'success')
                })
                .catch(err => {
                    handleError(err)
                })

        },

        // OPEN CHANGE PASSWORD
        openPassword(u) {
            this.passwordForm.id = u.id
            this.passwordForm.password = ''
            new bootstrap.Modal(document.getElementById('passwordModal')).show()
        },

        // CHANGE PASSWORD
        changePassword() {

            axios.post('/api/admin/users/' + this.passwordForm.id + '/change-password', {
                password: this.passwordForm.password
            })
                .then(res => {
                    alertDialog('Password updated successfully', 'success')
                    bootstrap.Modal.getInstance(document.getElementById('passwordModal')).hide()
                })
                .catch(err => {
                    handleError(err)
                })

        },


    }

}
</script>