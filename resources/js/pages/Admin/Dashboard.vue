<template>
    <div>
        <h3>Admin Dashboard</h3>
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Sticker Applications</h5>
                        <p class="card-text">{{ stickerCount }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Pending Payments</h5>
                        <p class="card-text">{{ pendingPayments }}</p>
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
            stickerCount: 0,
            pendingPayments: 0
        }
    },
    mounted() {
        axios.get('/api/admin/dashboard').then(res => {
            this.stickerCount = res.data?.sticker_applications ? res.data.sticker_applications : 0
            this.pendingPayments = res.data?.pending_payments ? res.data.pending_payments : 0
        })
    }
}
</script>