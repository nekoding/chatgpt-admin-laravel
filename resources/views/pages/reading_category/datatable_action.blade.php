<div
    class="d-flex align-items-center gap-2"
    x-data="{
        deleteUrl: '{{ route('reading-categories.destroy', ['reading_category' => $language->id]) }}'
    }"
>
    <a
        class="btn btn-tosca"
        href="{{ route('reading-categories.edit', [
            'reading_category' => $language->id,
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
                        'Your data has been deleted.',
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
                    window.LaravelDataTables['tarotreadingcategory-table'].ajax.reload()
                  })
                }
            })
        }"
    >Delete</button>
</div>
