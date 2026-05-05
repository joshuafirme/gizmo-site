<template>
    <div>

        <h3>Officers</h3>

        <button class="btn btn-success mb-3" @click="openCreate">+ Add Officer</button>

        <div class="row">
            <div class="col-md-3" v-for="o in officers" :key="o.id">
                <div class="card text-center">
                    <img v-if="o.photo" :src="'/storage/' + o.photo" class="card-img-top">
                    <div class="card-body">
                        <h5>{{ o.name }}</h5>
                        <p>{{ o.position }}</p>

                        <button class="btn btn-sm btn-primary me-1" @click="edit(o)">Edit</button>
                        <button class="btn btn-sm btn-danger ml-1" @click="remove(o.id)">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="officerModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5>{{ isEdit ? 'Edit Officer' : 'Add Officer' }}</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <form @submit.prevent="save">

                            <input v-model="form.name" class="form-control mb-2" placeholder="Name">
                            <input v-model="form.position" class="form-control mb-2" placeholder="Position">

                            <textarea v-model="form.profile" class="form-control mb-2" placeholder="Profile"></textarea>

                            <input type="file" @change="handleFile" class="form-control mb-2">

                            <button class="btn btn-primary">Save</button>

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
            officers: [],
            form: {
                id: null,
                name: '',
                position: '',
                profile: '',
                photo: null
            },
            isEdit: false
        }
    },

    mounted() {
        this.load()
    },

    methods: {

        load() {
            axios.get('/api/admin/officers')
                .then(res => this.officers = res.data)
                .catch(() => alertDialog('Failed to load officers', 'error'))
        },

        openCreate() {
            this.isEdit = false
            this.form = { name: '', position: '', profile: '', photo: null }
            new bootstrap.Modal(document.getElementById('officerModal')).show()
        },

        edit(o) {
            this.isEdit = true
            this.form = { ...o, photo: null }
            new bootstrap.Modal(document.getElementById('officerModal')).show()
        },

        handleFile(e) {
            this.form.photo = e.target.files[0]
        },

        save() {

            let formData = new FormData()
            formData.append('name', this.form.name)
            formData.append('position', this.form.position)
            formData.append('profile', this.form.profile)

            if (this.form.photo) {
                formData.append('photo', this.form.photo)
            }

            let url = this.isEdit
                ? '/api/admin/officers/' + this.form.id
                : '/api/admin/officers'

            axios.post(url, formData)
                .then(() => {
                    this.load()
                    alertDialog('Saved successfully', 'success')
                    bootstrap.Modal.getInstance(document.getElementById('officerModal')).hide()
                })
                .catch(err => this.handleError(err))

        },

        remove(id) {
            if (!confirm('Delete this officer?')) return

            axios.delete('/api/admin/officers/' + id)
                .then(() => {
                    this.load()
                    alertDialog('Deleted successfully', 'success')
                })
                .catch(err => this.handleError(err))
        },

        handleError(err) {

            if (err.response) {

                if (err.response.status === 422) {
                    let errors = err.response.data.errors
                    alertDialog(Object.values(errors)[0][0], 'error')
                    return
                }

                if (err.response.data.message) {
                    alertDialog(err.response.data.message, 'error')
                    return
                }

            }

            alertDialog('Something went wrong', 'error')

        }

    }

}
</script>