<x-app-layout>
    <div class="card mb-4">
        <div class="card-header">
            <h5>OpenAI API Key Management</h5>
        </div>
        <div
            class="card-body"
            x-data="{
                apiKey: '{{ $apiKey }}'
            }"
        >
            <form
                action="{{ route('config.openai.store') }}"
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
                    >API Key</label>
                    <div class="col-sm-10">
                        <input
                            class="form-control"
                            id="key"
                            name="api_key"
                            type="password"
                            x-model="apiKey"
                        >
                    </div>
                </div>

                <button class="btn btn-tosca col-12 col-lg-1">Save</button>
            </form>
        </div>
    </div>
</x-app-layout>
