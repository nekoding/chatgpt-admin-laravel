<x-app-layout>
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <span class="fw-bold">Tarot Reading Category Management</span>

                <div class="d-flex align-items-center gap-2">
                    <button
                        class="btn btn-tosca text-white"
                        data-coreui-toggle="modal"
                        data-coreui-target="#importdata"
                        type="button"
                    >Import</button>
                    <a
                        class="btn btn-tosca text-white"
                        href="{{ route('reading-categories.create') }}"
                    >Add</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>

    <x-modal
        id="importdata"
        title="Import Data"
    >
        <input
            class="uploader"
            name="file"
            type="file"
        />

        <x-slot:footer>
            <div x-data="">
                <button
                    class="btn btn-tosca"
                    data-coreui-dismiss="modal"
                    type="button"
                >Close</button>
            </div>
        </x-slot:footer>
    </x-modal>

    @push('head')
        <link
            href="https://unpkg.com/filepond@^4/dist/filepond.css"
            rel="stylesheet"
        />
    @endpush

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
        <script src="https://unpkg.com/filepond/dist/filepond.min.js" type="module"></script>
        <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js" type="module"></script>

        {{ $dataTable->scripts() }}

        <script>
            $(function() {
                $('.uploader').filepond();
                $('.uploader').filepond('allowMultiple', false);

                FilePond.setOptions({
                    server: {
                        process: {
                            url: `{{ route('languages.import') }}`,
                            headers: {
                                'X-CSRF-TOKEN': `{{ csrf_token() }}`
                            },
                            onload: () => {
                                window.LaravelDataTables['tarotreadingcategory-table'].ajax.reload()
                            }
                        },
                        revert: {
                            url: `{{ route('languages.revert') }}`,
                            headers: {
                                'X-CSRF-TOKEN': `{{ csrf_token() }}`
                            },
                            method: 'DELETE',
                        }
                    }
                })
            });
        </script>
    @endpush
</x-app-layout>
