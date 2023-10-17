import { defineStore } from "pinia";
import axios from "axios";
import { ref, reactive } from "vue";

export const useUsersStore = defineStore("Users", {
  state: () => ({
    users: [],
    roles: [],
    permissions: [],
    errors: [],
    successMsg: "",
    loading: ref(false),
    params: reactive({
      keyword: "",
      page: 0,
      size: 0,
      totalPages: 0,
    }),
  }),
  getters: {
    getUsers: (state) => state.users,
    getUserById: (state) => {
      return (userId) => state.users.find((user) => user.id === Number(userId));
    },
    getRoleById: (state) => {
      return (roleId) => state.roles.find((role) => role.id === Number(roleId));
    },
    getRoles: (state) => state.roles,
    totalUsers: (state) => state.users.length,
    totalRoles: (state) => state.roles.length,
    getErrors: (state) => state.errors,
    getSuccessMsg: (state) => state.successMsg,
  },
  actions: {
    async fetchUsers() {
      try {
        this.users = [];
        const response = await axios.post("/api/users", this.params);
        this.users = response.data.users.data;
        this.params.totalPages = response.data.users.last_page;
        this.params.page = response.data.users.current_page;
        this.params.size = response.data.users.per_page;
      } catch (error) {
        console.log(error);
      }
    },
    async fetchRoles() {
      try {
        this.roles = [];
        const response = await axios.post("/api/roles");
        this.roles = response.data.roles.data;
        this.params.totalPages = response.data.roles.last_page;
        this.params.page = response.data.roles.current_page;
        this.params.size = response.data.roles.per_page;
      } catch (error) {
        console.log(error);
      }
    },
    async fetchPermissions() {
      try {
        this.permissions = [];
        const response = await axios.post("/api/permissions");
        this.permissions = response.data.permissions.data;
      } catch (error) {
        console.log(error);
      }
    },
    async addUser(user) {
      if (this.loading) return;
      this.reset();
      this.loading = true;
      try {
        this.users = [user, ...this.users];
        const response = await axios.post("/api/users/create", user);
        if (response.status === 201) {
          this.successMsg = response.data.message;
        }
      } catch (error) {
        if (error.response.status === 422) {
          this.errors = error.response.data.errors;
        }
      } finally {
        this.loading = false;
      }
    },
    async addRole(role) {
      if (this.loading) return;
      this.reset();
      this.loading = true;
      try {
        this.roles = [role, ...this.roles];
        const response = await axios.post("/api/roles/create", role);
        if (response.status === 201) {
          this.successMsg = response.data.message;
        }
      } catch (error) {
        if (error.response.status === 422) {
          this.errors = error.response.data.errors;
        }
      } finally {
        this.loading = false;
      }
    },
    async updateUser(form) {
      if (this.loading) return;
      this.reset();
      this.loading = true;

      try {
        const response = await axios.post(
          `/api/users/${form.get("user_id")}/edit`,
          form
        );

        if (response.status === 202) {
          this.successMsg = response.data.message;
        }
      } catch (error) {
        console.log(error);
        if (error.response.status === 422) {
          this.errors = error.response.data.errors;
        }
      } finally {
        this.loading = false;
      }
    },
    async updateRole(form) {
      if (this.loading) return;
      this.reset();
      this.loading = true;
      try {
        const response = await axios.put(
          `/api/roles/${form.role_id}/edit`,
          form
        );

        if (response.status === 202) {
          this.successMsg = response.data.message;
        }
      } catch (error) {
        if (error.response.status === 422) {
          this.errors = error.response.data.errors;
        }
      } finally {
        this.loading = false;
      }
    },
    async fetchUser(id) {
      if (this.loading) return;
      this.reset();
      this.loading = true;
      try {
        const response = await axios.get(`/api/users/${id}`);
        if (response.status === 200) {
          this.successMsg = response.data.message;
          this.user = response.data.user;
        }
      } catch (error) {
        if (error.response.status === 422) {
          this.errors = error.response.data.errors;
        }
      } finally {
        this.loading = false;
      }
    },
    async deleteRole(id) {
      this.reset();
      try {
        const index = this.roles.findIndex((role) => role.id == id);
        this.roles.splice(index, 1);
        const response = await axios.delete(`/api/roles/${id}/delete`);
        if (response.status === 200) {
          this.successMsg = response.data.message;
          this.user = response.data.user;
        }
      } catch (error) {
        this.errors = error.response.data;
      }
    },
    async deleteUser(id) {
      this.reset();
      try {
        const index = this.roles.findIndex((role) => role.id == id);
        this.roles.splice(index, 1);
        const response = await axios.delete(`/api/users/${id}/delete`);
        if (response.status === 200) {
          this.successMsg = response.data.message;
          this.user = response.data.user;
        }
      } catch (error) {
        this.errors = error.response.data;
      }
    },
    reset() {
      this.errors = [];
      this.successMsg = "";
    },
  },
});
