<template>
  <div
    class="rounded-lg py-2 shadow-md px-4 max-w-full mb-4 min-w-min bg-gray-100"
  >
    <div class="pt-4 font-bold rounded flex justify-between">
      <div class="flex">
        <div><img src="../image/header/Group463.png" /></div>
        <p class="text-xl m-auto p-2 pb-0 text-right font-semibold">
          {{ $t("Sawa_Academy_for_Special_Education") }}
        </p>
      </div>
      <div class="my-auto text-right font-semibold text-lg text-[#148A98]">
        {{ notification.data.data.event_date }}
      </div>
    </div>
    <div class="rounded text-right font-semibold text-lg">
      <p class="block py-2">{{ notification.data.message }}</p>
      <p class="block py-2">
       
        {{ $t("Jurisdiction_name") }} :  
        <span style="color: #135c65">{{
          notification.data.data.doctor_name
        }}</span>
      </p>
      <p class="block py-2">
        {{ $t("Jurisdiction") }} :
        <span style="color: #135c65">{{
          notification.data.data.doctor_title
        }}</span>
      </p>
      <p class="block py-2">
       
       {{ $t("Consultation_date") }} : 
        <span style="color: #135c65">{{
          notification.data.data.event_start
        }}</span>
      </p>
    </div>
  </div>
</template>
<script>
export default {
  props: ["date", "notification"],
};
</script>
