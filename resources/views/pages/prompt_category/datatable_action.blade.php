<div
    class="d-flex align-items-center gap-2"
    x-data="{
        deleteUrl: '{{ route('languages.destroy', ['language' => $language->id]) }}'
    }"
>
    <a
        class="btn btn-tosca"
        href="{{ route('languages.edit', [
            'language' => $language->id,
        ]) }}"
    >Edit</a>
    <button
        class="btn btn-tosca text-white"
        type="button"
        href="#"
        @click="() => {
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result.isConfirmed) {
                  axios.delete(deleteUrl)
                  .then(res => {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                  })
                  .catch(err => {
                    Swal.fire(
                        'Error!',
                        'Failed delete data!',
                        'error'
                    )
                  })
                  .finally(() => {
                    window.LaravelDataTables['language-table'].ajax.reload()
                  })
                }
            })
        }"
    >Delete</button>
</div>
