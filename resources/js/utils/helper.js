import Swal from 'sweetalert2'
import axios from 'axios'

// Confirm dialog
export async function confirmDialog(message = 'Are you sure?') {
    const result = await Swal.fire({
        title: 'Confirm',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
    })

    return result.isConfirmed
}

// Success alert
export function alertDialog(message = '', type = 'success', title = '') {
    return Swal.fire({
        icon: type,
        title: title,
        html: message
    })
}

export async function getSettingsData() {

    await axios.get('/storage/general_settings.json')
        .then(res => {
            if (res.data) {
                // Ensure the keys exist
                this.data.app = res.data.app || {
                    title: '',
                    subtitle: '',
                    button_text: ''
                };
                if (res.data.logo) this.preview.logo = res.data.logo;
            }
        })
        .catch(() => {});
}

export async function getLandingData() {

    await axios.get('/storage/landing.json')
        .then(res => {
            if (res.data) {
                // Ensure the keys exist
                this.data.banner = res.data.banner || {
                    title: '',
                    subtitle: '',
                    button_text: ''
                };
                this.data.features = res.data.features || [];
                this.data.about = res.data.about || '';
                if (res.data.logo) this.preview.logo = res.data.logo;
            }
        })
        .catch(() => {});
}

export async function getMonthlyDue() {
    return await axios.get('/storage/monthly_due.json')
        .then(res => {
            if (res.data) {
                return res.data.monthly_due;
            }
        })
        .catch(() => {});
}

export function handleError(err) {

    if (err.response) {

        if (err.response.status === 422) {
            let errors = err.response.data.errors
            alertDialog(Object.values(errors)[0][0], 'error')
            return
        }

        if (err.response.data.message) {
            alertDialog(err.response.data.message, 'error')
            return
        }

    }

    alertDialog('Something went wrong', 'error')

}


export function getMonth(monthIndex) {
    const date = new Date(2000, monthIndex, 1); // Use the month index to create a date object
    return date.toLocaleString('default', {
        month: 'long'
    });

}

export function formatDate(value) {
    const date = new Date(value); // Or any specific date

    return date.toLocaleString('default', {
        year: 'numeric',
        month: 'long',
        day: '2-digit'
    });


}
