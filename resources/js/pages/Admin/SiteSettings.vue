<template>
    <div class="mb-5">
        <h3>Site Settings</h3>
        <div class="d-flex align-items-start gap-2">
            <div style="width: 200px;" class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                aria-orientation="vertical">
                <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                    data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                    aria-selected="true">General</button>
                <button class="nav-link" id="v-pills-monthly-due-tab" data-bs-toggle="pill"
                    data-bs-target="#v-pills-monthly-due" type="button" role="tab" aria-controls="v-pills-monthly-due"
                    aria-selected="false">Set Monthly Due</button>
                <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                    data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile"
                    aria-selected="false">Landing Page</button>
                <button class="nav-link" id="v-pills-frontends-tab" data-bs-toggle="pill"
                    data-bs-target="#v-pills-frontends" type="button" role="tab" aria-controls="v-pills-frontends"
                    aria-selected="false">Frontends</button>
            </div>
            <div class="tab-content w-100 ml-2" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                    aria-labelledby="v-pills-home-tab">

                    <div class="card mb-4">
                        <div class="card-header">Application Details</div>
                        <div class="card-body">
                            <label class="form-label small">Title</label>
                            <input v-model="data.app.title" class="form-control mb-2" placeholder="Title">
                            <label class="form-label small">Description</label>
                            <input v-model="data.app.description" class="form-control mb-2" placeholder="Description">
                            <label class="form-label small">Version</label>
                            <input v-model="data.app.version" type="number" step="0.1" class="form-control mb-2"
                                placeholder="App version">
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">Site Logo</div>
                        <div class="card-body">
                            <input type="file" class="form-control" @change="handleLogoUpload">
                            <div v-if="preview.logo" class="mt-3">
                                <img :src="preview.logo" class="img-fluid" style="max-height:100px;">
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button class="btn btn-primary" @click="saveGeneralSettings">Save</button>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-monthly-due" role="tabpanel"
                    aria-labelledby="v-pills-monthly-due-tab">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <label class="form-label small">Monthly Due Amount</label>
                                    <input v-model="data.monthly_due.amount" class="form-control mb-2">
                                    <div class="text-end">
                                        <button class="btn btn-primary" @click="saveMonthlyDue">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="alert alert-warning small" role="alert">
                                <font-awesome-icon icon="circle-info" /> This will generate monthly dues for all users.
                            </div>
                            <button class="btn btn-primary mb-4" @click="runDues">
                                <font-awesome-icon icon="terminal" />
                                <span v-if="run_dues_loading">Executing command...</span>
                                <span v-else>Run Dues</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <!-- Banner -->
                    <div class="card mb-4">
                        <div class="card-header">Banner Section</div>
                        <div class="card-body">
                            <label class="form-label small">Title</label>
                            <input v-model="data.banner.title" class="form-control mb-2" placeholder="Title">
                            <label class="form-label small">Subtitle</label>
                            <input v-model="data.banner.subtitle" class="form-control mb-2" placeholder="Subtitle">
                            <label class="form-label small">Button text</label>
                            <input v-model="data.banner.button_text" class="form-control" placeholder="Button Text">
                            <label class="form-label">Background Image</label>
                            <input type="file" class="form-control" @change="handleBannerUpload">

                            <div v-if="preview.banner" class="mt-3">
                                <img :src="preview.banner" class="img-fluid" style="max-height:150px;">
                            </div>
                        </div>
                    </div>

                    <!-- Features -->
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between">
                            <span>Features</span>
                            <button class="btn btn-sm btn-primary" @click="addFeature">Add</button>
                        </div>
                        <div class="card-body">
                            <div v-for="(feature, index) in data.features" :key="index" class="border p-3 mb-2 rounded">
                                <input v-model="feature.title" class="form-control mb-2" placeholder="Feature Title">
                                <textarea v-model="feature.description" class="form-control mb-2"
                                    placeholder="Description"></textarea>
                                <button class="btn btn-danger btn-sm" @click="removeFeature(index)">Remove</button>
                            </div>
                        </div>
                    </div>

                    <!-- About -->
                    <div class="card mb-4">
                        <div class="card-header">About Section</div>
                        <div class="card-body">
                            <label class="form-label small">Title</label>
                            <input v-model="data.about.title" class="form-control mb-2" placeholder="Title">
                            <label class="form-label small">Description</label>
                            <textarea v-model="data.about.description" class="form-control" rows="4"></textarea>
                            <label class="form-label small">Image</label>
                            <input type="file" class="form-control" @change="handleCoverImgUpload">
                            <div v-if="about_cover_img" class="mt-3">
                                <img :src="about_cover_img" class="img-fluid" style="max-height:100px;">
                            </div>
                        </div>
                    </div>

                    <!-- Save -->
                    <div class="text-end">
                        <button class="btn btn-primary" @click="saveLandingPage">Save</button>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-frontends" role="tabpanel"
                    aria-labelledby="v-pills-frontends-tab">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="projects-tab" data-bs-toggle="tab"
                                data-bs-target="#projects" type="button" role="tab" aria-controls="projects"
                                aria-selected="true">Projects</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="officers-tab" data-bs-toggle="tab" data-bs-target="#officers"
                                type="button" role="tab" aria-controls="officers"
                                aria-selected="false">Officers</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="projects" role="tabpanel"
                            aria-labelledby="projects-tab">
                            <Projects />
                        </div>
                        <div class="tab-pane fade" id="officers" role="tabpanel" aria-labelledby="officers-tab">
                            <Officers />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import { alertDialog } from '../../utils/helper'
