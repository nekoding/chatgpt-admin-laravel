<header class="header header-sticky mb-4">
    <div class="container-fluid">
        <button
            class="header-toggler px-md-0 me-md-3"
            type="button"
            onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()"
        >
            <i class="cil-menu icon icon-lg"></i>
        </button><a
            class="header-brand d-md-none"
            href="#"
        >
            <h1>Laravel App</h1>
        </a>

        <div class="d-flex align-items-center gap-2">
            {{-- Language --}}
            <ul class="header-nav">
                <li class="nav-item dropdown"><a
                        class="nav-link py-0"
                        data-coreui-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <div class="avatar avatar-md"><img
                                class="avatar-img"
                                src="{{ asset('/coreui/svg/free/cil-globe-alt.svg') }}"
                                alt="Language"
                            ></div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a
                            class="dropdown-item"
                            type="button"
                            href="#"
                        >
                            <i class="icon me-2 cif-us"></i> English</a>
                        <a
                            class="dropdown-item"
                            type="button"
                            href="#"
                        >
                            <i class="icon me-2 cif-id"></i> Indonesia</a>
                        <a
                            class="dropdown-item"
                            type="button"
                            href="#"
                        >
                            <i class="icon me-2 cif-jp"></i> Japan</a>
                    </div>
                </li>
            </ul>

            {{-- Account --}}
            <ul class="header-nav">
                <li class="nav-item dropdown"><a
                        class="nav-link py-0"
                        data-coreui-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <div class="avatar avatar-md"><img
                                class="avatar-img"
                                src="{{ asset('/coreui/assets/img/avatars/8.jpg') }}"
                                alt="user@email.com"
                            ></div>
                    </a>
                    <div
                        class="dropdown-menu dropdown-menu-end pt-0"
                        x-data=""
                    >
                        <div class="dropdown-header bg-light py-2">
                            <div class="fw-semibold">Account</div>
                        </div>
                        <a
                            class="dropdown-item"
                            href="#"
                        >
                            <i class="icon me-2 cil-user"></i>Profil</a>
                        <div class="dropdown-divider"></div>
                        <button
                            class="dropdown-item"
                            type="button"
                            @click="() => {
                                axios.delete('{{ route('logout') }}', {}, {
                                    headers: {
                                        'Accept': 'application/json'
                                    }
                                }).then(res => {
                                    window.location.reload()
                                })
                            }"
                        >
                            <i class="icon me-2 cil-account-logout"></i> Logout</button>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
