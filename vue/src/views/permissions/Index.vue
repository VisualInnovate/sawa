<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router';

const router = useRouter();
const items = ref([])
const searchName = ref('')
const headers = ref([
    { text: "Id", value: "id", sortable: false },
    { text: "Name", align: "start", sortable: false, value: "name" },
    { text: "Module", value: "module", sortable: false },
])
const page = ref(1)
const totalPages = ref(0)
const pageSize = ref(10)
const pageSizes = ref([
    5,
    10,
    20
])

const getRequestParams = (searchName, page, pageSize) => {
    let params = {};

if (searchName) {
  params["name"] = searchName;
}

if (page) {
  params["page"] = page;
}

if (pageSize) {
  params["size"] = pageSize;
}

return params;
}

const getItems = async () =>{
    const params = getRequestParams(
        searchName.value,
        page.value,
        pageSize.value
      );
    
    const response = await axios.post('/api/permissions', params)
    const { data, last_page } = response.data.permissions;
    items.value = data.map(getDisplayItem);
    totalPages.value = last_page;
}

const handlePageChange = (value) => {
    page.value = value;
    getItems();
}

const handlePageSizeChange = (size) => {
    pageSize.value = size;
    page.value = 1;
    getItems();
}

const getDisplayItem = (item) => {
    return {
        id: item.id,
        name: item.name,
        module: item.module,
    }
}

const editItem = (id) => {
    router.push({ name: 'EditPermission' , params: {id: id} })
}

const deleteItem = (id) => {
    console.log(id)
}

onMounted(()=>{
   getItems();
})

</script>

<template>
    <v-row align="center" class="list px-3 mx-auto">
      <v-col cols="12" sm="8">
        <v-text-field v-model="searchName" label="Search by Name" @keyup="page = 1; getItems();"></v-text-field>
      </v-col>
    <v-col cols="12" sm="4">
      <v-btn color="success" :to="{ name: 'CreatePermission' }" disabled>
        {{$t('create_button')}}
      </v-btn>
    </v-col>
      <v-col cols="12" sm="12">
        <v-row>
          <v-col cols="4" sm="3">
            <v-select
              v-model="pageSize"
              :items="pageSizes"
              label="Items per Page"
              @update:modelValue="handlePageSizeChange"
            ></v-select>
          </v-col>
  
          <v-col cols="12" sm="9">
            <v-pagination
            rounded="circle"
              v-model="page"
              :length="totalPages"
              total-visible="3"
              next-icon="mdi-menu-right"
              prev-icon="mdi-menu-left"
              @update:modelValue="handlePageChange"
            ></v-pagination>
          </v-col>
        </v-row>
      </v-col>
  
      <v-col cols="12" sm="12">
        <v-card class="mx-auto" tile>
          <v-card-title>Permissions</v-card-title>
  
          <v-table
          >
          <thead>
            <tr>
                <th v-for="header in headers" :key="header.id">{{ header.text }}</th>
            </tr>
          </thead>
          <tbody>
            <tr
            v-for="item in items"
            :key="item.id"
            >
            <td>{{ item.id }}</td>
            <td>{{ item.name }}</td>
            <td>{{ item.module }}</td>
            </tr>
          </tbody>

          </v-table>
        </v-card>
      </v-col>
    </v-row>
</template>
