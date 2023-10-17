<template>
    <div class="max-h-screen">
      <Map />
    <LoginForm />
    </div>
    <About />
</template>
<script>
import Map from "../components/Map.vue";
import LoginForm from "../components/LoginForm.vue";
import About from "../components/About.vue";
import axios from "axios";
import { useParentStore } from "../../../stores/ParentStore";

export default {
  components: { Map, LoginForm, About },

  data() {
    return {
      parentStore: useParentStore(),
      // alert: {
      //   show: false,
      //   message: "",
      //   errors: [],
      // },
    };
  },
  methods: {
    // login(parent) {
    //   console.log(parent);
    //   axios
    //     .post("api/parent/login", parent)
    //     .then((res) => {
    //       console.log(res);
    //     })
    //     .catch((err) => {
    //       this.alert.show = true;
    //       this.alert.message = err.response.data.message;
    //       this.alert.errors = err.response.data.errors;
    //       console.log(err);
    //     });
    // },
  },
};
</script>
