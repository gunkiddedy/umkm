const state = {
    companyRequest: '',
    productRequest: '',
    blacklistRequest: ''
};

const getters = {
    get_companyRequest: state => state.companyRequest,
    get_productRequest: state => state.productRequest,
    get_blacklistRequest: state => state.blacklistRequest
};

const mutations = {
    MUT_COMPANY_REQUEST : (state) => {
        axios.get('/api/company-request')
        .then(res => {
            // if(res.data > 0)
                state.companyRequest = res.data;
                console.log(res.data);
        })
        .catch(err => {
            console.log(err);
        });
    },
    MUT_PRODUCT_REQUEST : (state) => {
        axios.get('/api/product-request')
        .then(res => {
            // if(res.data > 0)
                state.productRequest = res.data;
        })
        .catch(err => {
            console.log(err);
        });
    },
    MUT_BLACKLIST_REQUEST : (state) => {
        axios.get('/api/blacklist-request')
        .then(res => {
            // if(res.data > 0)
                state.blacklistRequest = res.data;
        })
        .catch(err => {
            console.log(err);
        });
    }
};

const actions = {
    handleCompanyRequest: (context) => {
        context.commit('MUT_COMPANY_REQUEST');
    },
    handleProductRequest: (context) => {
        context.commit('MUT_PRODUCT_REQUEST');
    },
    handleBlacklistRequest: (context) => {
        context.commit('MUT_BLACKLIST_REQUEST');
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}