import Projects from './Projects.vue'
import Officers from './Officers.vue'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

export default {
    components: {
        Projects,
        Officers
    },
    data() {
        return {
            data: {
                app: { title: '', description: '', version: '' },
                banner: { title: '', subtitle: '', button_text: '' },
                features: [],
                about: { title: '', description: '' },
                monthly_due: {
                    amount: null
                }
            },
            logoFile: null,
            aboutCoverImg: null,
            bannerFile: null,
            about_cover_img: null,
            preview: { logo: null },
            run_dues_loading: false
        }
    },
    methods: {
        handleLogoUpload(e) {
            const file = e.target.files[0];
            this.logoFile = file;
            if (file) this.preview.logo = URL.createObjectURL(file);
        },
        handleCoverImgUpload(e) {
            const file = e.target.files[0];
            this.aboutCoverImg = file;
            if (file) this.about_cover_img = URL.createObjectURL(file);
        },
        handleBannerUpload(e) {
            const file = e.target.files[0];
            this.bannerFile = file;
            if (file) this.preview.banner = URL.createObjectURL(file);
        },

        addFeature() {
            this.data.features.push({ title: '', description: '' });
        },

        removeFeature(index) {
            this.data.features.splice(index, 1);
        },

        saveGeneralSettings() {
            const formData = new FormData();

            // Only include fields that exist in your data
            const payload = {};

            if (this.data.app) {
                payload.app = {};

                if (this.data.app.title) payload.app.title = this.data.app.title;
                if (this.data.app.description) payload.app.description = this.data.app.description;
                if (this.data.app.version !== undefined) payload.app.version = this.data.app.version;
            }

            formData.append('data', JSON.stringify(payload));
            // Only append logo if a file is selected
            if (this.logoFile) {
                formData.append('logo', this.logoFile);
            }

            axios.post('/api/admin/save-general-settings', formData, {
                headers: { 'Content-Type': 'multipart/form-data' }
            })
                .then(res => {
                    if (res.data?.message) {
                        alertDialog(res.data.message);
                        return;
                    }
                    alertDialog(res.data?.message, 'error');
                })
                .catch(() => alert('Error saving data'));
        },

        async runDues() {
            this.run_dues_loading = true;
            await axios.post('/api/admin/run-dues')
                .then(res => {
                    console.log(res.data)
                    if (res.data?.message) {
                        alertDialog(res.data.message);
                        return;
                    }
                    alertDialog(res.data?.message + `<div>Output: ${res.data?.output}</div>`, 'error');
                })
                .catch(() => alert('Error saving data'));

            this.run_dues_loading = false;
        },
        saveMonthlyDue() {
            const formData = new FormData();

            // Only include fields that exist in your data
            const payload = {};

            if (this.data.app) {
                payload.monthly_due = {};
                console.log(this.data)
                if (this.data.monthly_due.amount) payload.monthly_due.amount = this.data.monthly_due.amount;
            }
            formData.append('data', JSON.stringify(payload));

            axios.post('/api/admin/save-monthly-due', formData, {
                headers: { 'Content-Type': 'multipart/form-data' }
            })
                .then(res => {
                    if (res.data?.message) {
                        alertDialog(res.data.message);
                        return;
                    }
                    alertDialog(res.data?.message, 'error');
                })
                .catch(() => alert('Error saving data'));
        },
        saveLandingPage() {
            const payload = {
                banner: this.data.banner || {},
                features: this.data.features || [],
                about: {
                    title: this.data.about?.title || '',
                    description: this.data.about?.description || ''
                }
            };

            const formData = new FormData();
            formData.append('data', JSON.stringify(payload));

            if (this.bannerFile) {
                formData.append('banner_image', this.bannerFile);
            }

            if (this.aboutCoverImg) {
                formData.append('about_cover_image', this.aboutCoverImg);
            }

            axios.post('/api/admin/save-landing', formData, {
                headers: { 'Content-Type': 'multipart/form-data' }
            })
                .then(res => {
                    alertDialog(res.data?.message || 'Saved successfully!');
                })
                .catch(err => {
                    console.error(err);
                    alertDialog('Error saving data', 'error');
                });
        }
    },
    mounted() {
        axios.get('/storage/landing.json')
            .then(res => {
                if (res.data) {
                    // Ensure the keys exist
                    this.data.banner = res.data.banner || { title: '', subtitle: '', button_text: '' };
                    this.data.features = res.data.features || [];
                    this.data.about = res.data.about || { title: '', description: '' };
                    if (res.data.logo) this.preview.logo = res.data.logo;
                }
            })
            .catch(() => { });

        axios.get('/storage/general_settings.json')
            .then(res => {
                if (res.data) {
                    // Ensure the keys exist
                    this.data.app = res.data.app || { title: '', subtitle: '', button_text: '' };
                    if (res.data.logo) this.preview.logo = res.data.logo;
                }
            })
            .catch(() => { });

        axios.get('/storage/monthly_due.json')
            .then(res => {
                if (res.data) {
                    // Ensure the keys exist
                    this.data.monthly_due.amount = res.data.monthly_due.amount || '';
                }
            })
            .catch(() => { });
    }
}
</script>