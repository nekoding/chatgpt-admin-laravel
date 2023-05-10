<div
    class="sidebar sidebar-dark sidebar-fixed"
    id="sidebar"
>
    <div
        class="sidebar-brand d-none d-md-flex"
        style="padding: 0 1rem; justify-content: start !important;"
    >
        <h3>{{ config('app.name', 'Laravel') }}</h3>
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
                <i class="cil-filter-photo nav-icon"></i> Tarot Cards</a></li>
        <li class="nav-item"><a
                class="nav-link"
                href="{{ route('tarot-spreads.index') }}"
            >
                <i class="cil-font nav-icon"></i> Tarot Spread Category</a></li>
        <li class="nav-item"><a
                class="nav-link"
                href="{{ route('reading-categories.index') }}"
            >
                <i class="cil-keyboard nav-icon"></i> Tarot Reading Category</a></li>
        <li class="nav-item"><a
                class="nav-link"
                href="{{ route('prompts.index') }}"
            >
                <i class="cil-keyboard nav-icon"></i> OpenAI Prompt</a></li>
        {{-- Configuration --}}
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
                <i class="cib-probot nav-icon"></i> Prompt Configuration</a></li>
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
