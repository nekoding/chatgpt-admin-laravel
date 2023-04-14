<div
    class="sidebar sidebar-dark sidebar-fixed"
    id="sidebar"
    style="background: var(--cui-sidebar-green);"
>
    <div class="sidebar-brand d-none d-md-flex">
        <h1>{{ config('app.name', 'Laravel') }}</h1>
    </div>
    <ul
        class="sidebar-nav"
        data-coreui="navigation"
        data-simplebar=""
    >
        <li class="nav-item"><a
                class="nav-link"
                href="{{ route('dashboard') }}"
            >
                <i class="cil-speedometer nav-icon"></i> Dashboard</a></li>
        <li class="nav-title">Management</li>
        <li class="nav-item"><a
                class="nav-link"
                href="{{ route('languages.index') }}"
            >
                <i class="cil-language nav-icon"></i> Languages</a></li>
        <li class="nav-item"><a
                class="nav-link"
                href="{{ route('cards.index') }}"
            >
                <i class="cil-filter-photo nav-icon"></i> Cards</a></li>
        <li class="nav-title">Configuration</li>
        <li class="nav-item"><a
                class="nav-link"
                href="{{ route('config.openai.index') }}"
            >
                <i class="cil-memory nav-icon"></i> OpenAI API Key</a></li>
        <li class="nav-item"><a
                class="nav-link"
                href="{{ route('config.prompt.index') }}"
            >
                <i class="cib-probot nav-icon"></i> OpenAI Prompt</a></li>
        {{-- <li class="nav-group"><a
                class="nav-link nav-group-toggle"
                href="#"
            >
                <i class="cib-laravel nav-icon"></i>Menu</a>
            <ul class="nav-group-items">
                <li class="nav-item"><a
                        class="nav-link"
                        href="#"
                    ><span class="nav-icon"></span>Sub Menu</a></li>
            </ul>
        </li> --}}
    </ul>
    <button
        class="sidebar-toggler"
        data-coreui-toggle="unfoldable"
        type="button"
    ></button>
</div>
