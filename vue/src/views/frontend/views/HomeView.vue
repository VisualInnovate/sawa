<script setup></script>

<template>
  <div class="switcher">
    <nave-1 />
    <nave class="w-full z-30" />
    <HeadeForm />
    <Services />
    <card />
    <Cursale></Cursale>
    <DoCard />
    <See />
    <About />
  </div>
</template>
<script setup(props) { }>
// import { useParentStore } from "../../../stores/ParentStore";
import Nave from "../components/Nave.vue";
import HeadeForm from "../components/HeadeForm.vue";
import Services from "../components/Services.vue";
import Card from "../components/Card.vue";
import About from "../components/About.vue";
import DoCard from "../components/DoCard.vue";
import See from "../components/See.vue";
import Nave1 from "../components/Nave1.vue";
import Cursale from "../components/Cursale.vue";
import getcard from "../json/card.json";

export default {
  components: {
    Nave,
    HeadeForm,
    Services,
    Card,
    About,
    DoCard,
    See,
    Nave1,
    Cursale,
  },
  data() {
    return {
      mycard: getcard,
    };
  },

  // mounted() {
  //   if (useParentStore().parentAuth) {
  //     if (useParentStore().user.phone_verified_at == null) {
  //       this.$router.push({ name: "code" });
  //     }
  //   }
  // },
};
</script>
