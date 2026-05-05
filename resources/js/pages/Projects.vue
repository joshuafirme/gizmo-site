<template>

    <section id="services" class="service-section pt-5 pb-150">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8">
                    <div class="section-title text-center">
                        <span class="wow fadeInUp" data-wow-delay=".2s">Projects</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3" v-for="p in projects" :key="p.id">
                    <div class="card shadow-sm mb-3 h-100">

                        <img v-if="p.image" :src="'/storage/' + p.image" class="card-img-top">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ p.title }}</h5>

                            <p class="card-text text-muted" style="flex-grow:1;">
                                {{ truncate(p.description) }}
                            </p>

                            <small class="text-muted" v-if="p.start_date">
                                {{ formatDate(p.start_date) }} - {{ formatDate(p.end_date) }}
                            </small>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            projects: []
        }
    },
    methods: {
        loadProjects() {
            axios.get('/api/projects')
                .then(res => {
                    this.projects = res.data.slice(0, 3) // show only 3
                })
                .catch(() => alertDialog('Failed to load projects', 'error'))
        },
        truncate(text) {
            return text.length > 100 ? text.substring(0, 100) + '...' : text
        },

        formatDate(date) {
            return new Date(date).toLocaleDateString()
        },
    },
    mounted() {
        this.loadProjects()
    },

}
</script>