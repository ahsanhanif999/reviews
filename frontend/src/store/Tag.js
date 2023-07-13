import axios from 'axios';

const tag = ({
  state: {
    // Your state properties
  },
   mutations: {
    setTagList(state, tag) {
        state.tag = tag;
      },
      getTag(state, tagData) {
        state.tagData = tagData;
      },
  },

  actions: {
    async getTagList({ commit }, token) {
        try {
          const response = await axios.get('http://localhost:8000/api/tag/list', { headers: { Authorization: `Bearer ${token}` } });
          commit('setTagList', response.data);
          return response;
        } catch (error) {
          return error;
        }
      },

      async createTag({ commit }, { token, tagData }) {
        try {
          const response = await axios.post('http://localhost:8000/api/tag/create',
           {
            name:tagData.name,
            created_by:tagData.created_by
          },
          { headers: { Authorization: `Bearer ${token}` } });
          commit('getTag', response.data);
          return response;
        } catch (error) {
          return error;
        }
      },

  },

  getters: {
  },
});

export default tag;