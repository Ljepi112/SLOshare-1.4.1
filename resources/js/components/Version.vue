<template>
    <div class="text-center">
        <button @click="checkUpdate()" class="btn btn-primary btn-md">
            <i v-if="loading" class="fa fa-circle-notch fa-spin"></i> {{ loading ? 'Loading...' : 'Check For Update' }}
        </button>
    </div>
</template>

<script>
import Swal from 'sweetalert2';

export default {
    data() {
        return {
            loading: false,
        };
    },

    methods: {
        checkUpdate() {
            this.loading = true;
            axios
                .get('/dashboard/SLOshare')
                .then((response) => {
                    if (response.data.updated === false) {
                        this.loading = false;
                        Swal.fire({
                            position: 'center',
                            icon: 'warning',
                            title: 'Na voljo je posodobitev!',
                            showCancelButton: true,
                            showConfirmButton: true,
                            confirmButtonText: '<i class="fa fa-github"></i> Prenesi iz GitLaba - SLOshare',
                            html: `Nova verzija <a href="github.com/SLODovInnovations/SLOshare/releases">${response.data.latestversion} </a> je na voljo`,
                        }).then((result) => {
                            if (result.value) {
                                window.location.assign('//github.com/SLODovInnovations/SLOshare/releases');
                            }
                        });
                    } else {
                        this.loading = false;
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Uporabljate najnovejšo različico SLOshare.eu!',
                            showCancelButton: false,
                            timer: 4500,
                        });
                    }
                })
                .catch((error) => {
                    Swal.fire('Oops...', error.response.data, 'error');
                });
        },
    },
};
</script>
