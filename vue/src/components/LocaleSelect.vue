<script setup>
import { computed } from "vue";
import i18n from "../plugins/i18n";

import { useAppLangStore } from "../stores/AppLangStore";

const appLang = useAppLangStore();

const localeBtn = computed({
  get() {
    if (appLang.appLang == "en") return "ar";
    else return "en";
  },
  set(val) {
    appLang.appLang = val;
  },
});

const changeLocale = () => {
  i18n.global.locale.value == "ar" ? executeArCode() : executeEnCode();
};

const executeArCode = () => {
  document.body.dir = "ltr";
  let k = document.getElementsByClassName("switcher");
  console.log(k);
  k[0].dir = "ltr";

  i18n.global.locale.value = "en";
  appLang.setAppLang(i18n.global.locale.value);
  appLang.setAppRtl(false);
};

const executeEnCode = () => {
  document.body.dir = "rtl";
  let k = document.getElementsByClassName("switcher");
  console.log(k);
  k[0].dir = "rtl";
  i18n.global.locale.value = "ar";
  appLang.setAppLang(i18n.global.locale.value);
  appLang.setAppRtl(true);
};
</script>

<template>
  <v-btn @click="changeLocale">
    {{ localeBtn }}
    <v-icon icon="mdi-flag" class="mx-2" />
  </v-btn>
</template>

<style scoped>
:deep(.v-input__control) {
  max-width: 60px;
}
</style>
