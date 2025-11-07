import axios from "axios";

const api = axios.create({
  baseURL: "http://localhost:8000/api",
  withCredentials: true, // cookies HttpOnly
}); 

// em caso de cookie expirado
api.interceptors.response.use(
  (response) => response,
  async (error) => {
    if (error.response?.status === 401) {
      try {
        await axios.post("http://localhost:8000/api/refresh", {}, { withCredentials: true });
        return api(error.config);
      } catch (refreshError) {
        console.error("Sessão expirada, redirecionando para login...");
        window.location.href = "/login";
      }
    }
    return Promise.reject(error);
  }
);

export default api;