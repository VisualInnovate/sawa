<template>
  <div
      style="background-color: #135c65"
      class="flex justify-between  text-center"
  >
    <div class="flex mx-2 ">
      <div class="m-auto">
        <p style="font-size:100%" class="text-white text-base">
          <v-icon
          end
          icon="mdi-map-marker"
          class="  text-[#FFCF24]  h-full  "
      ></v-icon>
      {{ $t("Amman_Rabieh_Maysaloon_Street") }}
          
        </p>
        
      </div>
      <div class="mx-2 m-auto">
        <p style="font-size:100%"  class=" text-white text-base">
          <v-icon
          end
          icon="mdi-phone"
          class="  text-[#FFCF24]   h-full rotate-180 "
      ></v-icon>
          التواصل : 0096265522688-00962791017001
         
        </p>
      </div>
      <div class="h-full pt-3">
        <LocaleSelect class="" id="local-switcher" />
      </div>
    </div>
      <div class="flex">
     
      <div class="my-auto  "> <router-link to="/web"><img class="h-[80%] cursor-pointer" src="../image/header/Group22.png" /></router-link></div>
      </div>

  </div>

</template>
<script>
import LocaleSelect from "../../../components/LocaleSelect.vue";
export default {
  components:{
    LocaleSelect
  }
}
</script>
