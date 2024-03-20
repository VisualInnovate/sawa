




<!-- <script>
import axios from "axios";
import ConfirmPopup from "primevue/confirmpopup";
import moment from "moment";

export default {
  components: { ConfirmPopup },

  data() {
    return {
      search: "",
      headers: [],
      parents: [],
      loading: true,
    };
  },
  computed: {
    header() {
      return (this.headers = [
        { key: "id", title: this.$t("index") },
        { key: "fname", title: this.$t("parent.fname") },
        { key: "lname", title: this.$t("parent.lname") },
        { key: "email", title: this.$t("parent.email") },
        { key: "phone", title: this.$t("parent.phone") },
        { key: "image", title: this.$t("parent.image") },
      ]);
    },
  },
  methods: {
    getParents() {
      axios.get("/api/admin-parents").then((res) => {
        this.parents = res.data.parents;
        console.log(res.data.parents);
        this.loading = false;
      });
    },
    fomate(date) {
      return moment(date).format("DD-MM-yy ");
    },
  },
  mounted() {
    this.getParents();
  },
};
</script>

<template>
  <div>
    
    <v-card>
      <v-card-title>
        <h2 style="margin: 1rem 0">
          {{ $t("parents") }}
        </h2>
        <v-spacer></v-spacer>
        <v-text-field
          v-model="search"
          append-icon="mdi-magnify"
          label="Search"
          single-line
          hide-details
        ></v-text-field>
        <v-btn color="primary" @click="getParents">
          {{ $t("search") }}
        </v-btn>
      </v-card-title>
      <v-data-table :headers="header" :items="parents" :search="search">
        <template #top>
          <v-progress-linear
            v-if="loading"
            slot="progress"
            style="color: #135c65"
            indeterminate
          ></v-progress-linear>
        </template>
        <template #item="{ item }">
          <tr>
            <td>{{ item.columns.id }}</td>
            <td>{{ item.columns.fname }}</td>
            <td>{{ item.columns.lname }}</td>
            <td>{{ item.columns.email }}</td>
            <td>{{ item.columns.phone }}</td>
            <td>
              <img
                :src="item.columns.image"
                style="width: 32px; height: 32px; border-radius: 99px"
                alt="no_img"
                srcset=""
              />
            </td>
          </tr>
        </template>
      </v-data-table>
    </v-card>
  </div>
</template> -->
<script setup>
import {FilterMatchMode} from 'primevue/api'
import {ref, onMounted, onBeforeMount} from 'vue'
// import ProductService from '@/service/ProductService';
import {useToast} from 'primevue/usetoast'
import axios from "axios";
import {useRouter} from "vue-router";
const toast = useToast()
const router = useRouter()
const products = ref(null)
const loading = ref(true)
const user = ref({})
const error = ref('')
const users = ref(null)
const productDialog = ref(false)
const deleteDialog = ref(false)
const deleteProductsDialog = ref(false)
const product = ref({})
const selectedProducts = ref(null)
const dt = ref(null)
const filters = ref({})
const submitted = ref(false)
const rate = ref({
    tourist_rating:Number,
    reviewable_id:'',
    type:1
})
const statuses = ref([
  {label: 'INSTOCK', value: 'instock'},
  {label: 'LOWSTOCK', value: 'lowstock'},
  {label: 'OUTOFSTOCK', value: 'outofstock'},
])

// const productService = new ProductService();

onBeforeMount(() => {
  initFilters()
})

 const fetchData= ()=>{


  axios.get("/api/admin-parents").then((res)=>{
    loading.value= false
    users.value= res.data.parents
    console.log(users.value)

  });


}



onMounted(() => {
  // productService.getProducts().then((data) => (products.value = data));
fetchData()

})
const formatCurrency = (value) => {
  return value.toLocaleString('gb-US', {style: 'currency', currency: 'USD'})
}

const openNew = () => {
  router.push({name:'Therapeutic'})
}


const hideDialog = () => {
  productDialog.value = false
  submitted.value = false
}





const confirmDelete = (id) => {
  console.log(id)
  deleteDialog.value = true
  error.value = ref('')
  rate.value.reviewable_id=id
  user.value.id=id
}

const deleteAction = () => {
  axios
    .delete(`/api/admin-parents/delete/${user.value.id}`)
    .then((res) => {
      console.log(res.data)
      deleteDialog.value=false
      fetchData()
      toast.add({severity: 'success', summary: 'Successful', detail: 'Successful', life: 3000})
    })
    .catch(() => {})

}

const findIndexById = (id) => {
  let index = -1
  for (let i = 0; i < products.value.length; i++) {
    if (products.value[i].id === id) {
      index = i
      break
    }
  }
  return index
}
const rateValue = () => {


axios.post(`/api/rating/create-admin`,rate.value).then((res) => {

  fetchData()
  toast.add({ severity: 'success', summary: 'Successful', detail: 'rate send', life: 3000 })
  deleteDialog.value= !(deleteDialog.value)

}).catch((el)=>{
  error.value = el.response.data.errors
})
}

