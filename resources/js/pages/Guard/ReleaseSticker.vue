<template>

    <div>

        <h3>Release Sticker</h3>

        <table class="table table-bordered mt-4">

            <thead>

                <tr>
                    <th>Homeowner</th>
                    <th>Plate</th>
                    <th>Vehicle</th>
                    <th>Sticker Number</th>
                    <th>Action</th>
                </tr>

            </thead>

            <tbody>

                <tr v-for="app in stickers" :key="app.id">

                    <td>
                        {{ app.homeowner?.user?.name }}
                        <div><a  :href="'mailto:'+app.homeowner?.user?.email">{{ app.homeowner?.user?.email }}</a></div>
                    </td>
                    <td>{{ app.vehicle_plate }}</td>
                    <td>{{ app.vehicle_model }} ({{ app.vehicle_type }})</td>

                    <td>{{ app.sticker_number }}</td>

                    <td>

                        <button class="btn btn-primary btn-sm" @click="release(app.id)">
                            Release
                        </button>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</template>

<script>

import axios from "axios"
import { confirmDialog, alertDialog } from '../../utils/helper'

export default {

    data() {

        return {

            stickers: []

        }

    },

    async mounted() {

        let res = await axios.get('/api/admin/guard/stickers-ready')
        this.stickers = res.data

    },

    methods: {

        async release(id) {

            if (await confirmDialog("Are you sure do you want to update the status to release?")) {
                await axios.post('/api/admin/guard/release', { id })

                alertDialog("Sticker Released")
            }

        }

    }

}

</script>