import axios from 'axios';

const axiosInstance = axios.create({
  baseURL: 'http://localhost:8000/api/produtos',
  timeout: 1000,
});

export default axiosInstance;
