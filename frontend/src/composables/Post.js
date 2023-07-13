import axios from "axios"

const Post = () => {
  // Display Post list to the user
  const postList = async (token) => {
    try {
      const response = await axios.get('http://localhost:8000/api/post', {headers: { Authorization: `Bearer ${token}` }});
      return response;
    } catch (err) {
      return err;
    }
  };

    return {
        postList,
    }
};

export default Post;