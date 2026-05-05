<template>
    <div class="container mt-200">

        <h3>My Monthly Dues</h3>

        <div class="mb-3 mt-4">
            <input v-model="email" class="form-control" placeholder="Enter your email" />
            <button class="btn btn-primary mt-2" @click="loadDues">Load My Dues</button>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Month</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="due in dues" :key="due.id">
                    <td>{{ due.year }}</td>
                    <td>{{ due.month }}</td>
                    <td>{{ due.amount }}</td>
                    <td>
                        <span class="badge bg-warning" v-if="due.status == 'unpaid'">Unpaid</span>
                        <span class="badge bg-info" v-if="due.status == 'pending_verification'">Pending</span>
                        <span class="badge bg-success" v-if="due.status == 'paid'">Paid</span>
                    </td>

                    <td>
                        <button v-if="due.status == 'unpaid'" class="btn btn-sm btn-primary"
                            @click="openPaymentModal(due)">
                            Upload Payment
                        </button>
                    </td>

                </tr>
            </tbody>
        </table>

        <!-- Modal -->
        <div class="modal fade" id="paymentModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Upload Payment</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <form @submit.prevent="submitPayment">

                            <div class="mb-3">
                                <label>Amount</label>
                                <input type="number" v-model="payment.amount" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Payment Date</label>
                                <input type="date" v-model="payment.payment_date" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Payment Proof</label>
                                <input type="file" @change="handleFile" class="form-control">
                            </div>

                            <button class="btn btn-primary">Submit Payment</button>

                        </form>

                    </div>

                </div>
            </div>
        </div>

    </div>
</template>

<script>
import axios from 'axios'

export default {

    data() {
        return {
            email: '',
            dues: [],
            payment: {
                monthly_due_id: null,
                amount: '',
                payment_date: '',
                file: null
            }
        }
    },

    methods: {

        loadDues() {

            axios.get('/api/monthly-dues/my-dues', {
                params: { email: this.email }
            }).then(res => {
                this.dues = res.data
            })

        },

        openPaymentModal(due) {

            this.payment.monthly_due_id = due.id
            this.payment.amount = due.amount

            const modalEl = document.getElementById('paymentModal')
            const modal = new bootstrap.Modal(modalEl)
            modal.show()

        },

        handleFile(e) {
            this.payment.file = e.target.files[0]
        },

        submitPayment() {

            let formData = new FormData()

            formData.append('monthly_due_id', this.payment.monthly_due_id)
            formData.append('amount', this.payment.amount)
            formData.append('payment_date', this.payment.payment_date)
            formData.append('payment_proof', this.payment.file)

            axios.post('/api/monthly-dues/upload-payment', formData)
                .then(res => {
                    alert(res.data.message)
                    this.loadDues()

                    let modal = bootstrap.Modal.getInstance(document.getElementById('paymentModal'))
                    modal.hide()
                })

        }

    }

}
</script>