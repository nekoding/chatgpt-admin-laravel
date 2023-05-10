<x-app-layout>
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex align-items-center gap-2">
                <a
                    class="nav-link"
                    href="{{ route('reading-categories.index') }}"
                ><i class="cil-arrow-left"></i></a>
                <span class="fw-bold">Add Tarot Reading Category</span>
            </div>
        </div>
        <div class="card-body">
            <form
                action="{{ route('reading-categories.store') }}"
                method="POST"
            >
                @csrf
                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="titleId"
                    >TitleID <span class="text-danger fw-bold">*</span></label>
                    <div class="col-sm-10">
                        <input
                            class="form-control @error('title_id') is-invalid @enderror"
                            id="titleId"
                            name="title_id"
                            type="text"
                            value="{{ old('title_id') }}"
                        >
                        @error('title_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="default"
                    >Basic <span class="text-danger fw-bold">*</span></label>
                    <div class="col-sm-10">
                        <input
                            class="form-control @error('default') is-invalid @enderror"
                            id="default"
                            name="default"
                            type="text"
                            value="{{ old('default') }}"
                        >
                        @error('default')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="en_US"
                    >English (America)</label>
                    <div class="col-sm-10">
                        <input
                            class="form-control @error('translations.en_us') is-invalid @enderror"
                            id="en_US"
                            name="translations[en_us]"
                            type="text"
                            value="{{ old('translations.en_us') }}"
                        >
                        @error('translations.en_us')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="en_UK"
                    >English (British)</label>
                    <div class="col-sm-10">
                        <input
                            class="form-control @error('translations.en_uk') is-invalid @enderror"
                            id="en_UK"
                            name="translations[en_uk]"
                            type="text"
                            value="{{ old('translations.en_uk') }}"
                        >
                        @error('translations.en_uk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="ja_JP"
                    >Japanese</label>
                    <div class="col-sm-10">
                        <input
                            class="form-control @error('translations.ja_jp') is-invalid @enderror"
                            id="ja_JP"
                            name="translations[ja_jp]"
                            type="text"
                            value="{{ old('translations.ja_jp') }}"
                        >
                        @error('translations.ja_jp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="in_ID"
                    >Indonesian</label>
                    <div class="col-sm-10">
                        <input
                            class="form-control @error('translations.in_id') is-invalid @enderror"
                            id="in_ID"
                            name="translations[in_id]"
                            type="text"
                            value="{{ old('translations.in_id') }}"
                        >
                        @error('translations.in_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="zh_CN"
                    >Chinese (Simplified)</label>
                    <div class="col-sm-10">
                        <input
                            class="form-control @error('translations.zh_cn') is-invalid @enderror"
                            id="zh_CN"
                            name="translations[zh_cn]"
                            type="text"
                            value="{{ old('translations.zh_cn') }}"
                        >
                        @error('translations.zh_cn')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="fr_FR"
                    >French</label>
                    <div class="col-sm-10">
                        <input
                            class="form-control @error('translations.fr_fr') is-invalid @enderror"
                            id="fr_FR"
                            name="translations[fr_fr]"
                            type="text"
                            value="{{ old('translations.fr_fr') }}"
                        >
                        @error('translations.fr_fr')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="de_DE"
                    >German</label>
                    <div class="col-sm-10">
                        <input
                            class="form-control @error('translations.de_de') is-invalid @enderror"
                            id="de_DE"
                            name="translations[de_de]"
                            type="text"
                            value="{{ old('translations.de_de') }}"
                        >
                        @error('translations.de_de')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="it_IT"
                    >Italian</label>
                    <div class="col-sm-10">
                        <input
                            class="form-control @error('translations.it_it') is-invalid @enderror"
                            id="it_IT"
                            name="translations[it_it]"
                            type="text"
                            value="{{ old('translations.it_it') }}"
                        >
                        @error('translations.it_it')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="ko_KR"
                    >Korean</label>
                    <div class="col-sm-10">
                        <input
                            class="form-control @error('translations.ko_kr') is-invalid @enderror"
                            id="ko_KR"
                            name="translations[ko_kr]"
                            type="text"
                            value="{{ old('translations.ko_kr') }}"
                        >
                        @error('translations.ko_kr')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="pt_PT"
                    >Portuguese</label>
                    <div class="col-sm-10">
                        <input
                            class="form-control @error('translations.pt_pt') is-invalid @enderror"
                            id="pt_PT"
                            name="translations[pt_pt]"
                            type="text"
                            value="{{ old('translations.pt_pt') }}"
                        >
                        @error('translations.pt_pt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="pt_BR"
                    >Portuguese (Brazilian)</label>
                    <div class="col-sm-10">
                        <input
                            class="form-control @error('translations.pt_br') is-invalid @enderror"
                            id="pt_BR"
                            name="translations[pt_br]"
                            type="text"
                            value="{{ old('translations.pt_br') }}"
                        >
                        @error('translations.pt_br')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="es_ES"
                    >Spanish</label>
                    <div class="col-sm-10">
                        <input
                            class="form-control @error('translations.es_es') is-invalid @enderror"
                            id="es_ES"
                            name="translations[es_es]"
                            type="text"
                            value="{{ old('translations.es_es') }}"
                        >
                        @error('translations.es_es')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="tr_TR"
                    >Turkish</label>
                    <div class="col-sm-10">
                        <input
                            class="form-control @error('translations.tr_tr') is-invalid @enderror"
                            id="tr_TR"
                            name="translations[tr_tr]"
                            type="text"
                            value="{{ old('translations.tr_tr') }}"
                        >
                        @error('translations.tr_tr')
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
