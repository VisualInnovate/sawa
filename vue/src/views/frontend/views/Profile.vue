<template>
  <div class="">
    <Map />
    <div class="w-full border-b-2 border-x-cyan-950 border-solid">
      <div class="m-auto w-full">
        <p class="text-center p-4 text-2xl text-[#6EB7BF]">
          {{ $t("Profile_personly") }}
        </p>
      </div>
    </div>
    <div class="relative flex selection max-h-full">
      <sidbar class="" :sole="showsider" />
      <div class="flex-1 space-y-10">
        <div class="bg-white text-2xl font-bold  text-[#6EB7BF] py-4 px-2 ">
          <button class="font-bold">{{ $t("Modify_profile") }}</button>
        </div>
        <p
          v-if="show_alert"
          class="text-center text-xl font-bold tracking-wide"
          style="color: green"
        >
          {{ alert_text }}
        </p>
        <div class="p-2">
          <div class="block max-w-lg m-auto rounded-lg space-y-6 bg-white">
            <div class="relative m-auto">
              <input
                type="file"
                ref="fileInput"
                name="image"
                id="image"
                hidden
                @change="handleFileUpload"
              />
              <img
                @click="openFile"
                :src="imageSrc"
                class="uploaded-image relative m-auto cursor-pointer rounded-full"
              />

              <svg
                @click="openFile"
                class="cursor-pointer absolute left-[50%] m-auto bottom-0 bg-white rounded-full p-1 h-8 w-8"
                viewBox="-2.4 -2.4 28.80 28.80"
                xmlns="http://www.w3.org/2000/svg"
                fill="#29CCFF"
                transform="matrix(-1, 0, 0, 1, 0, 0)"
              >
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g
                  id="SVGRepo_tracerCarrier"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                ></g>
                <g id="SVGRepo_iconCarrier">
                  <path
                    fill="#29CCFF"
                    d="M21 3H3C1.35 3 0 4.35 0 6v12c0 1.55 1.19 2.83 2.7 2.98.1.01.2.02.3.02h18c.1 0 .2 0 .29-.02.03 0 .06-.01.09-.01C22.86 20.78 24 19.52 24 18V6c0-1.65-1.35-3-3-3zm1 13.53l-2.21-4.42c-.25-.5-.69-.87-1.22-1.03-.19-.05-.38-.08-.57-.08-.35 0-.7.09-1.01.27l-6.41 3.74-2.46-1.67C7.78 13.11 7.39 13 7 13c-.52 0-1.03.2-1.41.59L2 17.18V6c0-.55.45-1 1-1h18c.55 0 1 .45 1 1v10.53z"
                  ></path>
                  <circle fill="#29CCFF" cx="11" cy="10" r="2"></circle>
                </g>
              </svg>
            </div>
            <div style="font-size: 16px" class="flex">
              <p class="m-auto text-center text-[#FF3765]">
                تنبيه هام : برجاء اختيار حجم الصوره 440 بسكل * 660 بسكيل
              </p>
              <div class="px-1 card flex justify-content-center">
                <Knob
                  text-color="#FFD02B"
                  rangeColor="white"
                  valueColor="#FFD02B"
                  :strokeWidth="5"
                  :size="70"
                  class="h-28"
                  v-model="value"
                />
              </div>
            </div>
            <div class="grid grid-cols-2">
              <div
                class="m-auto ml-4 bg-[#F8F8F8]"
                style="
                  display: flex;
                  align-items: center;
                  border-bottom: 2px solid rgb(0, 0, 0);
                "
              >
                <input
                  style="font-size: 20px"
                  class="backdrop-blur-md bg-white/30 focus:ring-0 w-full p-2 text-center border-0"
                  type="text"
                  v-model="parent.lname"
                  :placeholder="$t('first_name')"
                />
              </div>
              <div
                class="m-auto ml-4 bg-[#F8F8F8]"
                style="
                  display: flex;
                  align-items: center;
                  border-bottom: 2px solid rgb(0, 0, 0);
                "
              >
                <input
                  style="font-size: 20px"
                  class="backdrop-blur-md bg-white/30 focus:ring-0 w-full p-2 text-center border-0"
                  type="text"
                  v-model="parent.fname"
                  :placeholder="$t('family_name')"
                />
              </div>
            </div>
            <div
              class="m-auto bg-[#F8F8F8]"
              style="
                display: flex;
                align-items: center;
                border-bottom: 2px solid rgb(0, 0, 0);
              "
            >
              <input
                style="font-size: 18px"
                class="backdrop-blur-md bg-white/30 focus:ring-0 w-full p-2 text-center border-0"
                type="email"
                v-model="parent.email"
                :placeholder="$t('email')"
              />
            </div>
            <div
              class="m-auto bg-[#F8F8F8]"
              style="
                display: flex;
                align-items: center;
                border-bottom: 2px solid rgb(0, 0, 0);
              "
            >
              <input
                style="font-size: 18px"
                class="backdrop-blur-md bg-white/30 focus:ring-0 w-full p-2 text-center border-0"
                type="password"
                placeholder="password"
                v-model="parent.password"
              />
            </div>
            <button
              @click="updateProfile"
              class="p-4 mt-10 text-center bg-[#148A98] text-white w-full rounded-2xl text-xl"
            >
              حفظ التغيرات
            </button>
          </div>
        </div>
      </div>
    </div>
    <About />
  </div>
