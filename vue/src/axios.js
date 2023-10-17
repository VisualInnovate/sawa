import axios from "axios";

axios.defaults.baseURL = "http://localhost:8000";

axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*'

axios.interceptors.request.use((config) => {
  config.headers.lang = localStorage.getItem("appLang");

  try {
    config.headers.Authorization = `Bearer ${JSON.parse(
      localStorage.getItem("token")
    )}`;
  } catch (error) {
    config.headers.Authorization = `Bearer ${localStorage.getItem("token")}`;
  }
  config.headers.Accept = "application/json";
  // config.headers["Content-Type"] = "application/json";
  return config;
});
