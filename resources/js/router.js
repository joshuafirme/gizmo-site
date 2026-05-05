import {
    createRouter,
    createWebHistory,
    useRouter
} from 'vue-router'

import AdminLogin from './pages/Admin/Login.vue'
import AdminDashboard from './pages/Admin/Dashboard.vue'
import AdminHomeowners from './pages/Admin/Homeowners.vue'
import AdminUsers from './pages/Admin/Users.vue'
import ContactMessages from './pages/Admin/ContactMessages.vue'

import AdminSticker from './pages/Admin/StickerApplications.vue'
import AdminPayments from './pages/Admin/Payments.vue'
import AdminSiteSettings from './pages/Admin/SiteSettings.vue'
import SystemUsers from './pages/Admin/SystemUsers.vue'
import AdminProjects from './pages/Admin/Projects.vue'
import AdminOfficers from './pages/Admin/Officers.vue'


import Login from './pages/Auth/Login.vue'
import Dashboard from './pages/Dashboard.vue'

import ApplySticker from './pages/Sticker/Apply.vue'
import MyApplications from './pages/Sticker/MyApplications.vue'

import MonthlyDueCreate from './pages/Payments/CreatePayment.vue'
import MonthlyDues from './pages/Payments/MonthlyDues.vue'

import GuardRelease from './pages/Guard/ReleaseSticker.vue'
import Home from './pages/Home.vue'
import Contact from './pages/Contact.vue'
import Projects from './pages/Projects.vue'
import Officers from './pages/Officers.vue'

const routes = [{
        path: '/admin/login',
        component: AdminLogin,
        meta: {
            title: 'Admin Login'
        }
    },
    {
        path: '/admin/users',
        component: SystemUsers,
        meta: {
            title: 'System Users',
            requiresAdmin: true
        }
    },
    {
        path: '/admin/dashboard',
        component: AdminDashboard,
        meta: {
            title: 'Admin Dashboard',
            requiresAdmin: true
        }
    },
    {
        path: '/admin/homeowners',
        component: AdminHomeowners,
        meta: {
            title: 'Homeowners',
            requiresAdmin: true
        }
    },
    {
        path: '/admin/users',
        component: AdminUsers,
        meta: {
            title: 'System Users',
            requiresAdmin: true
        }
    },
    {
        path: '/admin/contact-messages',
        component: ContactMessages,
        meta: {
            requiresAdmin: true
        }
    },
    {
        path: '/admin/projects',
        component: AdminProjects,
        meta: {
            title: 'Projects',
            requiresAdmin: true
        }
    },
    {
        path: '/admin/officers',
        component: AdminOfficers,
        meta: {
            title: 'Officers',
            requiresAdmin: true
        }
    },
    {
        path: '/login',
        component: Login,
        meta: {
            title: 'Login'
        }
    },

    {
        path: '/dashboard',
        component: Dashboard,
        meta: {
            title: 'Dashboard'
        }
    },
    {
        path: '/contact',
        component: Contact,
        meta: {
            title: 'Contact Us'
        }
    },
    {
        path: '/projects',
        component: Projects,
        meta: {
            title: 'Projects'
        }
    },

    {
        path: '/officers',
        component: Officers,
        meta: {
            title: 'Officers'
        }
    },
    {
        path: '/sticker/apply',
        component: ApplySticker,
        meta: {
            title: 'Apply Sticker'
        }
    },


    {
        path: '/monthly-due/create',
        component: MonthlyDueCreate
    },

    {
        path: '/sticker/my-applications',
        component: MyApplications,
        meta: {
            title: 'My Applications'
        }
    },

    {
        path: '/monthly-dues',
        component: MonthlyDues,
        meta: {
            title: 'Monthly Dues'
        }
    },

    {
        path: '/admin/stickers',
        component: AdminSticker,
        meta: {
            title: 'Sticker Applications',
            requiresAdmin: true
        }
    },
    {
        path: '/admin/payments',
        component: AdminPayments,
        meta: {
            title: 'Monthly Dues',
            requiresAdmin: true
        }
    },
    {
        path: '/admin/site-settings',
        component: AdminSiteSettings,
        meta: {
            title: 'Site Settings',
            requiresAdmin: true
        }
    },

    {
        path: '/admin/guard/release',
        component: GuardRelease
    },
    {
        path: '/',
        component: Home,
        meta: {
            title: 'DECA Homes'
        }
    },

]

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
})

router.beforeEach((to, from) => {

    const token = localStorage.getItem('admin_token')

    if (to.meta?.requiresAdmin && !token) {
        return '/admin/login' // ✅ redirect (no reload)
    }

    document.title = to?.meta?.title || 'DECA Homes'

    return true // optional, can also omit
})

export default router
