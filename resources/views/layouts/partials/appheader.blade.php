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
        <ul class="header-nav d-none d-md-flex">
            <li class="nav-item"><a
                    class="nav-link"
                    href="#"
                >Dashboard</a></li>
        </ul>
        <ul class="header-nav ms-auto">
            <li class="nav-item"><a
                    class="nav-link"
                    href="#"
                >
                    <svg class="icon icon-lg">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                    </svg></a></li>
            <li class="nav-item"><a
                    class="nav-link"
                    href="#"
                >
                    <svg class="icon icon-lg">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-list-rich"></use>
                    </svg></a></li>
            <li class="nav-item"><a
                    class="nav-link"
                    href="#"
                >
                    <svg class="icon icon-lg">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                    </svg></a></li>
        </ul>
        <ul class="header-nav ms-3">
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
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <div class="dropdown-header bg-light py-2">
                        <div class="fw-semibold">Account</div>
                    </div>
                    <a
                        class="dropdown-item"
                        href="#"
                    >
                        <i class="icon me-2 cil-user"></i>Profil</a>
                    <div class="dropdown-divider"></div>
                    <a
                        class="dropdown-item"
                        href="#"
                        x-data=""
                        @click="axios.post('{{ route('logout') }}').then(res => window.location.reload())"
                    >
                        <i class="icon me-2 cil-account-logout"></i> Logout</a>
                </div>
            </li>
        </ul>
    </div>
</header>
