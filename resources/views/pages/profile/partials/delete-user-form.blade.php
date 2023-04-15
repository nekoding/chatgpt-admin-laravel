<section class="space-y-6">
    <div class="card mb-4">
        <div class="card-header">
            <span class="fw-bold">{{ __('Delete Account') }}</span>
        </div>

        <div class="card-body">
            <p>
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
            </p>

            <button
                class="btn btn-tosca text-white"
                x-data="{
                    deleteUrl: '{{ route('profile.destroy') }}'
                }"
                @click="() => {
                    Swal.fire({
                        title: '{{ __('Are you sure you want to delete your account?') }}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete my account',
                        cancelButtonText: '{{ __('Cancel') }}'
                      }).then((result) => {
                        if (result.isConfirmed) {
                          axios.delete(deleteUrl)
                          .then(res => {
                            Swal.fire(
                                'Deleted!',
                                'Your account has been deleted.',
                                'success'
                            )
                          })
                          .catch(err => {
                            Swal.fire(
                                'Error!',
                                'Failed delete account!',
                                'error'
                            )
                          })
                          .finally(() => {
                            window.location.reload()
                          })
                        }
                    })
                }"
            >
                {{ __('Delete Account') }}
            </button>
        </div>
    </div>
</section>
