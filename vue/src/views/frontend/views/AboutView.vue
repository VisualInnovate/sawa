<template>
        <nave-1 />
        <nave />
        
        <div class="2xl:container 2xl:mx-auto lg:py-16 lg:px-20 md:py-12 md:px-6 py-9 px-4 ">
         
          <div style="margin-top: 5%;margin-bottom: 5%;" class="flex flex-col lg:flex-row justify-between gap-8  ">
                <div class="w-full lg:w-5/12 flex flex-col justify-center">
                    <h1 class="text-3xl lg:text-4xl text-center font-bold leading-9 text-gray-800 dark:text-white pb-4">{{ $t("about_us") }}</h1>
                    <p class="font-normal text-base leading-6 text-gray-600 dark:text-white">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum.In the first place we have granted to God, and by this our present charter confirmed for us and our heirs forever that the English Church shall be free, and shall have her rights entire, and her liberties inviolate; and we will that it be thus observed; which is apparent from</p>
                    <p class="font-normal text-base leading-6 text-gray-600 dark:text-white">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum.In the first place we have granted to God, and by this our present charter confirmed for us and our heirs forever that the English Church shall be free, and shall have her rights entire, and her liberties inviolate; and we will that it be thus observed; which is apparent from</p>
                </div>
                <div class="w-[50%] m-auto">
                    <img class=" w-[80%] h-full m-auto" src="../image/sec1/113.png" alt="A group of People" />
                </div>
          </div>
           
            
        </div>
    
        <About />
        



</template>
<script setup(props) { }>
import Nave from "../components/Nave.vue";
import About from "../components/About.vue";
import Nave1 from "../components/Nave1.vue";

export default {
  components: {
    Nave,
    About,
    Nave1,
   
  },
  data() {
    return {
      
    };
  },
};
</script>

