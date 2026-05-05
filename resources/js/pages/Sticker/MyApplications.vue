<template>
    <div class="container mt-200" style="margin-top: 200px;">

        <div class="card shadow mb-4">
            <div class="card-header">
                <h4>Check My Sticker Applications</h4>
            </div>

            <div class="card-body">

                <form @submit.prevent="fetchApplications" class="row g-3 mb-4">

                    <div class="col-md-4">
                        <input type="email" class="form-control" placeholder="Email" v-model="homeowner.email" required>
                    </div>

                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="Block" v-model="homeowner.block" required>
                    </div>

                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="Lot" v-model="homeowner.lot" required>
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-primary w-100" type="submit">Search</button>
                    </div>

                </form>

                <div v-if="loading" class="text-center my-4">
                    Loading...
                </div>

                <div v-if="error" class="alert alert-danger">{{ error }}</div>

                <div v-if="applications.length">

                    <h5>Homeowner: {{ homeownerInfo.name }} ({{ homeownerInfo.email }})</h5>
                    <p>Block {{ homeownerInfo.block }}, Lot {{ homeownerInfo.lot }}, Phase {{ homeownerInfo.phase }}</p>

                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Vehicle</th>
                                <th>Plate</th>
                                <th>Status</th>
                                <th>Sticker Number</th>
                                <th>Documents</th>
                                <th>Payment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(app, index) in applications" :key="app.id">
                                <td>{{ index + 1 }}</td>
                                <td>{{ app.vehicle_model }} ({{ app.vehicle_type }})</td>
                                <td>{{ app.vehicle_plate }}</td>
                                <td>
                                    <span :class="statusClass(app.status)">
                                        {{ app.status.replace('_', ' ').toUpperCase() }}
                                    </span>
                                </td>
                                <td>{{ app.sticker_number || '-' }}</td>
                                <td>
                                    <ul class="list-unstyled mb-0">
                                        <li v-for="doc in app.documents" :key="doc.id">
                                            <a :href="fileUrl(doc.file_path)" target="_blank">{{
                                                doc.document_type.toUpperCase() }}</a>
                                        </li>
                                    </ul>
                                </td>
                                <td>
                                    <div v-if="app.payment">
                                        Method: {{ app.payment.payment_method.toUpperCase() }}<br>
                                        Ref#: {{ app.payment.reference_number }}<br>
                                        <a :href="fileUrl(app.payment.proof_image)" target="_blank">Proof</a>
                                    </div>
                                    <div v-else>-</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>

                <div v-else-if="!loading && !error">
                    <p>No applications found.</p>
                </div>

            </div>
        </div>

    </div>
</template>

<script>
import axios from "axios"

export default {
    data() {
        return {
            homeowner: {
                email: '',
                block: '',
                lot: ''
            },
            homeownerInfo: {},
            applications: [],
            loading: false,
            error: ''
        }
    },
    methods: {

        async fetchApplications() {

            this.loading = true
            this.error = ''
            this.applications = []

            try {
                const res = await axios.post('/api/sticker/my-applications', this.homeowner)
                this.homeownerInfo = res.data.homeowner
                this.applications = res.data.applications
            }
            catch (err) {
                if (err.response && err.response.status === 404) {
                    this.error = 'Homeowner not found or no applications submitted.'
                } else if (err.response && err.response.status === 422) {
                    this.error = 'Please fill in all fields correctly.'
                } else {
                    this.error = 'An error occurred while fetching applications.'
                }
            }
            finally {
                this.loading = false
            }

        },

        fileUrl(path) {
            // assuming storage is linked: php artisan storage:link
            return path ? `/storage/${path}` : '#'
        },

        statusClass(status) {
            switch (status) {
                case 'pending':
                    return 'badge bg-warning'
                case 'ready_for_pickup':
                    return 'badge bg-info'
                case 'released':
                    return 'badge bg-success'
                case 'denied':
                    return 'badge bg-danger'
                default:
                    return 'badge bg-secondary'
            }
        }

    }
}
</script>