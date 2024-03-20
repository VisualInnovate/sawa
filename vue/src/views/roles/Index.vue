<script setup>
import {FilterMatchMode} from 'primevue/api'
import {ref, onMounted, onBeforeMount} from 'vue'
// import ProductService from '@/service/ProductService';
import {useToast} from 'primevue/usetoast'
import axios from "axios";
import {useRouter} from "vue-router";
const toast = useToast()
const router = useRouter()
const permissions=ref({})
const loading = ref(true)
const user = ref({})
const error = ref('')
const users = ref(null)
const productDialog = ref(false)
const deleteDialog = ref(false)
const confir_id=ref('')
const selectedProducts = ref(null)
const dt = ref(null)
const filters = ref({})
const createdialog=ref(false)
const role=ref({
  name:'',
  permissions:[]
})
const updatedialog=ref(false)

onBeforeMount(() => {
  initFilters()
})

 const fetchData= ()=>{


  axios.post("/api/roles").then((res)=>{
    
    users.value= res.data.roles.data
    console.log(users.value)

  });
  axios.post("/api/permissions").then((res)=>{
    
    permissions.value= res.data.permissions
    loading.value= false

  });

}



onMounted(() => {
  // productService.getProducts().then((data) => (products.value = data));
fetchData()

})
const edit=(id)=>{
    axios.get(`/api/roles/${id}`).then((res)=>{
    loading.value= false
    role.value.name= res.data.role.name
    for (let i = 0; i < res.data.role.permissions.length; i++) {
      res.data.role.permissions[i].id
      role.value.permissions.push(res.data.role.permissions[i].id)
}
   

  });
  console.log(role.value.permissions)
    confir_id.value=id
    updatedialog.value=!(updatedialog.value)
}


///// update

const editeroles=()=>{
    axios
    .put(`/api/roles/${confir_id.value}/edit`,role.value)
    .then((res) => {
      console.log(res.data)
      fetchData()
      updatedialog.value=!(updatedialog.value)
      toast.add({severity: 'success', summary: 'Successful', detail: 'Successful', life: 3000})
      skill.value = ref({})
    })
    .catch((el)=>{
      error.value = el.response.data.errors
    })
}

const openNew = () => {
    createdialog.value=!(createdialog.value)
}

const confirmDelete = (id) => {
  console.log(id)
  deleteDialog.value = true
  confir_id.value=id
 

}

const createrole=()=>{
    axios
    .post('/api/roles/create',role.value)
    .then((res) => {
      console.log(res.data)
      fetchData()
      createdialog.value=!(createdialog.value)
      toast.add({severity: 'success', summary: 'Successful', detail: ' Successful', life: 3000})
      skill.value = ref({})
    })
    .catch((el)=>{
      error.value = el.response.data.errors
    })
}

const deleteAction = () => {
  axios
    .delete(`/api/roles/${confir_id.value}/delete`)
    .then((res) => {
      console.log(res.data)
      fetchData()
      deleteDialog.value=false
      toast.add({severity: 'success', summary: 'Successful', detail: 'Successful', life: 3000})
    })
    .catch(() => {})

}


const exportCSV = () => {
  dt.value.exportCSV()
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
            <Button :label='$t("roles")' icon="pi pi-plus" class="p-button-success mr-2" @click="openNew"></Button>
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
          current-page-report-template="Showing {first} to {last} of {totalRecords} products"
          responsive-layout="scroll"
        >
          <template #header>
            <div class="flex w-full  justify-between align-items-center">
              <h5 class="m-0 my-auto">{{ $t("roles") }}</h5>
             <div>
              <span class="block mt-2 md:mt-0 p-input-icon-left">
                <i class="pi pi-search"/>
                <InputText v-model="filters['global'].value" :placeholder='$t("search")'/>
              </span>
              </div>
            </div>
          </template>

          <Column selection-mode="multiple" header-style="width: 3rem"></Column>

          
          <Column field="index" :header='$t("index")' :sortable="true" header-style="width:14%; min-width:10rem;" class="ltr:text-justify">
            <template #body="slotProps">
              {{ slotProps.data.id }}
            </template>
           </Column> 

           <Column field="name" :header='$t("name")' :sortable="true" header-style="width:14%; min-width:10rem;" class="ltr:text-justify">
            <template #body="slotProps">
              {{ slotProps.data.name }}
            </template>
           </Column>

      
          


        
          <Column header-style="min-width:10rem;">
            <template #body="slotProps">
              <div >
                <Button
                icon="pi pi-pencil"
                class="p-button-rounded p-button-success mr-2"
                @click="edit(slotProps.data.id)"
              />
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
        <Dialog v-model:visible="createdialog" :style="{ width: '550px' }" :header='$t("roles")' :modal="true">
          <div class="flex flex-column gap-2 py-1">
                  <label class="w-full text-right" for="username">{{ $t('name') }}</label>
                <InputText required class="bg-[#f7f5f5] text-center"  v-model="role.name" :placeholder='$t("name")' />
                <div class="mt-1 mb-5 text-red-500" v-if="error?.name">{{ error.name[0] }}</div>
            </div>
            <div class="flex flex-column gap-2 py-1">
                  <label class="w-full text-right" for="username">{{ $t('permissions') }}</label>
                  <MultiSelect v-model="role.permissions" filter option-value="id" :options="permissions" optionLabel="name" :placeholder='$t("permissions")'
              class="w-full md:w-20rem" />
                <div class="mt-1 mb-5 text-red-500" v-if="error?.name">{{ error.name[0] }}</div>
            </div>
           <div class="w-full text-center">
            <Button @click="createrole" class="create m-auto w-[50%] my-4" :label='$t("submit")'></Button> 
           </div>
        </Dialog>
        <Dialog v-model:visible="updatedialog" :style="{ width: '550px' }" :header='$t("roles")' :modal="true">
          <div class="flex flex-column gap-2">
                  <label class="w-full text-right" for="username">{{ $t('name') }}</label>
                <InputText required class="bg-[#f7f5f5] text-center"  v-model="role.name" :placeholder='$t("name")' />
                <div class="mt-1 mb-5 text-red-500" v-if="error?.name">{{ error.name[0] }}</div>
            </div>
            <div class="flex flex-column gap-2">
                  <label class="w-full text-right" for="username">{{ $t('permissions') }}</label>
                  <MultiSelect v-model="role.permissions" filter option-value="id" :options="permissions" optionLabel="name" :placeholder='$t("permissions")'
              class="w-full md:w-20rem" />
                <div class="mt-1 mb-5 text-red-500" v-if="error?.permissions">{{ error.permissions[0] }}</div>
            </div>
           <div class="w-full text-center">
            <Button @click="editeroles" class="create m-auto w-[50%] my-4" :label='$t("submit")'></Button> 
           </div>
        </Dialog>
      </div>
      </va-card>
    </div>
  </div>
</template>

<style scoped lang="scss"></style>