<x-app-layout>
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <span class="fw-bold">Card Management</span>

                <div class="d-flex align-items-center gap-2">
                    <a
                        class="btn btn-tosca text-white"
                        href="{{ route('cards.create') }}"
                    >Add</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('/lightbox/fslightbox.js') }}"></script>
        {{ $dataTable->scripts() }}
    @endpush
</x-app-layout>
