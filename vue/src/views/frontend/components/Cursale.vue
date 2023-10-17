<template>
   <div class=" bg-[url('../image/sec1/Group68.png')] bg-cover bg-[#135C65]">
    <div style="padding: 2%;" class="m-auto w-full space-y-4  ">
        <h1 class="m-auto text-center text-4xl text-white">{{$t("important_thing_that_distinguishes_us")}}</h1>
        <p class="m-auto text-center text-2xl text-[#29CCFF]">{{ $t("make_a_great_effort_to_help_you") }}</p>
    </div>
    <div class="grid grid-cols-10 py-[2%] ">
        <div class="m-auto col-span-2">
            <img class="p-5" src="../image/sec1/3.png">
        </div>
        <div class="col-span-6 m-auto w-full">
            <carousel class="max-w-3xl m-auto "   :autoplay="3000" :wrap-around="true" :breakpoints="breakpoints" >
                <slide  v-for="image in images" :key="image">
             <div style="width: 80%;" class=" m-auto rounded-2xl border-2 border-white">
                <img class="w-full p-2" src="../image/sec1/113.png" >
             </div>
                </slide>
                <template #addons>
                  <navigation class=" bg-[#FFCF24] rounded-[50%]  text-white " />
                </template>
              </carousel>
        </div>
        <div class="m-auto col-span-2">
            <img  class="p-5" src="../image/sec1/2.png">
        </div>
       </div>
       <div class="grid grid-cols-10 ">
        <div class="col-span-2"></div>
        <div class="col-span-8 w-[80%] py-[3%] text-center">
            <p class="text-white text-center"> اكادميه سوا للتربيه الخاصه </p>
            <p class="text-white text-center">هنا سوف تجد جميع الخدمات لطفلك </p>
        </div>
        <div class="col-span-2"></div>
       </div>
   </div>
  </template>
  
  <script>
  // If you are using PurgeCSS, make sure to whitelist the carousel CSS classes
  import 'vue3-carousel/dist/carousel.css'
  import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'
  
  export default {
    name: 'App',
    components: {
      Carousel,
      Slide,
      Pagination,
      Navigation,
    },
    data() {
    return {
      images: [
        {
          url: '../image/sec1/113.png',
          alt: 'Image 1'
        },
        {
            url: '../image/sec1/113.png',          
            alt: 'Image 2'
        },
        {
            url: '../image/sec1/113.png',          
            alt: 'Image 3'
        },
        {
            url: '../image/sec1/113.png',          
            alt: 'Image 4'
        },
        {
            url: '../image/sec1/113.png',          
            alt: 'Image 5'
        }
      ]
    };
  }
  
  }
  </script>