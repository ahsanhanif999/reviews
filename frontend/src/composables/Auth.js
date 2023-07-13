import axios from "axios"

const Auth = () => {
  // Login Endpoint
  const login = async (email, password) => {
    try {
      const response = await axios.post('http://localhost:8000/api/user/login', { email: email, password: password, });
      return response;
    } catch (err) {

      return err;
    }
  };
  // Register User Endpoint
  const register = async (data) => {
    try {

        let response = await axios.put('http://127.0.0.1:8000/api/user/register', {  name: data.name , email: data.email,  password: data.password,  password_confirmation: data.password_confirmation});
        return response;
    } catch (err) {

        return err.response;
    }
  };
  // User Logout Endpoint
  const logout = async (token) => {
    try {
      const response = await axios.post('http://localhost:8000/api/logout',null, {headers: {"Authorization" : `Bearer ${token}`}});
      if(response.status == 200){
        localStorage.removeItem('reviewAccessToken')
    }
      return response;
    } catch (err) {
      return err;
    }
  };

    return {
      login,
      register,
      logout
    }
};

export default Auth;