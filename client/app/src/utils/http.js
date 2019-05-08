import axios from "axios";
const http = axios.create({
  baseURL: "http://api.tramitesunp/"
});

export { http };
