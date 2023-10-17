import { defineStore } from "pinia";
import axios from "axios";
import { ref } from "vue";
import { useStorage } from "@vueuse/core";
export const useParentStore = defineStore("parentStore", {
  state: () => ({
    parent: useStorage("parent", {}),
    token: useStorage("token", null),
    parentAuth: useStorage("parentAuth", false),
    showErrors: ref(false),
    authErrors: {},
  }),
  getters: {
    user: (state) => state.parent,
    errors: (state) => state.authErrors?.errors,
    errorMessage: (state) => state.authErrors?.message,
  },
  actions: {
    async login(parent) {
      this.authErrors = [];
      this.showErrors = false;
      await axios
        .post("api/parent/login", parent)
        .then((res) => {
          this.parent = res.data.user;
          this.token = res.data.token;
          this.parentAuth = true;

          // if (res.data.user.phone_verified_at == null) {
          //   console.log("asdf");
          //   this.router.push({ name: "code" });
          // } else {
          //   console.log(res);
          this.router.push("/web/profile");
          // }
        })
        .catch((err) => {
          this.showErrors = true;
          this.authErrors = err.response.data;
          console.log(err);
        });
    },
    async register(parent) {
      console.log(parent);
      this.authErrors = [];
      this.showErrors = false;
      await axios
        .post("api/parent/register", parent)
        .then((res) => {
          this.parent = res.data.user;
          this.token = res.data.token;
          this.parentAuth = true;
          console.log(res);
          this.router.push("/web/");
        })
        .catch((err) => {
          this.showErrors = true;
          this.authErrors = err.response.data;
          console.log(err);
        });
    },
    getUser() {},
    logout() {
      axios
        .post("/api/parent/logout")
        .then((res) => {
          this.resetAuthStore();
          localStorage.removeItem("token");
          localStorage.removeItem("parent");
          localStorage.removeItem("parentAuth");
          this.router.push("/web/parent/login");
        })
        .catch((err) => {
          console.log(err);
        });
    },

    resetAuthStore() {
      this.token = null;
      this.parent = null;
      this.parentAuth = null;
      this.showErrors = null;
      this.authErrors = null;
    },
  },
});
