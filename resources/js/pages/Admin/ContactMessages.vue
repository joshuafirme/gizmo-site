<template>
    <div>

        <h3>Contact Messages</h3>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="msg in messages" :key="msg.id">
                    <td>{{ msg.name }}</td>
                    <td>{{ msg.email }}</td>
                    <td>{{ msg.subject }}</td>
                    <td>{{ msg.message }}</td>
                    <td>
                        <span v-if="msg.is_read" class="badge bg-success">Read</span>
                        <span v-else class="badge bg-warning">Unread</span>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <button v-if="!msg.is_read" class="btn btn-sm btn-primary me-1" @click="markAsRead(msg.id)">
                                Mark Read
                            </button>

                            <button class="btn btn-sm btn-danger ml-1" @click="remove(msg.id)">
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
import axios from 'axios'
import { confirmDialog, alertDialog } from '../../utils/helper'

export default {

    data() {
        return {
            messages: []
        }
    },

    mounted() {
        this.load()
    },

    methods: {

        load() {
            axios.get('/api/admin/contact-messages')
                .then(res => this.messages = res.data)
        },

        markAsRead(id) {
            axios.post('/api/admin/contact-messages/' + id + '/read')
                .then(() => {
                    this.load()
                    alertDialog("Marked as read")
                })
        },

        async remove(id) {
            if (await confirmDialog('Delete this message?')) {
                axios.delete('/api/admin/contact-messages/' + id)
                    .then(() => this.load())
            }
        }

    }

}
</script>