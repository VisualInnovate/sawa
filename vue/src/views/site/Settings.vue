<template>
  <div class="" style="padding: 1rem 1.5rem">
    <h2 class="text-2xl font-bold">{{ $t("Settings") }}</h2>
    <p class="text-lg" style="color: #42a5f5; padding: 0.5rem 0">
      {{ $t("settings_menu") }}
    </p>
  </div>
  <v-container class="container">
    <v-row>
      <!-- Social Links -->
      <v-col cols="3">
        <div class="flex-input m2">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            x="0px"
            y="0px"
            width="48"
            height="48"
            viewBox="0 0 48 48"
          >
            <path
              fill="#039be5"
              d="M24 5A19 19 0 1 0 24 43A19 19 0 1 0 24 5Z"
            ></path>
            <path
              fill="#fff"
              d="M26.572,29.036h4.917l0.772-4.995h-5.69v-2.73c0-2.075,0.678-3.915,2.619-3.915h3.119v-4.359c-0.548-0.074-1.707-0.236-3.897-0.236c-4.573,0-7.254,2.415-7.254,7.917v3.323h-4.701v4.995h4.701v13.729C22.089,42.905,23.032,43,24,43c0.875,0,1.729-0.08,2.572-0.194V29.036z"
            ></path>
          </svg>
          <input
            style="font-size: 20px"
            class="bg-white/30 focus:ring-0 w-full text-center"
            type="text"
            v-model="settings.social_links.facebook"
            placeholder="Facebook"
          />
        </div>

        <div class="flex-input m2">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            x="0px"
            y="0px"
            width="48"
            height="48"
            viewBox="0 0 48 48"
          >
            <radialGradient
              id="yOrnnhliCrdS2gy~4tD8ma_Xy10Jcu1L2Su_gr1"
              cx="19.38"
              cy="42.035"
              r="44.899"
              gradientUnits="userSpaceOnUse"
            >
              <stop offset="0" stop-color="#fd5"></stop>
              <stop offset=".328" stop-color="#ff543f"></stop>
              <stop offset=".348" stop-color="#fc5245"></stop>
              <stop offset=".504" stop-color="#e64771"></stop>
              <stop offset=".643" stop-color="#d53e91"></stop>
              <stop offset=".761" stop-color="#cc39a4"></stop>
              <stop offset=".841" stop-color="#c837ab"></stop>
            </radialGradient>
            <path
              fill="url(#yOrnnhliCrdS2gy~4tD8ma_Xy10Jcu1L2Su_gr1)"
              d="M34.017,41.99l-20,0.019c-4.4,0.004-8.003-3.592-8.008-7.992l-0.019-20	c-0.004-4.4,3.592-8.003,7.992-8.008l20-0.019c4.4-0.004,8.003,3.592,8.008,7.992l0.019,20	C42.014,38.383,38.417,41.986,34.017,41.99z"
            ></path>
            <radialGradient
              id="yOrnnhliCrdS2gy~4tD8mb_Xy10Jcu1L2Su_gr2"
              cx="11.786"
              cy="5.54"
              r="29.813"
              gradientTransform="matrix(1 0 0 .6663 0 1.849)"
              gradientUnits="userSpaceOnUse"
            >
              <stop offset="0" stop-color="#4168c9"></stop>
              <stop offset=".999" stop-color="#4168c9" stop-opacity="0"></stop>
            </radialGradient>
            <path
              fill="url(#yOrnnhliCrdS2gy~4tD8mb_Xy10Jcu1L2Su_gr2)"
              d="M34.017,41.99l-20,0.019c-4.4,0.004-8.003-3.592-8.008-7.992l-0.019-20	c-0.004-4.4,3.592-8.003,7.992-8.008l20-0.019c4.4-0.004,8.003,3.592,8.008,7.992l0.019,20	C42.014,38.383,38.417,41.986,34.017,41.99z"
            ></path>
            <path
              fill="#fff"
              d="M24,31c-3.859,0-7-3.14-7-7s3.141-7,7-7s7,3.14,7,7S27.859,31,24,31z M24,19c-2.757,0-5,2.243-5,5	s2.243,5,5,5s5-2.243,5-5S26.757,19,24,19z"
            ></path>
            <circle cx="31.5" cy="16.5" r="1.5" fill="#fff"></circle>
            <path
              fill="#fff"
              d="M30,37H18c-3.859,0-7-3.14-7-7V18c0-3.86,3.141-7,7-7h12c3.859,0,7,3.14,7,7v12	C37,33.86,33.859,37,30,37z M18,13c-2.757,0-5,2.243-5,5v12c0,2.757,2.243,5,5,5h12c2.757,0,5-2.243,5-5V18c0-2.757-2.243-5-5-5H18z"
            ></path>
          </svg>
          <input
            style="font-size: 20px"
            class="bg-white/30 focus:ring-0 w-full text-center"
            type="text"
            v-model="settings.social_links.instagram"
            placeholder="Instagram"
          />
        </div>

        <div class="flex-input m2">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            x="0px"
            y="0px"
            width="48"
            height="48"
            viewBox="0 0 48 48"
          >
            <linearGradient
              id="_osn9zIN2f6RhTsY8WhY4a_5MQ0gPAYYx7a_gr1"
              x1="10.341"
              x2="40.798"
              y1="8.312"
              y2="38.769"
              gradientUnits="userSpaceOnUse"
            >
              <stop offset="0" stop-color="#2aa4f4"></stop>
              <stop offset="1" stop-color="#007ad9"></stop>
            </linearGradient>
            <path
              fill="url(#_osn9zIN2f6RhTsY8WhY4a_5MQ0gPAYYx7a_gr1)"
              d="M46.105,11.02c-1.551,0.687-3.219,1.145-4.979,1.362c1.789-1.062,3.166-2.756,3.812-4.758	c-1.674,0.981-3.529,1.702-5.502,2.082C37.86,8.036,35.612,7,33.122,7c-4.783,0-8.661,3.843-8.661,8.582	c0,0.671,0.079,1.324,0.226,1.958c-7.196-0.361-13.579-3.782-17.849-8.974c-0.75,1.269-1.172,2.754-1.172,4.322	c0,2.979,1.525,5.602,3.851,7.147c-1.42-0.043-2.756-0.438-3.926-1.072c0,0.026,0,0.064,0,0.101c0,4.163,2.986,7.63,6.944,8.419	c-0.723,0.198-1.488,0.308-2.276,0.308c-0.559,0-1.104-0.063-1.632-0.158c1.102,3.402,4.299,5.889,8.087,5.963	c-2.964,2.298-6.697,3.674-10.756,3.674c-0.701,0-1.387-0.04-2.065-0.122C7.73,39.577,12.283,41,17.171,41	c15.927,0,24.641-13.079,24.641-24.426c0-0.372-0.012-0.742-0.029-1.108C43.483,14.265,44.948,12.751,46.105,11.02"
            ></path>
          </svg>
          <input
            style="font-size: 20px"
            class="bg-white/30 focus:ring-0 w-full text-center"
            type="text"
            v-model="settings.social_links.twitter"
            placeholder="Twitter"
          />
        </div>

        <div class="flex-input m2">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            x="0px"
            y="0px"
            width="48"
            height="48"
            viewBox="0 0 48 48"
          >
            <linearGradient
              id="PgB_UHa29h0TpFV_moJI9a_9a46bTk3awwI_gr1"
              x1="9.816"
              x2="41.246"
              y1="9.871"
              y2="41.301"
              gradientUnits="userSpaceOnUse"
            >
              <stop offset="0" stop-color="#f44f5a"></stop>
              <stop offset=".443" stop-color="#ee3d4a"></stop>
              <stop offset="1" stop-color="#e52030"></stop>
            </linearGradient>
            <path
              fill="url(#PgB_UHa29h0TpFV_moJI9a_9a46bTk3awwI_gr1)"
              d="M45.012,34.56c-0.439,2.24-2.304,3.947-4.608,4.267C36.783,39.36,30.748,40,23.945,40	c-6.693,0-12.728-0.64-16.459-1.173c-2.304-0.32-4.17-2.027-4.608-4.267C2.439,32.107,2,28.48,2,24s0.439-8.107,0.878-10.56	c0.439-2.24,2.304-3.947,4.608-4.267C11.107,8.64,17.142,8,23.945,8s12.728,0.64,16.459,1.173c2.304,0.32,4.17,2.027,4.608,4.267	C45.451,15.893,46,19.52,46,24C45.89,28.48,45.451,32.107,45.012,34.56z"
            ></path>
            <path
              d="M32.352,22.44l-11.436-7.624c-0.577-0.385-1.314-0.421-1.925-0.093C18.38,15.05,18,15.683,18,16.376	v15.248c0,0.693,0.38,1.327,0.991,1.654c0.278,0.149,0.581,0.222,0.884,0.222c0.364,0,0.726-0.106,1.04-0.315l11.436-7.624	c0.523-0.349,0.835-0.932,0.835-1.56C33.187,23.372,32.874,22.789,32.352,22.44z"
              opacity=".05"
            ></path>
            <path
              d="M20.681,15.237l10.79,7.194c0.689,0.495,1.153,0.938,1.153,1.513c0,0.575-0.224,0.976-0.715,1.334	c-0.371,0.27-11.045,7.364-11.045,7.364c-0.901,0.604-2.364,0.476-2.364-1.499V16.744C18.5,14.739,20.084,14.839,20.681,15.237z"
              opacity=".07"
            ></path>
            <path
              fill="#fff"
              d="M19,31.568V16.433c0-0.743,0.828-1.187,1.447-0.774l11.352,7.568c0.553,0.368,0.553,1.18,0,1.549	l-11.352,7.568C19.828,32.755,19,32.312,19,31.568z"
            ></path>
          </svg>
          <input
            style="font-size: 20px"
            class="bg-white/30 focus:ring-0 w-full text-center"
            type="text"
            v-model="settings.social_links.youtube"
            placeholder="Youtube"
          />
        </div>
      </v-col>
      <!-- End Social Links -->

      <!-- Site Settings -->
      <v-col cols="5">
        <div
          style="background-color: #f5f5f5; padding: 2rem"
          class="rounded-xl"
        >
          <div class="m2">
            <input
              style="
                font-size: 20px;
                border-bottom: 2.5px solid gray;
                background: transparent;
              "
              class="focus:ring-0 w-full text-center"
              type="text"
              v-model="settings.name"
              placeholder="Site Name"
            />
          </div>
          <div class="m2">
            <input
              style="
                font-size: 20px;
                border-bottom: 2.5px solid gray;
                background: transparent;
              "
              class="focus:ring-0 w-full text-center"
              type="text"
              v-model="settings.number_1"
              placeholder="Site Phone"
            />
          </div>
          <div class="m2">
            <input
              style="
                font-size: 20px;
                border-bottom: 2.5px solid gray;
                background: transparent;
              "
              class="focus:ring-0 w-full text-center"
              type="text"
              v-model="settings.number_2"
              placeholder="Site Phone"
            />
          </div>
          <div class="m2">
            <input
              style="
                font-size: 20px;
                border-bottom: 2.5px solid gray;
                background: transparent;
              "
              class="focus:ring-0 w-full text-center"
              type="text"
              v-model="settings.address"
              placeholder="Site Address"
            />
          </div>
          <div class="m2">
            <input
              style="
                font-size: 20px;
                border-bottom: 2.5px solid gray;
                background: transparent;
              "
              class="focus:ring-0 w-full text-center"
              type="email"
              v-model="settings.email"
              placeholder="Site Email"
            />
          </div>
          <div class="">
            <textarea
              name="site_description"
              id="site_description"
              rows="5"
              style="
                font-size: 20px;
                border-bottom: 2.5px solid gray;
                background: transparent;
              "
              class="focus:ring-0 w-full text-center"
              type="text"
              v-model="settings.description"
              placeholder="Site Description"
            ></textarea>
          </div>
          <button
            @click="updateSettings"
            class="p-4 mt-10 text-center bg-[#148A98] text-white w-full rounded-2xl text-xl"
          >
            حفظ التغيرات
          </button>
        </div>
      </v-col>
      <!-- End Site Settings -->

      <!-- Site Images -->
      <v-col cols="4">
        <div
          class="text-center font-bold"
          style="
            color: #2a2828;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
          "
        >
          <label for="" style=" font-size: 20px;font;">Site Logo</label>
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
              class="uploaded-image relative m-auto cursor-pointer object-cover"
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

          <label for="" style="padding: 1rem; font-size: 20px;font;"
            >Site Cover</label
          >
          <div class="relative m-auto p-2">
            <input
              type="file"
              ref="fileInputCover"
              name="image"
              id="image"
              hidden
              @change="handleFileUploadCover"
            />
            <img
              @click="openCoverFile"
              :src="imageSrcCover"
              class="uploaded-image relative m-auto cursor-pointer object-cover"
            />

            <svg
              @click="openCoverFile"
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
        </div>
      </v-col>
      <!-- End Site Images -->
    </v-row>
  </v-container>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      imageSrc: null,
      imageSrcCover: null,
      settings: {
        name: "",
        number_1: "",
        number_2: "",
        address: "",
        email: "",
        logo: "",
        cover: "",
        description: "",
        social_links: {
          facebook: "",
          instagram: "",
          twitter: "",
          youtube: "",
        },
      },
    };
  },
  methods: {
    getSettings() {
      axios
        .get("/api/site/settings")
        .then((res) => {
          console.log(res);
          if (res.data.settings == null) {
            return;
          }
          this.settings = res.data.settings;
          this.settings.social_links = JSON.parse(
            res.data.settings.social_links
          ).links;
          this.imageSrc = this.settings.logo;
          this.imageSrcCover = this.settings.cover;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    openFile() {
      this.$refs.fileInput.click();
    },
    openCoverFile() {
      this.$refs.fileInputCover.click();
    },
    handleFileUpload(e) {
      const image = e.target.files[0];
      const reader = new FileReader();
      reader.readAsDataURL(image);
      reader.onload = (e) => {
        this.imageSrc = e.target.result;
        this.settings.logo = image;
      };
    },
    handleFileUploadCover(e) {
      const image = e.target.files[0];
      const reader = new FileReader();
      reader.readAsDataURL(image);
      reader.onload = (e) => {
        this.imageSrcCover = e.target.result;
        this.settings.cover = image;
      };
    },
    updateSettings() {
      const formData = new FormData();

      formData.append("name", this.settings.name);
      formData.append("number_1", this.settings.number_1);
      formData.append("number_2", this.settings.number_2);
      formData.append("address", this.settings.address);
      formData.append("email", this.settings.email);
      formData.append("description", this.settings.description);
      formData.append(
        "social_links",
        JSON.stringify({ links: this.settings.social_links })
      );
      if (this.$refs.fileInput.files[0] != null) {
        formData.append("logo", this.$refs.fileInput.files[0]);
      }
      if (this.$refs.fileInput.files[0] != null) {
        formData.append("cover", this.$refs.fileInputCover.files[0]);
      }
      axios
        .post("/api/site/settings", formData)
        .then((res) => {
          console.log(res);
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
  mounted() {
    this.getSettings();
  },
};
</script>
<style>
.container {
  display: flex;
  justify-content: center;
  align-items: center;
}
.flex-input {
  margin: 0;
  padding: 0;
  display: flex;
  align-items: center;
  justify-content: space-between;
  border-bottom: 2.5px solid gray;
}
.flex-center-col {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}
.m2 {
  margin: 2rem;
}
.uploaded-image {
  width: 250px;
  height: 250px;
}
</style>
