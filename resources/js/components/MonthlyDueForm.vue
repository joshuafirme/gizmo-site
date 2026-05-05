<template>
    <div class="container mt-200">

        <div class="card shadow">
            <div class="card-header">
                <h4>Pay Monthly Dues</h4>
            </div>

            <div class="card-body">

                <form @submit.prevent="submitPayment">

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control" v-model="email" @blur="lookupHomeowner">
                    </div>

                    <div v-if="homeowner">

                        <p><strong>Name:</strong> {{ homeowner?.name }}</p>
                        <p><strong>Block/Lot:</strong> {{ homeowner.block }}/{{ homeowner.lot }}</p>

                    </div>

                    <div v-if="monthlyDue">

                        <p><strong>Month:</strong> {{ monthlyDue.month }}/{{ monthlyDue.year }}</p>
                        <p><strong>Amount:</strong> ₱{{ monthlyDue.amount }}</p>

                    </div>

                    <div v-if="monthlyDue">

                        <div class="mb-3">
                            <label>Payment Amount</label>
                            <input type="number" class="form-control" v-model="amount">
                        </div>

                        <div class="mb-3">
                            <label>Payment Date</label>
                            <input type="date" class="form-control" v-model="payment_date">
                        </div>

                        <div class="mb-3">
                            <label>Reference Number</label>
                            <input type="text" class="form-control" v-model="reference_number">
                        </div>

                        <div class="mb-3">
                            <label>Upload Proof</label>
                            <input type="file" class="form-control" @change="handleFile">
                        </div>

                        <button class="btn btn-primary">
                            Submit Payment
                        </button>

                    </div>

                </form>

                <div v-if="success" class="alert alert-success mt-3">
                    {{ success }}
                </div>

                <div v-if="error" class="alert alert-danger mt-3">
                    {{ error }}
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

            email: '',
            homeowner: null,
            monthlyDue: null,

            amount: '',
            payment_date: '',
            reference_number: '',
            proof: null,

            success: '',
            error: ''

        }
    },

    methods: {

        handleFile(e) {
            this.proof = e.target.files[0]
        },

        async lookupHomeowner() {

            try {

                let res = await axios.post('/api/monthly-dues/lookup', {
                    email: this.email
                })

                this.homeowner = res.data.homeowner
                this.monthlyDue = res.data.due

                this.amount = this.monthlyDue.amount

            } catch (err) {
                console.error(err)
                this.error = 'Homeowner or monthly due not found'

            }

        },

        async submitPayment() {

            let formData = new FormData()

            formData.append('monthly_due_id', this.monthlyDue?.id)
            formData.append('amount', this.amount)
            formData.append('payment_date', this.payment_date)
            formData.append('reference_number', this.reference_number)

            if (this.proof) {
                formData.append('proof', this.proof)
            }

            try {

                await axios.post('/api/monthly-dues/pay', formData)

                this.success = 'Payment submitted successfully'

            } catch (err) {

                this.error = 'Payment failed'

            }

        }

    }

}
</script>