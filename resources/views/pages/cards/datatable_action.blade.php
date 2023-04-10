<div
    class="d-flex align-items-center gap-2"
    x-data="{
        deleteUrl: '{{ route('cards.destroy', ['card' => $card->id]) }}'
    }"
>
    <a
        class="btn btn-primary"
        href="{{ route('cards.edit', ['card' => $card->id]) }}"
    >Edit</a>
    <button
        class="btn btn-danger text-white"
        type="button"
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
                    window.LaravelDataTables['card-table'].ajax.reload()
                  })
                }
            })
        }"
    >Delete</button>
</div>