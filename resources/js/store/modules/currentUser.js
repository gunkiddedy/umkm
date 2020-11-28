const state = {
    userInformation: [],
    userRole: '',
    userId: '',
};

const getters = {
    userData: state => state.userInformation,
    userRole: state => state.userRole,
    userId: state => state.userId,
};

const mutations = {
    HANDLE_LOGIN : (state, payload) => {
        state.userInformation.push(payload);
        state.userRole = payload.user.role;
        state.userId = payload.user.id;
        localStorage.setItem('username', payload.user.name);
        localStorage.setItem('user_id', payload.user.id);
        localStorage.setItem('isloggedIn', 'true');
    },
    HANDLE_LOGOUT: (state) => {
        state.userInformation = [];
        state.userRole = '';
        state.userId = '';
        state.companyName = '';
        localStorage.removeItem('username');
        localStorage.removeItem('user_id');
        localStorage.removeItem('isloggedIn');
        localStorage.removeItem('user_role');
    }
};

const actions = {
    handleLogin: (context, payload) => {
        context.commit('HANDLE_LOGIN', payload);
    },

    handleLogout: context => context.commit('HANDLE_LOGOUT')
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}