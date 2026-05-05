<template>
    <button class="btn btn-primary" :disabled="loading" @click="handleClick">
        <span v-if="loading">Processing...</span>
        <slot v-else>Submit</slot>
    </button>
</template>

<script setup>
import { ref } from 'vue'

const props = defineProps({
    siteKey: {
        type: String,
        required: true
    },
    action: {
        type: String,
        default: 'submit'
    }
})

const emit = defineEmits(['verified'])

const loading = ref(false)

const handleClick = async () => {
    loading.value = true

    try {

        const token = await window.grecaptcha.execute(props.siteKey, {
            action: props.action
        })

        emit('verified', token)

    } catch (e) {
        console.error(e)
    }

    loading.value = false
}
</script>