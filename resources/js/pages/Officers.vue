<template>
    <div class="container mt-4">

        <h2 class="text-center mb-4">HOA Officers</h2>

        <div class="row">

            <div class="col-md-3 col-sm-6 mb-4" v-for="o in officers" :key="o.id">
                <div class="card shadow-sm h-100 text-center officer-card">

                    <img v-if="o.photo" :src="'/storage/' + o.photo" class="card-img-top officer-img">

                    <div class="card-body">

                        <h5 class="mb-1">{{ o.name }}</h5>
                        <p class="text-muted">{{ o.position }}</p>

                        <button class="btn btn-outline-primary btn-sm" @click="viewOfficer(o)">
                            View Profile
                        </button>

                    </div>

                </div>
            </div>

        </div>

        <!-- PROFILE MODAL -->
        <div class="modal fade" id="officerModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5>{{ selectedOfficer.name }}</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-4 text-center">
                                <img v-if="selectedOfficer.photo" :src="'/storage/' + selectedOfficer.photo"
                                    class="img-fluid rounded mb-3">
                            </div>

                            <div class="col-md-8">

                                <h4>{{ selectedOfficer.name }}</h4>
                                <p class="text-muted">{{ selectedOfficer.position }}</p>

                                <hr>

                                <p>{{ selectedOfficer.profile }}</p>

                            </div>

                        </div>

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
            officers: [],
            selectedOfficer: {}
        }
    },

    mounted() {
        this.load()
    },

    methods: {

        load() {
            axios.get('/api/officers')
                .then(res => {
                    this.officers = res.data
                })
                .catch(() => {
                    alertDialog('Failed to load officers', 'error')
                })
        },

        viewOfficer(o) {
            this.selectedOfficer = o
            new bootstrap.Modal(document.getElementById('officerModal')).show()
        }

    }

}
</script>

<style scoped>
.officer-img {
    height: 250px;
    object-fit: cover;
}

.officer-card {
    transition: 0.3s;
}

.officer-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
}
</style>