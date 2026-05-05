<template>
    <div class="container mt-5">

        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow">
                    <div class="card-body">

                        <h4 class="mb-3 text-center">Contact Us</h4>

                        <div v-if="success" class="alert alert-success">
                            {{ success }}
                        </div>

                        <div v-if="error" class="alert alert-danger">
                            {{ error }}
                        </div>

                        <form @submit.prevent="submit">

                            <div class="mb-3">
                                <label>Name</label>
                                <input v-model="form.name" class="form-control">
                                <div class="text-danger" v-if="errors.name">{{ errors.name[0] }}</div>
                            </div>

                            <div class="mb-3">
                                <label>Email</label>
                                <input v-model="form.email" class="form-control">
                                <div class="text-danger" v-if="errors.email">{{ errors.email[0] }}</div>
                            </div>

                            <div class="mb-3">
                                <label>Subject</label>
                                <input v-model="form.subject" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Message</label>
                                <textarea v-model="form.message" class="form-control" rows="4"></textarea>
                                <div class="text-danger" v-if="errors.message">{{ errors.message[0] }}</div>
                            </div>

                            <button class="btn btn-primary w-100">Send Message</button>

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
            form: {
                name: '',
                email: '',
                subject: '',
                message: ''
            },
            errors: {},
            success: '',
            error: ''
        }
    },

    methods: {

        submit() {

            this.errors = {}
            this.success = ''
            this.error = ''

            axios.post('/api/contact', this.form)
                .then(res => {

                    this.success = res.data.message

                    this.form = {
                        name: '',
                        email: '',
                        subject: '',
                        message: ''
                    }

                })
                .catch(err => {

                    if (err.response && err.response.status === 422) {
                        this.errors = err.response.data.errors
                    } else {
                        this.error = 'Something went wrong'
                    }

                })

        }

    }

}
</script>