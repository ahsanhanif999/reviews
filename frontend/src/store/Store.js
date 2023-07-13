import { createStore } from 'vuex';
import axios from 'axios';
import user from "./User"
import tag from "./Tag"

const store = createStore({
  state: {
    // Your state properties
  },
   mutations: {
    setCompany(state, company) {
      state.company = company;
    },
  },
  actions: {
    async getCompany({ commit }, token) {
      try {
        const response = await axios.get('http://localhost:8000/api/company/list', { headers: { Authorization: `Bearer ${token}` } });
        // Commit a mutation to update the state with the fetched posts
        commit('setCompany', response.data);
        return response;
      } catch (error) {
        return error;
      }
    },
  },
  getters: {
    // Your getters
  },
  modules: {
    user,
    tag
  },
});

export default store;