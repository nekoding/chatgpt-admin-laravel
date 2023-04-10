<x-app-layout>
    <div class="card mb-4">
        <div class="card-header">
            <h5>OpenAI Prompt Management</h5>
        </div>
        <div
            class="card-body"
            x-data="{
                apiKey: ''
            }"
        >
            <form
                action="{{ route('config.prompt.store') }}"
                method="POST"
                autocomplete="false"
                @submit.prevent="(ev) => {
                    axios.post(ev.target.action, {
                        api_key: apiKey
                    })
                    .then(res => {
                        Swal.fire(
                            'Success!',
                            'Data saved successfully.',
                            'success'
                        )
                    })
                    .catch(err => {
                        Swal.fire(
                            'Error!',
                            'Failed save data',
                            'error'
                        )
                    })
                }"
            >
                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="key"
                    > AI Model</label>
                    <div class="col-sm-10">
                        <select
                            class="form-select"
                            name="model"
                        >
                            <option value="">Select AI Model</option>
                            @forelse ($openAiModelList as $key => $value)
                                <option value="{{ $value }}">{{ $key }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="key"
                    > Max Token</label>
                    <div class="col-sm-10">
                        <input
                            class="form-control"
                            name="max_token"
                            type="number"
                            placeholder="200"
                        >
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="key"
                    > Temperature</label>
                    <div class="col-sm-10">
                        <input
                            class="form-control"
                            name="max_token"
                            type="number"
                            placeholder="200"
                        >
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="key"
                    > Prompt</label>
                    <div class="col-sm-10">
                        <textarea
                            class="form-control"
                            id=""
                            name="prompt"
                            cols="30"
                            rows="10"
                        ></textarea>
                    </div>
                </div>

                <button class="btn btn-primary col-12 col-lg-1">Save</button>
            </form>
        </div>
    </div>
</x-app-layout>
