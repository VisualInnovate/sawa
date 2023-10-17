<script>
import axios from "axios";
import InputText from "primevue/inputtext";
import moment from "moment";
import Calendar from "primevue/calendar";
import { max } from "date-fns";
export default {
  components: { InputText, Calendar },
  data: () => ({
    minDate: new Date(1640426400000),
    maxDate: new Date(),

    NameRules: [
      (value) => {
        if (value?.length >= 3) return true;

        return " name must be at least 3 characters.";
      },
    ],
    child: {
      name: "",
      birth_date: "",
    },
    alert_text: null,
    snackbar: true,
  }),
  methods: {
    goBack() {
      this.$router.go(-1);
    },
    submit() {
      this.child.birth_date = moment(this.child.birth_date).format(
        "YYYY-MM-DD"
      );
      console.log(this);

      console.log(this.child.birth_date);

      axios.post(`/api/child/create`, this.child).then((res) => {
        if (res.data.status == 200) {
          this.child = [];
          this.alert_text = "children added successfully ";
        }
      });
    },
  },
  mounted() {
    console.log(moment(new Date()).format(" YYYY-MM-DD"));
  },
};
</script>
<template>
  <!--  <v-alert v-if="alert_text!= null " color="green" :text="alert_text" class="mb-5"></v-alert>-->

  <div>
    <v-btn height="45" class="mb-5 text-white" color="#135C65" @click="goBack">
      <v-icon start icon="mdi-arrow-left"></v-icon>
      {{ $t("back") }}
    </v-btn>

    <v-sheet max-width="1200" class="mx-auto">
      <v-alert
        type="success"
        variant="tonal"
        border="start"
        elevation="2"
        closable
        :close-label="$t('close')"
        :text="alert_text"
        v-if="alert_text != null"
        class="mb-8"
      >
      </v-alert>
      <v-form fast-fail @submit.prevent>
        <v-text-field
          v-model="child.name"
          :label="$t('child_name')"
          :rules="NameRules"
        ></v-text-field>
        <!-- <div style="width: 100%;" class="card flex  justify-content-center">
        <InputText  style="width: 100%; padding: 10px; opacity: 70%;" type="date" :rules="NameRules"  v-model=" child.birth_date" />
    </div> -->
        <!-- <input type="text" sty placeholder="MM/DD/YY"
                    onfocus="(this.type='date')"> -->
        <div class="card flex justify-content-center">
          <Calendar
            style="width: 100%"
            showButtonBar
            v-model.number="child.birth_date"
            showIcon
            placeholder="dd/mm/yy"
            :maxDate="maxDate"

          />
        </div>

        <!-- <v-text-field
          v-model="child.birth_date"
          :label="$t('birth_date')"
          type="date"
      ></v-text-field> -->
        <v-btn type="submit" @click="submit" block class="mt-2">{{
          $t("submit")
        }}</v-btn>
      </v-form>
    </v-sheet>
  </div>
</template>
