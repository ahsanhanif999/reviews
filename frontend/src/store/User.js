import axios from 'axios';

const user = ({
  state: {
    // Your state properties
  },
   mutations: {
    setLoginUser(state, user) {
        state.user = user;
      },
    
  },
  actions: {
    async getLoginUser({ commit }, token) {
        try {
          const response = await axios.get('http://localhost:8000/api/user/show', { headers: { Authorization: `Bearer ${token}` } });
          // Commit a mutation to update the state with the fetched posts
          commit('setLoginUser', response.data);
          return response;
        } catch (error) {
          return error;
        }
      },
  },
  getters: {
    
  },
});

export default user;