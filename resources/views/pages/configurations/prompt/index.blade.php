<x-app-layout>
    <div class="card mb-4">
        <div class="card-header">
            <h5>OpenAI Prompt Configuration</h5>
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
            >
                @csrf
                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="ai_model"
                    > AI Model</label>
                    <div class="col-sm-10">
                        <select
                            class="form-select"
                            id="ai_model"
                            name="ai_model"
                        >
                            <option value="">Select AI Model</option>
                            @forelse ($openAiModelList as $key => $value)
                                <option
                                    value="{{ $value }}"
                                    @selected(old('ai_model') == $value)
                                    @selected($configs['ai_model'] == $value)
                                >{{ $key }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        data-coreui-toggle="tooltip"
                        data-coreui-html="true"
                        for="max_token"
                        title="The maximum number of tokens to generate in the completion"
                    > Max Token</label>
                    <div class="col-sm-10">
                        <input
                            class="form-control"
                            id="max_token"
                            name="max_token"
                            type="text"
                            value="{{ old('max_token', $configs['max_token'] ?? null) }}"
                            placeholder="200"
                            mask-type="number"
                        >
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        data-coreui-toggle="tooltip"
                        data-coreui-html="true"
                        for="temperature"
                        title="Sampling temperature to use, between 0 and 2. Higher values will make the output random, lower value will make it more focused."
                    > Temperature</label>
                    <div class="col-sm-10">
                        <input
                            class="form-control"
                            id="temperature"
                            name="temperature"
                            type="text"
                            value="{{ old('temperature', $configs['temperature'] ?? null) }}"
                            placeholder="1.0"
                            mask-type="number"
                            min="0"
                            max="2"
                        >
                    </div>
                </div>
                <button class="btn btn-tosca col-12 col-lg-1">Save</button>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="https://unpkg.com/imask"></script>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const formNumber = document.querySelectorAll('form input[mask-type=number]');

                //apply mask number
                formNumber.forEach(el => {
                    IMask(el, {
                        mask: Number, // enable number mask
                        scale: 2, // digits after point, 0 for integers
                        signed: false, // disallow negative
                        thousandsSeparator: '', // any single char
                        padFractionalZeros: false, // if true, then pads zeros at end to the length of scale
                        normalizeZeros: true, // appends or removes zeros at ends
                        radix: '.', // fractional delimiter
                        mapToRadix: ['.'], // symbols to process as radix
                    })
                })
            })
        </script>
    @endpush
</x-app-layout>