const createId = () => {
  let id = ''
  const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'
  for (let i = 0; i < 5; i++) {
    id += chars.charAt(Math.floor(Math.random() * chars.length))
  }
  return id
}

const exportCSV = () => {
  dt.value.exportCSV()
}

const confirmDeleteSelected = () => {
  deleteProductsDialog.value = true
}
const deleteSelectedProducts = () => {
  products.value = products.value.filter((val) => !selectedProducts.value.includes(val))
  deleteProductsDialog.value = false
  selectedProducts.value = null
  toast.add({severity: 'success', summary: 'Successful', detail: 'Products Deleted', life: 3000})
}

const initFilters = () => {
  filters.value = {
    global: {value: null, matchMode: FilterMatchMode.CONTAINS},
  }
}
</script>

<template>
  <div class="grid">
    <div class="col-12">
      <va-card class="card">
        <Toolbar class="mb-4 shadow-md">
          <template #start>
            <div class="my-2">
            <!-- <Button :label='$t("addProgramType")' icon="pi pi-plus" class="p-button-success mr-2" @click="openNew"></Button> -->
<!--              <Button-->
<!--                label="Delete"-->
<!--                icon="pi pi-trash"-->
<!--                class="p-button-danger"-->
<!--                :disabled="!selectedProducts || !selectedProducts.length"-->
<!--                @click="confirmDeleteSelected"-->
<!--              />-->
            </div>
          </template>

          <template #end>
<!--            <FileUpload-->
<!--              mode="basic"-->
<!--              accept="image/*"-->
<!--              :max-file-size="1000000"-->
<!--              label="Import"-->
<!--              choose-label="Import"-->
<!--              class="mr-2 inline-block"-->
<!--            />-->
            <Button :label='$t("export")' icon="pi pi-upload" class="export" @click="exportCSV($event)"/>
          </template>
        </Toolbar>

        <Toast/>


      <div style="" class="shadow-xl ">
        <DataTable
          ref="dt"
          v-model:selection="selectedProducts"
          :value="users"
          :loading="loading"
          data-key="id"
          :paginator="true"
          :rows="10"
          :filters="filters"
          paginator-template="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
          :rows-per-page-options="[5, 10, 25]"
          responsive-layout="scroll"
        >
          <template #header>
            <div class="flex w-full  justify-between align-items-center">
              <h5 class="m-0 my-auto">{{ $t("parents") }}</h5>
             <div>
              <span class="block mt-2 md:mt-0 p-input-icon-left">
                <i class="pi pi-search"/>
                <InputText v-model="filters['global'].value" :placeholder='$t("search")'/>
              </span>
              </div>
            </div>
          </template>

          <Column selection-mode="multiple" header-style="width: 3rem"></Column>
         

        
         
           <Column field="phone" :header='$t("index")' :sortable="true" header-style="width:14%; min-width:10rem;" class="ltr:text-justify">
            <template #body="slotProps">
              {{ slotProps.data.id }}
            </template>
           </Column>

           <Column field="phone" :header='$t("parent.fname")' :sortable="true" header-style="width:14%; min-width:10rem;" class="ltr:text-justify">
            <template #body="slotProps">
              {{ slotProps.data.fname }}
            </template>
           </Column>
           <Column field="phone" :header='$t("parent.lname")' :sortable="true" header-style="width:14%; min-width:10rem;" class="ltr:text-justify">
            <template #body="slotProps">
              {{ slotProps.data.lname }}
            </template>
           </Column>
           <Column field="phone" :header='$t("parent.email")' :sortable="true" header-style="width:14%; min-width:10rem;" class="ltr:text-justify">
            <template #body="slotProps">
              {{ slotProps.data.email }}
            </template>
           </Column>
           <Column field="phone" :header='$t("parent.phone")' :sortable="true" header-style="width:14%; min-width:10rem;" class="ltr:text-justify">
            <template #body="slotProps">
              {{ slotProps.data.phone }}
            </template>
           </Column>


        
          <Column header-style="min-width:10rem;">
            <template #body="slotProps">
              <div >
               
                <Button
                icon="pi pi-trash"
                class="delete mt-2"
                @click="confirmDelete(slotProps.data.id)"
              />
              </div>
            </template>
          </Column>



        </DataTable>
        <Dialog v-model:visible="deleteDialog" :style="{ width: '450px' }" :header='$t("submit")' :modal="true">
          <div class="flex align-items-center justify-content-center">
            <i class="pi pi-exclamation-triangle mr-3" style="font-size: 2rem"/>
            <span v-if="user"
            >{{ $t('remove_item') }} <b>{{ user.first_name }}</b
            >?</span
            >
          </div>
          <template #footer>
            <Button  :label='$t("no")' icon="pi pi-times" class=" p-button-text" @click="deleteDialog = false"/>
            <Button  :label='$t("yes")' icon="pi pi-check" class="p-button-text" @click="deleteAction"/>
          </template>
        </Dialog>
      </div>
      </va-card>
    </div>
  </div>
</template>

<style scoped lang="scss"></style>