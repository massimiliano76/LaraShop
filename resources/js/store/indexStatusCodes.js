const state = {
    invoiceStatusCodes: [],
}

const getters = {
    getInvoiceStatusCodes: state => state.invoiceStatusCodes,
};

const actions = {
    setInvoiceStatusCodes({commit}) {
        return axios.get('/invoice-status-codes')
              .then((response) => {
                // handle success
                console.log(response)
                commit('setInvoiceStatusCodes', response.data.data); 
              })
              .catch(function (error) {
                // handle error
                console.log(error);
              })
        },
        createInvoiceStatusCode({commit}, name) {
            return axios.post('/invoice-status-codes/create', {
                name: name
            })
                .then((reponse) => {
                    commit('createInvoiceStatusCode', response)
                })
                .catch(err => console.log(err))
        },
    deleteInvoiceStatusCode({commit}, id) {
        return axios.post('/invoice-status-codes/delete/' + id)
            .then((reponse) => {
                commit('delete', id)
            })
            .catch(err => console.log(err))
    },
    updateInvoiceStatusCode({commit}, {id, name}) {
        return axios.post('/invoice-status-codes/edit/' + id, {
            name: name
        })
        .then((response) => {
            commit('updateInvoiceStatusCode', {id, name})
        })
    }
};

const mutations = {
    setInvoiceStatusCodes: (state, invoiceStatusCodes) => {
        state.invoiceStatusCodes = invoiceStatusCodes;
    },
    createInvoiceStatusCode: (state, createdInvoice) => {
        console.log(createdInvoice);
        state.invoiceStatusCodes.push(createdInvoice);
    },
    delete: (state, id) => {
        state.invoiceStatusCodes = state.invoiceStatusCodes.find(inv => inv.id !== id)
    },
    updateInvoiceStatusCode: (state, {id, name}) => {
        let updatedInvoiceStatusCode = state.invoiceStatusCodes.find(inv => inv.id === id);
        inv.name = name;
    }
};

export default {
    namespaced: true,
    state, 
    getters,
    actions,
    mutations,
}