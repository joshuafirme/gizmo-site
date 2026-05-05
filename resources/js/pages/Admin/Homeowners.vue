<template>
    <div>

        <h3>Homeowners</h3>
        <button class="btn btn-sm float-end btn-primary mb-3" @click="openCreate">
            + Add Homeowner
        </button>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Block</th>
                    <th>Lot</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="h in homeowners" :key="h.id">
                    <td>{{ h?.user?.name }}</td>
                    <td>{{ h.email }}</td>
                    <td>{{ h.block }}</td>
                    <td>{{ h.lot }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary me-1" @click="edit(h)">Edit</button>
                        <button class="btn btn-sm btn-danger ml-1" @click="remove(h.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5>{{ form?.id ? 'Update' : 'Add' }} Homeowner</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <form @submit.prevent="submitForm">

                            <div class="mb-2">
                                <label>Name</label>
                                <input v-model="form.user.name" class="form-control">
                            </div>

                            <div class="mb-2">
                                <label>Email</label>
                                <input v-model="form.email" class="form-control">
                            </div>

                            <div class="mb-2">
                                <label>Block</label>
                                <input v-model="form.block" class="form-control">
                            </div>

                            <div class="mb-2">
                                <label>Lot</label>
                                <input v-model="form.lot" class="form-control">
                            </div>

                            <button class="btn btn-success mt-2">Update</button>

                        </form>

                    </div>

                </div>
            </div>
        </div>

    </div>
</template>

<script>
import axios from 'axios'
import { confirmDialog, alertDialog } from '../../utils/helper'

export default {

    data() {
        return {
            homeowners: [],
            form: {
                id: null,
                user: {
                    name: ''
                },
                email: '',
                block: '',
                lot: ''
            }
        }
    },

    mounted() {
        this.load()
    },

    methods: {

        load() {
            axios.get('/api/admin/homeowners')
                .then(res => this.homeowners = res.data)
        },

        openCreate() {
            this.form = {
                id: null,
                user: {
                    name: ''
                },
                email: '',
                block: '',
                lot: ''
            }

            let modal = new bootstrap.Modal(document.getElementById('editModal'))
            modal.show()

        },
        edit(h) {
            this.form = { ...h }
            console.log(this.form)

            let modal = new bootstrap.Modal(document.getElementById('editModal'))
            modal.show()

        },
        async submitForm() {
            if (this.form?.id) {
                await this.update()
            } else {
                await this.store()
            }
        },
        store() {

            axios.post('/api/admin/homeowners', this.form)
                .then((res) => {
                    this.load()
                    if (!res.data?.success) {
                        alertDialog(res.data?.message, 'error')
                        return;
                    }

                    alertDialog(res.data?.message)
                    modal.hide()
                })

        },

        async update() {

            axios.put('/api/admin/homeowners/' + this.form.id, this.form)
                .then((res) => {
                    this.load()
                    if (!res.data?.success) {
                        alertDialog(res.data?.message, 'error')
                        return;
                    }

                    alertDialog(res.data?.message)
                    let modal = bootstrap.Modal.getInstance(document.getElementById('editModal'))
                    modal.hide()
                }).catch((e) => {
                    console.log('---------', e.message)
                })

        },

        async remove(id) {

            if (await confirmDialog('Delete this homeowner, this is irreversible?')) {
                axios.delete('/api/admin/homeowners/' + id)
                    .then(res => {
                        if (res.data?.message) {
                            this.load()
                            alertDialog(res.data?.message)
                        }
                    })

            }

        }

    }

}
</script>