import axios from "axios"

const Company = () => {
  // Display Componies list to the user
  const companyList = async (token) => {
    try {
      const response = await axios.get('http://localhost:8000/api/company/list', {headers: { Authorization: `Bearer ${token}` }});
      return response;
    } catch (err) {
      return err;
    }
  };

  const companyReview = async (token, id) => {
    try {
      const response = await axios.get(`http://localhost:8000/api/company/reviews/${id}`, {headers: { Authorization: `Bearer ${token}` }});
      return response;
    } catch (err) {
      return err;
    }
  };


    return {
      companyList,
      companyReview,
    }
};

export default Company;