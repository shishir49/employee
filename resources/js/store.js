import { createStore } from 'vuex';

export default createStore({
    state : {
        count : 1000,
        singleEmployees : [],
        currentUser : {name : 'azim'}
    },

    getters : {
        getCount(state){
            return state.count
        },
        getSingleEmployee(state){
            return state.singleEmployees
        }
    },

    mutations : {
        getSingleEmployee(state, data) {
            return state.singleEmployees = data
        },

        logoutState(state) {
            state.currentUser = {}
        }
    },

    actions : {
        getEmployeeById(context, payload) {
            axios.get('/employee/update-data/'+payload).then(res => {
                context.commit('getSingleEmployee', res.data)
            })
        },

        logoutUser({commit}) {
            commit('logoutState')
        }
    }
})

