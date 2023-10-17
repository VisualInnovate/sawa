<template>
    <section style="" class="bg-gray-50 dark:bg-gray-900   bl  bg-[url('../image/header/112.png')] bg-no-repeat bg-cover  backdrop-blur-sm bg-white/30">
        <div class="backdrop-blur-sm bg-white/30 p-6 md:grid md:grid-cols-12">
            <div class="">
                <button class=" md:text-2xl  text-xl">
                    <router-link  class=" flex" to="/">
                        <p class="pt-4   ">الرئيسيه</p>
                        <font-awesome-icon class="bg-[#135C65] rounded-[50%] m-2 p-4" icon="fa-solid fa-arrow-left" />
                    </router-link>
                </button>
            </div>
            <div class=" flex flex-col items-center justify-between px-6 md:h-screen mx-auto  md:col-span-10 lg:py-0">
                 <div class="text-center my-3">
                    <h1 class="text-3xl py-5 font-bold">انشاء حساب </h1>
                    <p class="text-xl">يمكنك الان تسجيل الدخول للحساب خاص بك لدينا لمتابعه طلباتك مباشره</p>
                 </div>
                <div class="mb-24 w-full backdrop-blur-xl bg-white/30  rounded-3xl relative shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700 ">
                    <div class="p-2  md:space-y-6 sm:p-8">
                        <form class=" md:space-y-6 text-center rounded-2xl  p-4 bg-none" action="#">
                           <div>
                             <h3>ادخل كود التفعيل</h3>
                             <p class="text-[#135C65]">+20 01204521022</p>
                           </div>
                           <button class="absolute top-0 right-[5%] text-3xl"><font-awesome-icon class="" icon="fa-solid fa-xmark"></font-awesome-icon></button>
                          
                            <div>
                                <input class=" backdrop-blur-md bg-white/30 w-full p-2 m-2 mb-0 text-center border-0 border-b-2 border-black border-solid  " type="tel" name="email"  placeholder="  " required="">
                            </div>
                            <p class="text-right underline underline-offset-1"><a>اعاده ارسال الكود</a></p>
                            
                            <button class=" w-full p-2 my-4  lg:m-0 rounded-3xl bg-[#23D1E6]">تاكيد </button>
                            <p>اذا كنت تمتلك حساب اضغط هنا <router-link to="/Login" class="px-2 text-[#649297] ">تسجيل الدخول</router-link></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </section>
</template>