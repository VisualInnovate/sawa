// Vuetify
import { createVuetify } from "vuetify";
import { aliases, mdi } from "vuetify/iconsets/mdi";
// import i18n from "../i18n";

// add localization
// import { createVueI18nAdapter } from "vuetify/locale/adapters/vue-i18n";

// import { useI18n } from "vue-i18n";

import { VDataTable } from 'vuetify/labs/VDataTable'

export default createVuetify({
    icons: {
        defaultSet: "mdi",
        iconfont: "mdi",
        aliases,
        sets: {
            mdi,
        },
    },
    theme: {
        defaultTheme: 'light',
    },
    components: {
        VDataTable,
    },
    defaults: {
        VDataTable: {
            fixedHeader: true,
            noDataText: 'Results not found',
        },
    },
});


