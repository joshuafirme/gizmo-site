<template>
    <div>

        <h3>Projects</h3>

        <button class="btn btn-primary mb-3" @click="openCreate">+ Add Project</button>

        <div class="row">
            <div class="col-md-4" v-for="p in projects" :key="p.id">
                <div class="card mb-3">
                    <img v-if="p.image" :src="'/storage/' + p.image" class="card-img-top">
                    <div class="card-body">
                        <h5>{{ p.title }}</h5>
                        <p>{{ p.description }}</p>

                        <button class="btn btn-sm btn-primary me-1" @click="edit(p)">Edit</button>
                        <button class="btn btn-sm btn-danger ml-1" @click="remove(p.id)">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="projectModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5>{{ isEdit ? 'Edit Project' : 'Add Project' }}</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <form @submit.prevent="save">

                            <input v-model="form.title" class="form-control mb-2" placeholder="Title">

                            <textarea v-model="form.description" class="form-control mb-2"
                                placeholder="Description"></textarea>

                            <input type="file" @change="handleFile" class="form-control mb-2">

                            <input type="date" v-model="form.start_date" class="form-control mb-2">
                            <input type="date" v-model="form.end_date" class="form-control mb-2">

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
            projects: [],
            form: {
                id: null,
                title: '',
                description: '',
                image: null,
                start_date: '',
                end_date: ''
            },
            isEdit: false
        }
    },

    mounted() {
        this.load()
    },

    methods: {

        load() {
            axios.get('/api/admin/projects')
                .then(res => this.projects = res.data)
                .catch(() => alertDialog('Failed to load projects', 'error'))
        },

        openCreate() {
            this.isEdit = false
            this.form = { title: '', description: '', image: null, start_date: '', end_date: '' }
            new bootstrap.Modal(document.getElementById('projectModal')).show()
        },

        edit(p) {
            this.isEdit = true
            this.form = { ...p, image: null }
            new bootstrap.Modal(document.getElementById('projectModal')).show()
        },

        handleFile(e) {
            this.form.image = e.target.files[0]
        },

        save() {

            let formData = new FormData()
            formData.append('title', this.form.title)
            formData.append('description', this.form.description)
            formData.append('start_date', this.form.start_date)
            formData.append('end_date', this.form.end_date)

            if (this.form.image) {
                formData.append('image', this.form.image)
            }

            let url = this.isEdit
                ? '/api/admin/projects/' + this.form.id
                : '/api/admin/projects'

            axios.post(url, formData)
                .then(() => {
                    this.load()
                    alertDialog('Saved successfully', 'success')
                    bootstrap.Modal.getInstance(document.getElementById('projectModal')).hide()
                })
                .catch(err => handleError(err))

        },

        remove(id) {
            if (!confirm('Delete this project?')) return

            axios.delete('/api/admin/projects/' + id)
                .then(() => {
                    this.load()
                    alertDialog('Deleted successfully', 'success')
                })
                .catch(err => handleError(err))
        },

        

    }

}
</script>