</template>
<script>
import Map from "../components/Map.vue";
import Sidbar from "../components/Sidbar.vue";
import About from "../components/About.vue";
import Knob from "primevue/knob";
import FileUpload from "primevue/fileupload";
import { useParentStore } from "../../../stores/ParentStore";
import axios from "axios";

export default {
  components: { Map, Sidbar, About, Knob, FileUpload },
  data() {
    return {
      imageSrc: null,
      image: null,
      parentStore: useParentStore(),
      parent: {
        fname: "",
        lname: "",
        email: "",
        password: "",
        image: null,
      },
      alert_text: "",
      show_alert: false,
      showsider: false,
      value: 65,
      editableValue: "Edit me!",
      editing: false,
    };
  },
  methods: {
    toggleEditing() {
      this.editing = !this.editing;
    },
    toggle() {
      this.showsider = !this.showsider;
    },
    getUserProfile() {
      axios
        .get("/api/parent/user")
        .then((res) => {
          this.parent = res.data.user;
          this.imageSrc = this.parent.image;
          console.log(res);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    openFile() {
      this.$refs.fileInput.click();
    },
    handleFileUpload(e) {
      const image = e.target.files[0];
      const reader = new FileReader();
      reader.readAsDataURL(image);
      reader.onload = (e) => {
        this.imageSrc = e.target.result;
        this.parent.image = image;
        console.log(this.imageSrc);
      };
    },
    updateProfile() {
      this.show_alert = false;
      this.alert_text = null;
      let self = this;
      const formData = new FormData();

      formData.append("fname", this.parent.fname);
      formData.append("lname", this.parent.lname);
      formData.append("email", this.parent.email);
      if (this.$refs.fileInput.files[0] != null) {
        formData.append("image", this.$refs.fileInput.files[0]);
      }
      if (this.parent.password != null) {
        formData.append("password", this.parent.password);
      }

      axios
        .post("/api/parent/profile", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((res) => {
          this.show_alert = true;
          this.alert_text = this.$t("profile_updated");
          this.parentStore.parent.image = res.data.profile.image;
          console.log(res);
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
  computed: {
    imageClass() {
      // Return a string of Tailwind CSS classes to set the width of the image
      return this.imageSrc ? ["w-40", "h-0"] : ""; // Adjust the 'w-64' class to set the desired width
    },
    // methods: {
    //   toggleEditing() {
    //     this.editing = !this.editing;
    //   },
    //   toggle() {
    //     this.showsider = !this.showsider;
    //   },
    //   home() {},
    //   onUpload() {
    //     this.$toast.add({
    //       severity: "info",
    //       summary: "Success",
    //       detail: "File Uploaded",
    //       life: 3000,
    //     });
    //   },
    //   openFileUpload() {
    //     // Get the file input element using the "ref" attribute
    //     const fileInput = this.$refs.fileInput;

    //     // Trigger the click event on the file input element
    //     fileInput.click();
    //   },
    //   handleFileUpload(event) {
    //     // Handle the file selection here
    //     const selectedFile = event.target.files[0];
    //     if (selectedFile) {
    //       // Create a FileReader to read the file as a data URL
    //       const reader = new FileReader();
    //       reader.onload = (e) => {
    //         // Set the imageSrc data property with the data URL of the selected image
    //         this.imageSrc = e.target.result;
    //       };
    //       // Read the selected file as a data URL
    //       reader.readAsDataURL(selectedFile);
    //     }
    //   },
    // },
  },
  mounted() {
    this.getUserProfile();
  },
};
</script>
<style>
.uploaded-image {
  width: 101px;
  height: 101px;
}
</style>
