<template>

    <header class="header">
        <div class="navbar-area">
            <div class="container">
                <nav class="navbar navbar-expand-lg">

                    <a class="navbar-brand" href="#">
                        <img width="120px;" src="../assets/images/logo.png" alt="Logo" />
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent">
                        <span class="toggler-icon"></span>
                        <span class="toggler-icon"></span>
                        <span class="toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav m-auto">

                            <li class="nav-item">
                                <router-link class="nav-link fw-medium" :class="{ active: $route.path === '/' }" to="/">
                                    <font-awesome-icon icon="home" /> Home
                                </router-link>
                            </li>

                            <li class="nav-item">
                                <router-link class="nav-link fw-medium"
                                    :class="{ active: $route.path === '/dashboard' }" to="/dashboard">
                                    <font-awesome-icon icon="chart-line" /> Dashboard
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link fw-medium"
                                    :class="{ active: $route.path === '/sticker/apply' }" to="/sticker/apply">
                                    <font-awesome-icon icon="note-sticky" /> Apply Sticker
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link fw-medium"
                                    :class="{ active: $route.path === '/monthly-dues' }" to="/monthly-dues">
                                    <font-awesome-icon icon="calendar" /> Monthly Dues
                                </router-link>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    More
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li class="nav-item">
                                        <router-link class="nav-link fw-medium"
                                            :class="{ active: $route.path === '/contact' }" to="/contact">
                                            <font-awesome-icon icon="calendar" /> Contact Us
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link class="nav-link fw-medium"
                                            :class="{ active: $route.path === '/projects' }" to="/projects">
                                            <font-awesome-icon icon="diagram-project" /> Projects
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link class="nav-link fw-medium"
                                            :class="{ active: $route.path === '/officers' }" to="/officers">
                                            <font-awesome-icon icon="people-line" /> Officers
                                        </router-link>
                                    </li>
                                    <li class="nav-item">

                                        <a href="#about" class="nav-link"><font-awesome-icon icon="circle-info" />
                                            About</a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <div>
        <!-- <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container">
                <router-link class="navbar-brand d-flex align-items-center gap-2" to="/">
                    <img src="../assets/images/logo.png" alt="Logo" height="100" />
                </router-link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto align-items-center gap-3">
                        <li class="nav-item">
                            <router-link class="nav-link fw-medium"
                                :class="{ active: $route.path === '/dashboard' }" to="/dashboard">
                                <font-awesome-icon icon="char-line" /> Dashboard
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link fw-medium"
                                :class="{ active: $route.path === '/sticker/apply' }" to="/sticker/apply">
                                <font-awesome-icon icon="note-sticky" /> Apply Sticker
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link fw-medium" :class="{ active: $route.path === '/monthly-dues' }"
                                to="/monthly-dues">
                                <font-awesome-icon icon="calendar" /> Monthly Dues
                            </router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav> -->

        <!-- Main Content -->
        <div class="container mt-200">
            <router-view></router-view>
        </div>
    </div>

    <a href="#" class="scroll-top btn-hover">
        <font-awesome-icon icon="angle-up" />
    </a>
</template>