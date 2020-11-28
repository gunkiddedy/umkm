import Welcome from './components/Welcome';
import LoginPage from './components/LoginPage';
import RegisterPage from './components/RegisterPage';
import DesaPage from './components/DesaPage';
import KecamatanPage from './components/KecamatanPage';
import AdminPage from './components/AdminPage';
import PageNotFound from './components/PageNotFound';

export default {
    mode: 'history',

    routes: [
        {
            path: '*',
            component: PageNotFound,
            name: 'page-not-found'
        },
        {
            path: '/',
            component: Welcome,
            name: 'welcome'
        },
        {
            path: '/login',
            component: LoginPage,
            name: 'login'
        },
        {
            path: '/register',
            component: RegisterPage,
            name: 'register'
        },
        {
            path: '/desa-page/:id',
            component: DesaPage,
            name: 'desa-page',
            props: true
        },
        {
            path: '/kecamatan-page/:id',
            component: KecamatanPage,
            name: 'kecamatan-page',
            props: true
        },
        {
            path: '/admin-page',
            component: AdminPage,
            name: 'admin-page',
        }
    ]
}