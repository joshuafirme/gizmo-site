<template>
    <div class="container">

        <div class="card shadow">

            <div class="card-body">

                <form @submit.prevent="submitApplication">

                    <!-- Homeowner Information -->

                    <h5 class="mb-3">Homeowner Information</h5>

                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" v-model="form.name" required>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label class="form-label">Block</label>
                            <input type="text" class="form-control" v-model="form.block" required>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label class="form-label">Lot</label>
                            <input type="text" class="form-control" v-model="form.lot" required>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label class="form-label">Phase</label>
                            <input type="text" class="form-control" v-model="form.phase">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Contact Number</label>
                            <input type="text" class="form-control" v-model="form.contact_number" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" v-model="form.email" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Occupancy type</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="occupancy_type" checked required=""
                                    id="occupancy_type1">
                                <label class="form-check-label" for="occupancy_type1">
                                    Owner
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="occupancy_type" required=""
                                    id="occupancy_type2">
                                <label class="form-check-label" for="occupancy_type2">
                                    Renter
                                </label>
                            </div>
                        </div>

                    </div>


                    <!-- Vehicle Information -->

                    <h5 class="mt-4 mb-3">Vehicle Information</h5>

                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Vehicle Type</label>
                            <select class="form-control" v-model="form.vehicle_type" required>
                                <option value="">Select</option>
                                <option>Car</option>
                                <option>Motorcycle</option>
                                <option>Truck</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Plate Number</label>
                            <input type="text" class="form-control" v-model="form.vehicle_plate" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Vehicle Model</label>
                            <input type="text" class="form-control" v-model="form.vehicle_model" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">CR Number</label>
                            <input type="text" class="form-control" v-model="form.cr_number" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">OR Number</label>
                            <input type="text" class="form-control" v-model="form.or_number" required>
                        </div>

                    </div>


                    <!-- Requirements -->

                    <h5 class="mt-4 mb-3">Requirements</h5>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Upload OR/CR</label>
                            <input type="file" class="form-control" @change="handleFile($event, 'orcr')" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Valid ID</label>
                            <input type="file" class="form-control" @change="handleFile($event, 'id')" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Vehicle Photo</label>
                            <input type="file" class="form-control" @change="handleFile($event, 'vehicle_photo')"
                                required>
                        </div>
                    </div>


                    <!-- Payment -->

                    <h5 class="mt-4 mb-3">Payment</h5>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Payment Method</label>
                            <select class="form-control" v-model="form.payment_method" required>
                                <option value="">Select</option>
                                <option value="gcash">GCash</option>
                                <option value="bank">Bank Transfer</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Reference Number</label>
                            <input type="text" class="form-control" v-model="form.reference_number" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Upload Proof of Payment</label>
                            <input type="file" class="form-control" @change="handleFile($event, 'payment_proof')"
                                required>
                        </div>
                    </div>


                    <RecaptchaButton siteKey="6LctMpQsAAAAAMm7WAwW8_iHN99EtpG6ieactMTx" @verified="submitApplication">
                        Submit Application
                    </RecaptchaButton>

                </form>

            </div>
        </div>

    </div>
</template>

<script>
import axios from "axios"
import { confirmDialog, alertDialog, handleError } from '@/utils/helper'

import RecaptchaButton from '@/components/RecaptchaButton.vue'

export default {
    components: {
        RecaptchaButton
    },
    data() {

        return {

            form: {
                name: '',
                block: '',
                lot: '',
                phase: '',
                contact_number: '',
                email: '',
                vehicle_type: '',
                vehicle_plate: '',
                vehicle_model: '',
                or_number: '',
                cr_number: '',
                occupancy_type: '',
                payment_method: '',
                reference_number: ''
            },

            files: {
                orcr: null,
                id: null,
                vehicle_photo: null,
                payment_proof: null
            }

        }

    },

    methods: {

        handleFile(event, type) {
            this.files[type] = event.target.files[0]
        },

        async submitApplication(token) {

            let formData = new FormData()

            Object.keys(this.form).forEach(key => {
                formData.append(key, this.form[key])
            })

            Object.keys(this.files).forEach(key => {
                if (this.files[key]) {
                    formData.append(key, this.files[key])
                }
            })

            formData.append('recaptcha_token', token)

            try {

                await axios.post("/api/sticker/apply", formData)
                    .then(res => {
                        if (res.data?.success) {
                            Object.keys(this.form).forEach(k => this.form[k] = '')
                            Object.keys(this.files).forEach(k => this.files[k] = null)
                            alertDialog(res.data?.message)
                            return;
                        }
                        alertDialog(res.data?.message, 'warning')
                    })
                // reset form
            }
            catch (error) {
                console.log(error)
                handleError(error)
            }

        }

    }

}
</script>