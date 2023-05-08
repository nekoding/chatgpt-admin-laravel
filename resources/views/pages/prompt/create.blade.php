<x-app-layout>
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex align-items-center gap-2">
                <a
                    class="nav-link"
                    href="{{ route('prompts.index') }}"
                ><i class="cil-arrow-left"></i></a>
                <span class="fw-bold">Add New Prompt</span>
            </div>
        </div>
        <div class="card-body">
            <form
                action="{{ route('prompts.store') }}"
                method="POST"
            >
                @csrf
                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="key"
                    >Key <span class="text-danger fw-bold">*</span></label>
                    <div class="col-sm-10">
                        <input
                            class="form-control @error('key') is-invalid @enderror"
                            id="key"
                            name="key"
                            type="text"
                        >

                        @error('key')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="default"
                    >Prompt Template <span class="text-danger fw-bold">*</span></label>
                    <div class="col-sm-10">
                        <textarea
                            class="form-control @error('prompt_template') is-invalid @enderror"
                            name="prompt_template"
                            rows="10"
                        ></textarea>

                        @error('prompt_template')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row flex-row-reverse">
                    <button class="btn btn-tosca text-white col-1 me-2">Save</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
