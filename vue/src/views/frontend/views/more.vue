<template>
    <Map></Map>
    <Nave />
    <Cons :event_id="event_id" />
    <About />
</template>
<script setup(props) { }>
import Map from "../components/Map.vue";
import Nave from "../components/Nave.vue";
import About from "../components/About.vue";
import Cons from "../components/Cons.vue";

export default {
  components: { Map, Nave, About, Cons },
  props: ["event_id"],
};
</script>
