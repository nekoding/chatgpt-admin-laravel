<x-app-layout>
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex align-items-center gap-2">
                <a
                    class="nav-link"
                    href="{{ route('cards.index') }}"
                ><i class="cil-arrow-left"></i></a>
                <span class="fw-bold">Add Card</span>
            </div>
        </div>
        <div class="card-body position-relative">
            <form
                action="{{ route('cards.update', ['card' => $card->id]) }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @method('PUT')
                @csrf
                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="titleId"
                    >Card Image <span class="text-danger fw-bold">*</span></label>
                    <div class="col-sm-10 position-relative">
                        <input
                            class="uploader"
                            name="image"
                            type="file"
                        >
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-12 col-md-2 col-form-label"
                        for="title"
                    >Card Title <span class="text-danger fw-bold">*</span></label>
                    <div class="col-12 col-md-10">
                        <select
                            class="form-select"
                            id="title"
                            name="title"
                        >
                            <option value="">Select Card Title</option>
                            @forelse ($titles as $title)
                                <option
                                    value="{{ $title->title_id }}"
                                    @selected($title->title_id == $card->title)
                                >{{ $title->default }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-12 col-md-2 col-form-label"
                        for="upright"
                    >Card Upright <span class="text-danger fw-bold">*</span></label>
                    <div class="col-12 col-md-10">
                        <select
                            class="form-select"
                            id="upright"
                            name="upright"
                        >
                            <option value="">Select Card Upright</option>
                            @forelse ($uprights as $upright)
                                <option
                                    value="{{ $upright->title_id }}"
                                    @selected($upright->title_id == $card->upright)
                                >{{ $upright->default }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-12 col-md-2 col-form-label"
                        for="reversed"
                    >Card Reversed <span class="text-danger fw-bold">*</span></label>
                    <div class="col-12 col-md-10">
                        <select
                            class="form-select"
                            id="reversed"
                            name="reversed"
                        >
                            <option value="">Select Card Reversed</option>
                            @forelse ($reverseds as $reversed)
                                <option
                                    value="{{ $reversed->title_id }}"
                                    @selected($reversed->title_id == $card->reversed)
                                >{{ $reversed->default }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <button
                        class="btn btn-success text-white col-12 col-md-4 col-lg-1 ms-lg-2"
                        type="submit"
                    >Save</button>
                </div>
            </form>
        </div>
    </div>

    @push('head')
        <link
            href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
            rel="stylesheet"
        />
        <link
            href="https://unpkg.com/filepond@^4/dist/filepond.css"
            rel="stylesheet"
        />
        <link
            href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
            rel="stylesheet"
        />
        <link
            href="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css"
            rel="stylesheet"
        />

        <style>
            .select2-selection__arrow {
                top: 20% !important;
            }

            .select2-selection--single {
                height: 40px !important;
                display: flex !important;
                align-items: center !important;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" type="module"></script>
        <script src="https://unpkg.com/filepond/dist/filepond.min.js" type="module"></script>
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.js"></script>
        <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js" type="module"></script>


        <script>
            $(function() {
                $('.form-select').select2();

                // register filepond
                $.fn.filepond.registerPlugin(FilePondPluginImagePreview);
                $.fn.filepond.registerPlugin(FilePondPluginFilePoster);

                const configs = {
                    files: [{
                        source: '{{ $card->id }}',
                        options: {
                            type: 'local',
                            file: {
                                name: '{{ $card->title }}',
                                size: 1001025,
                                type: 'image/jpg'
                            },
                            metadata: {
                                poster: '{{ asset('storage/' . $card->image_path) }}',
                            },
                        },
                    }],
                }

                $('.uploader').filepond(configs);
                $('.uploader').filepond('allowMultiple', false);
                $('.uploader').filepond('storeAsFile', true);
                $('.uploader').filepond('filePosterHeight', 400);

                FilePond.setOptions({})
            });
        </script>

        @if (session()->has('success'))
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    Swal.fire(
                        'Success!',
                        'Your data has been updated.',
                        'success'
                    )
                })
            </script>
        @endif
    @endpush
</x-app-layout>
