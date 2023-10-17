<!-- <template>
    <div class=" m-auto md:grid md:grid-cols-3" >
        <div class="aa m-2 border-2 border-neutral-300 border-solid rounded-3xl relative truncate" v-for="(e,i) in cardinfo" :key="i">
            <div><img></div>
            <div class="flex justify-between p-4  text-center">
                <button>
                    <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle cx="12" cy="12" r="10" stroke="#00A9DE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></circle> <path d="M7 12H17M7 12L11 8M7 12L11 16" stroke="#00A9DE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                </button>
                <p style="color:#135C65 ;" class=" text-2xl font-bold tracking-wide	 ">{{e.name}}</p>
            </div>
            <div class="ee flex-wrap w-[50%] h-[87%] top-[0%] left-[50%] bg-white  absolute  translate-x-[100%] "><p class=""> يمكنك من هنا تسجيل طلفك حتي  تتنكمن من التواصل معه</p></div>
        </div>
    </div>

</template>
<script>
export default {
    data(){
        return{
            cardinfo:this.$attrs.carddeta
        }
    },
}
</script> -->
<template>
  <div class="m-auto grid grid-row-3 md:grid-cols-3 gap-3 py-[5%]">
    <div class="animate relative w-full">
      <v-card class="mx-auto w-full rounded-xl" max-width="75%">
        <div>
          <div class="animte right-0 absolute m-auto h-full w-[50%] bg-white">
            <div class="inner p-[10%] m-auto h-full w-full text-[#A5E9FF]">
              <p class="w-full h-full m-auto text-center">
                اكاديمه سوا للتربيه
              </p>
            </div>
          </div>
          <img class="imge" src="../image/sec1/1.png" />
        </div>

        <v-card-actions class="ssc">
          <router-link
            :to="{ name: 'Edit' }"
            class="text-xl lg:text-2xl p-2 text-[#135C65] z-10"
          >
            {{ $t("evaluation_result") }}
          </router-link>
          <v-spacer></v-spacer>
          <router-link
            :to="{ name: 'Edit' }"
           
          >
          <v-btn
            icon="mdi-arrow-left"
            size="small"
            color="#135C65"
            style="border: 2px solid #135c65"
          ></v-btn>
          </router-link>
        </v-card-actions>
      </v-card>
    </div>
    <div class="animate relative">
      <v-card class="mx-auto rounded-xl" max-width="75%">
        <div class="">
          <div class="animte right-0 absolute m-auto h-full w-[50%] bg-white">
            <div class="inner p-[10%] m-auto h-full w-full text-[#A5E9FF]">
              <p class="w-full h-[50%] pt-[20%] text-center">
                اكاديمه سوا للتربيه
              </p>
            </div>
          </div>
          <img class="imge" src="../image/header/2.png" />
        </div>

        <v-card-actions>
          <router-link
            :to="{ name: 'BookingTime' }"
            class="text-xl lg:text-2xl p-2 text-[#135C65] z-10"
          >
            {{ $t("Book_an_appointment") }}
          </router-link>
          <v-spacer></v-spacer>
          <router-link
            :to="{ name: 'BookingTime' }"
           
          >
          <v-btn
            icon="mdi-arrow-left"
            size="small"
            color="#135C65"
            style="border: 2px solid #135c65"
          ></v-btn>
          </router-link>
         
        </v-card-actions>
      </v-card>
    </div>
    <div class="animate relative">
      <v-card class="mx-auto rounded-xl" max-width="75%">
        <div class="w-full">
          <div class="animte right-0 absolute m-auto h-full w-[50%] bg-white">
            <div class="inner p-[10%] m-auto h-full w-full text-[#A5E9FF]">
              <p class="w-full h-full text-center">اكاديمه سوا للتربيه</p>
            </div>
          </div>
          <img class="imge w-full" src="../image/header/3.png" />
        </div>

        <v-card-actions>
          <router-link
            :to="{ name: 'ReAction' }"
            class="lg:text-2xl text-xl p-2 text-[#135C65] z-10"
          >
            {{ $t("Register_your_child") }}
          </router-link>
          <v-spacer></v-spacer>
          <router-link
            :to="{ name: 'ReAction' }"
           
          >
          <v-btn
            icon="mdi-arrow-left"
            size="small"
            color="#135C65"
            style="border: 2px solid #135c65"
          ></v-btn>
          </router-link>
        </v-card-actions>
      </v-card>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {};
  },
};
</script>
<style scoped>
.animte {
  transform: translateX(100%);
  transition: 0.8s;
}
.animate:hover .animte {
  transform: translateX(0%);
}
.animate:hover .imge {
  transform: translateX(-50%);
  transition: 0.8s;
}
</style>
