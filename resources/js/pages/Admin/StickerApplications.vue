<template>
    <DataTable url="/api/admin/sticker-applications" :columns="columns" :filters="filters">
        <!-- 🔥 ACTION SLOT -->
        <template #actions="{ row }">
            <div class="d-flex gap-2">

                <button v-if="row.status == 'pending'" class="btn btn-sm btn-success" @click="approve(row)">
                    Approve
                </button>

                <button v-if="row.status === 'pending'" class="btn btn-sm btn-danger ml-1" @click="deny(row)">
                    Deny
                </button>

            </div>
        </template>
    </DataTable>
</template>

<script>
import axios from 'axios'
import DataTable from './components/DataTable.vue'
import { confirmDialog, alertDialog, handleError } from '../../utils/helper'

export default {
    components: {
        DataTable
    },
    data() {
        return {
            columns: [
                {
                    label: 'Homeowner',
                    render: row => `<div>${row.homeowner?.user?.name}</div> <a href="mailto:${row.homeowner?.user?.email}">${row.homeowner?.user?.email}</a>`

                },
                {
                    label: 'Vehicle',
                    render: row => `${row.vehicle_model} - ${row.vehicle_plate}`
                },
                {
                    label: 'Status',
                    field: 'status',
                    type: 'badge'
                },
                {
                    label: 'Sticker #',
                    render: row => row.sticker_number || '-'
                }
            ],
            filters: [
                {
                    type: 'select',
                    label: 'Status',
                    model: 'status',
                    options: [
                        { label: 'All', value: '' },
                        { label: 'Pending', value: 'pending' },
                        { label: 'Payment uploaded', value: 'payment_uploaded' },
                        { label: 'Approved', value: 'approved' },
                        { label: 'Ready for pickup', value: 'ready_for_pickup' },
                        { label: 'Released', value: 'released' }

                    ]
                },
                {
                    type: 'date',
                    label: 'From',
                    model: 'from'
                },
                {
                    type: 'date',
                    label: 'To',
                    model: 'to'
                }
            ]
        }
    },
    methods: {
        loadApplications() {
            axios.get('/api/admin/sticker-applications')
                .then(res => { this.applications = res.data })
        },
        async approve(app) {
            if (await confirmDialog("Approve this application?")) {
                try {
                    const res = await axios.post(`/api/admin/sticker-applications/${app.id}/approve`, {
                        sticker_number: 'S-' + Date.now()
                    }).then(res => {
                        if (res.data?.success) {
                            alertDialog(res.data?.message)
                            return;
                        }
                        alertDialog(res.data?.message, 'warning')
                    })
                } catch (error) {
                    handleError(error)
                }
                this.loadApplications
            }
        },

        async deny(app) {
            if (await confirmDialog("Deny this application?")) {
                const res = await axios.post(`/api/admin/sticker-applications/${app.id}/deny`)

                alertDialog(res.data.message)
                this.loadApplications
            }
        }
    }
}
</script>