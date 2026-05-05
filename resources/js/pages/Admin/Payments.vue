<template>
    <DataTable url="/api/admin/monthly-dues" :columns="columns" :filters="filters">
        <!-- 🔥 ACTION SLOT -->
        <template #actions="{ row }">
            <div class="d-flex gap-1">
                <button v-if="row.status == 'pending_verification'" class="btn btn-success btn-sm"
                    @click="approve(row)">Approve</button>
                <button v-if="row.status == 'unpaid'" class="btn btn-warning btn-sm"
                    @click="override(row)">Override</button>

            </div>
        </template>
    </DataTable>
</template>

<script>
import axios from 'axios'
import { confirmDialog, alertDialog, getMonth, formatDate } from '../../utils/helper'
import DataTable from './components/DataTable.vue'

export default {
    components: {
        DataTable
    },
    data() {
        return {
            columns: [
                {
                    label: 'Homeowner',
                    render: row => row.homeowner?.user?.name
                },
                {
                    label: 'Month',
                    render: row => `${getMonth(row.month)} ${row.year}`
                },
                {
                    label: 'Amount',
                    render: row => row.amount
                },
                {
                    label: 'Status',
                    field: 'status',
                    type: 'badge'
                },
                {
                    label: 'Created',
                    render: row => formatDate(row.created_at)
                },
            ],
            filters: [
                {
                    type: 'select',
                    label: 'Status',
                    model: 'status',
                    options: [
                        { label: 'All', value: '' },
                        { label: 'Pending verification', value: 'pending_verification' },
                        { label: 'Unpaid', value: 'unpaid' },
                        { label: 'Paid', value: 'paid' }
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
        async approve(due) {
            if (await confirmDialog("Are you sure do you want to approve this payment?")) {
                axios.post('/api/admin/monthly-dues/' + due.id + '/approve').then(() => this.loadDues())
                    .then(res => {
                        if (res.data?.message) {
                            this.$refs.table.fetchData?.()
                            alertDialog(res.data?.message)
                            return
                        }

                        alertDialog(res.data?.message, 'error')
                    })
            }

        },
        async override(due) {

            let msg = "Are you sure do you want to overried payment status to Paid?";
            if (await confirmDialog(msg)) {
                axios.post('/api/admin/monthly-dues/' + due.id + '/override')
                    .then(res => {
                        if (res.data?.message) {
                            this.$refs.table.fetchData?.()
                            alertDialog(res.data?.message)
                            return
                        }

                        alertDialog(res.data?.message, 'error')
                    })
            }
        }
    }
}
</script>