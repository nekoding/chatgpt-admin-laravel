<x-app-layout>
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex align-items-center gap-2">
                <a
                    class="nav-link"
                    href="{{ route('card-categories.index') }}"
                ><i class="cil-arrow-left"></i></a>
                <span class="fw-bold">Add Card Category</span>
            </div>
        </div>
        <div class="card-body">
            <form
                action="{{ route('card-categories.store') }}"
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
                            class="form-control"
                            id="titleId"
                            name="title_id"
                            type="text"
                        >
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="default"
                    >Basic <span class="text-danger fw-bold">*</span></label>
                    <div class="col-sm-10">
                        <input
                            class="form-control"
                            id="default"
                            name="default"
                            type="text"
                        >
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="en_US"
                    >English (America)</label>
                    <div class="col-sm-10">
                        <input
                            class="form-control"
                            id="en_US"
                            name="translations[en_us]"
                            type="text"
                        >
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="en_UK"
                    >English (British)</label>
                    <div class="col-sm-10">
                        <input
                            class="form-control"
                            id="en_UK"
                            name="translations[en_uk]"
                            type="text"
                        >
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="ja_JP"
                    >Japanese</label>
                    <div class="col-sm-10">
                        <input
                            class="form-control"
                            id="ja_JP"
                            name="translations[ja_jp]"
                            type="text"
                        >
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="in_ID"
                    >Indonesian</label>
                    <div class="col-sm-10">
                        <input
                            class="form-control"
                            id="in_ID"
                            name="translations[in_id]"
                            type="text"
                        >
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="zh_CN"
                    >Chinese (Simplified)</label>
                    <div class="col-sm-10">
                        <input
                            class="form-control"
                            id="zh_CN"
                            name="translations[zh_cn]"
                            type="text"
                        >
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="fr_FR"
                    >French</label>
                    <div class="col-sm-10">
                        <input
                            class="form-control"
                            id="fr_FR"
                            name="translations[fr_fr]"
                            type="text"
                        >
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="de_DE"
                    >German</label>
                    <div class="col-sm-10">
                        <input
                            class="form-control"
                            id="de_DE"
                            name="translations[de_de]"
                            type="text"
                        >
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="it_IT"
                    >Italian</label>
                    <div class="col-sm-10">
                        <input
                            class="form-control"
                            id="it_IT"
                            name="translations[it_it]"
                            type="text"
                        >
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="ko_KR"
                    >Korean</label>
                    <div class="col-sm-10">
                        <input
                            class="form-control"
                            id="ko_KR"
                            name="translations[ko_kr]"
                            type="text"
                        >
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="pt_PT"
                    >Portuguese</label>
                    <div class="col-sm-10">
                        <input
                            class="form-control"
                            id="pt_PT"
                            name="translations[pt_pt]"
                            type="text"
                        >
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="pt_BR"
                    >Portuguese (Brazilian)</label>
                    <div class="col-sm-10">
                        <input
                            class="form-control"
                            id="pt_BR"
                            name="translations[pt_br]"
                            type="text"
                        >
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="es_ES"
                    >Spanish</label>
                    <div class="col-sm-10">
                        <input
                            class="form-control"
                            id="es_ES"
                            name="translations[es_es]"
                            type="text"
                        >
                    </div>
                </div>

                <div class="mb-3 row">
                    <label
                        class="col-sm-2 col-form-label"
                        for="tr_TR"
                    >Turkish</label>
                    <div class="col-sm-10">
                        <input
                            class="form-control"
                            id="tr_TR"
                            name="translations[tr_tr]"
                            type="text"
                        >
                    </div>
                </div>

                <div class="mb-3 row flex-row-reverse">
                    <button class="btn btn-tosca text-white col-1 me-2">Save</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
