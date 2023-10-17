<template>
  <div class="" style="padding: 1rem 1.5rem">
    <h2 class="text-2xl font-bold">{{ $t("Pages") }}</h2>
    <p class="text-lg" style="color: #42a5f5; padding: 0.5rem 0">
      {{ $t("Pages_menu") }}
    </p>
  </div>

  <div
    class="px-6 py-2 mt-2 mb-12 rounded-lg shadow-sm cursor-pointer item flex justify-between bg-gray-50"
    v-for="page in pages"
  >
    <div class="relative flex flex-col items-center mx-4">
      <p class="text-sm">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="w-6 h-6"
          @click="openModal(page)"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
          />
        </svg>
      </p>
    </div>
    <div class="flex flex-col items-end">
      <p class="text-xl py-1">{{ page.title }}</p>
      <p class="text-base py-1 px-2">
        {{ page.description }}
      </p>
    </div>
  </div>

  <!-- update modal -->
  <div>
    <v-row justify="center">
      <v-dialog v-model="update_modal" persistent width="1024">
        <v-card class="pa-5" style="border-radius: 12px">
          <v-card-title>
            <span class="text-h5">Update Page</span>
          </v-card-title>
          <v-card-text>
            <v-row>
              <v-col cols="12">
                <div class="mb-6">
                  <label for="page_title">Title</label>
                  <input
                    name="page_title"
                    id="page_title"
                    type="text"
                    v-model="page_model_title"
                    style="width: 100%; border: 2px solid gray"
                    class="focus:ring-gray-400"
                  />
                </div>
                <div class="">
                  <label for="page_description">Description</label>
                  <textarea
                    name="page_description"
                    id="page_description"
                    v-model="page_model_description"
                    style="width: 100%; border: 2px solid gray"
                    class="focus:ring-gray-400"
                    rows="5"
                  ></textarea>
                </div>
              </v-col>
            </v-row>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              color="blue-darken-1"
              variant="text"
              @click="update_modal = false"
            >
              Close
            </v-btn>
            <v-btn color="blue-darken-1" variant="text" @click="updatePage">
              Save
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-row>
  </div>
</template>
<script>
import axios from "axios";

export default {
  data() {
    return {
      pages: [],
      page_model_id: null,
      page_model_title: null,
      page_model_description: null,
      update_modal: false,
    };
  },
  methods: {
    getPages() {
      axios
        .get("/api/site/pages")
        .then((res) => {
          console.log(res);
          if (res.data.pages == null) {
            return;
          }
          this.pages = res.data.pages;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    updatePage() {
      axios
        .post(`/api/site/pages/${this.page_model_id}`, {
          title: this.page_model_title,
          description: this.page_model_description,
        })
        .then((res) => {
          console.log(res);
          const index = this.pages.findIndex(
            (page) => page.id == res.data.pages.id
          );
          this.pages[index] = res.data.pages;
          this.update_modal = false;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    openModal(page) {
      this.page_model_id = page.id;
      this.page_model_title = page.title;
      this.page_model_description = page.description;
      this.update_modal = true;
    },
  },
  mounted() {
    this.getPages();
  },
};
</script>
<style>
.item:hover {
  background-color: #e6f8f6;
  transition: all linear 300ms;
}
</style>
