<template>




    <!-- ================= HERO ================= -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-6">
                    <div class="hero-content wow fadeInUp" data-wow-delay=".3s">
                        <h1>{{ data.banner.title }}</h1>
                        <p>{{ data.banner.subtitle }}</p>

                        <a v-if="data.banner.button_text" href="#" class="main-btn btn-hover">
                            {{ data.banner.button_text }}
                        </a>
                    </div>
                </div>

                <div class="col-lg-6" v-if="data.banner_image">
                    <div class="hero-img wow fadeInUp" data-wow-delay="0.5s">
                        <img :src="data.banner_image" alt="">
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ================= FEATURES ================= -->
    <section id="services" class="service-section pt-150" v-if="data.features.length">
        <div class="container">

            <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.8s">
                <div class="col-xl-6 col-lg-8">
                    <div class="section-title text-center mb-3">
                        <h1>Features</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6" v-for="(feature, index) in data.features" :key="index">

                    <div class="single-service wow fadeInUp" data-wow-delay="1.0s">
                        <div class="content">
                            <h3>{{ feature.title }}</h3>
                            <p>{{ feature.description }}</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <About :data="data" />



</template>

<script>
import { getLandingData } from '@/utils/helper'
import axios from 'axios'
import About from "./About.vue"

export default {
    components: {
        About
    },
    data() {
        return {
            data: {
                banner: { title: '', subtitle: '', button_text: '' },
                features: [],
                about: ''
            },
            banner_image: '',
            about_cover_image: '',
            form: {
                name: '',
                email: '',
                message: ''
            },
            preview: {
                logo: ''
            },
            stats: [
                { label: 'Registered Homeowners', value: 240 },
                { label: 'Monthly Transactions', value: '1,350' },
                { label: 'Service Requests', value: 180 }
            ]
        }
    },
    mounted() {
        this.getLandingData()
    },
    methods: {

        loadOfficers() {
            axios.get('/api/officers')
                .then(res => {
                    this.officers = res.data.slice(0, 4) // show 4
                })
                .catch(() => alertDialog('Failed to load officers', 'error'))
        },

        async getLandingData() {
            try {
                const res = await axios.get('/storage/landing.json')
                if (res.data) {
                    // Now this.data is guaranteed to exist
                    this.data.banner = res.data.banner || { title: '', subtitle: '', button_text: '' }
                    this.data.features = res.data.features || []
                    this.data.about = res.data.about || ''
                    this.data.banner_image = res.data.banner_image || ''
                    this.data.about_cover_image = res.data.about_cover_image || ''
                    if (res.data.logo) this.preview.logo = res.data.logo
                }
            } catch (err) {
                console.error('Failed to fetch landing data', err)
            }
        }
    }
}
</script>