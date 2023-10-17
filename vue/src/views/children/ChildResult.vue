<script>
import axios from 'axios'
import Chart from 'chart.js/auto';
import moment from "moment";
import Button from 'primevue/button';
import Dialog from 'primevue/dialog';
import Calendar from 'primevue/calendar';

export default {
  data() {
    return {
      search: '',
      headers: [],
      result: [],
      alert_text: null,
      ctx: null,
      created_at: [],
      latePercenteges: [],
      growAge: [],
      diffAge: [],
      date1: '',
      date2: '',
      myCahrt: '',
      selectX: null,
      selectY: null,
      visible: false,
      examDate: '',
      NameRules: [
        value => {
          if (value) return true
          return "This field is required"
        },
      ],
      examId: '',
      loading: true,
      side_profileName:''
    }
  },
  methods: {
    getResults() {
      axios.post(`/api/evaluations/${this.$route.params.child_id}/${this.$route.params.sideProfile_id}/${this.$route.params.evaluation_id}/result`, {
        'date1': this.date1,
        'date2': this.date2
      }).then(res => {
        this.result = res.data.resultEvaluation
        this.loading = false
        console.log(this.result)
        this.created_at = []
        this.latePercenteges = []
        this.growAge = []
        this.diffAge = []
        this.result.forEach((elem) => {
          this.created_at.push(moment(elem.result_created_at).format("MM-DD-YYYY"))
          this.latePercenteges.push(elem.late_percentage)
          this.growAge.push(elem.grow_age)
          this.diffAge.push(elem.diff_age)
        })
        console.log(this.latePercenteges)
        this.ctx = document.getElementById('myChart').getContext("2d")
        this.myCahrt = new Chart(this.ctx, {
          type: 'bar',
          data: {
            datasets: [{
              label: 'late percentages ',
              data: this.latePercenteges,
              borderWidth: 1,
              backgroundColor: '#A9AB7F',
              barPercentage: 0.5,
              categoryPercentage: 0.2,
            },
              {
                label:'Different_ages',
                data: this.diffAge,
                borderWidth: 1,
                backgroundColor: '#4c9499',
                barPercentage: 0.5,
                categoryPercentage: 0.2
              },
              {
                label: 'grow Age  ',
                data: this.growAge,
                borderWidth: 1,
                backgroundColor: '#135C65',
                barPercentage: 0.5,
                categoryPercentage: 0.2
              },
            ]
          },
          options: {
            align: 'start',
            scales: {
              y: {
                beginAtZero: true,
              },
              x: {
                grid: {
                  drawOnChartArea: false
                },
                type: 'category',
                labels: this.created_at,
              }
            },
            grid: {
              top: '6',
              right: '0',
              bottom: '17',
              left: '25',
            },
            animation: {
              duration: 2000,
            },
          }
        });
        console.log(this.latePercenteges)
      })
    },
    formateDate(date) {
      return moment(date).format('DD-MM-YYYY HH:mm')
    },
    print() {
      //     document.getElementById('print').style.display="block";
      // setTimeout(()=>{
      //   document.getElementById('print').style.display="none";
      // }, 1000)
      this.$router.push({name: 'printChildResult',
        params: {
          child_id: this.$route.params.child_id,
          sideProfile_id: this.$route.params.sideProfile_id,
          evaluation_id: this.$route.params.evaluation_id
        }
      })
      // window.open(route.href,"_blank")
    },
    getSideprofile(){
      axios.get(`api/side-profiles/${this.$route.params.sideProfile_id}`).then(res => {
        this.side_profileName = res.data.sideProfile.title
        // this.loading = false;
        console.log(res.data.sideProfile)
      })
    },
    filter() {
      axios.post(`/api/evaluations/${this.$route.params.child_id}/${this.$route.params.sideProfile_id}/${this.$route.params.evaluation_id}/result`, {
        'date1': this.date1,
        'date2': this.date2
      }).then(res => {
        this.result = res.data.resultEvaluation
        console.log(this.result)
        this.created_at = []
        this.latePercenteges = []
        this.growAge = []
        this.diffAge = []
        this.result.forEach((elem) => {
          this.created_at.push(moment(elem.result_created_at).format("DD-MM-YYYY"))
          this.latePercenteges.push(elem.late_percentage)
          this.growAge.push(elem.grow_age)
          this.diffAge.push(elem.diff_age)
        })
        console.log(this.latePercenteges)
        this.ctx = document.getElementById('myChart')
        this.myCahrt.destroy()
        this.myCahrt = new Chart(this.ctx, {
          type: 'bar',
          data: {
            datasets: [{
              label: 'late percentages ',
              data: this.latePercenteges,
              borderWidth: 1,
              backgroundColor: '#A9AB7F',
              barPercentage: 0.5,
              categoryPercentage: 0.2,
            },
              {
                label: 'Different ages ',
                data: this.diffAge,
                borderWidth: 1,
                backgroundColor: '#4c9499',
                barPercentage: 0.5,
                categoryPercentage: 0.2
              },
              {
                label: 'grow Age  ',
                data: this.growAge,
                borderWidth: 1,
                backgroundColor: '#135C65',
                barPercentage: 0.5,
                categoryPercentage: 0.2
              },
            ]
          },
          options: {
            align: 'start',
            scales: {
              y: {
                beginAtZero: true,
              },
              x: {
                grid: {
                  drawOnChartArea: false
                },
                type: 'category',
                labels: this.created_at,
              }
            },
            grid: {
              top: '6',
              right: '0',
              bottom: '17',
              left: '25',
            },
            animation: {
              duration: 2000,
            },
          }
        });
        console.log(this.latePercenteges)
      })
    },
    editChart() {
      let arr = [
        {title: this.$t('grow_age'), value: this.growAge},
        {title: this.$t('diff_age'), value: this.diffAge},
        {title: this.$t('late_percentage'), value: this.latePercenteges}
      ]
      this.myCahrt.destroy()
      this.myCahrt = new Chart(this.ctx, {
        type: 'bar',
        data: {
          datasets: [{
            label: arr[this.selectY].title,
            data: arr[this.selectY].value,
            borderWidth: 1,
            backgroundColor: '#135C65',
            barPercentage: 0.5,
            categoryPercentage: 0.2,
          },
          ]
        },
        options: {
          align: 'start',
          scales: {
            y: {
              beginAtZero: true,
            },
            x: {
              grid: {
                drawOnChartArea: false
              },
              type: 'category',
              labels: arr[this.selectX].value,
            }
          },
          grid: {
            top: '6',
            right: '0',
            bottom: '17',
            left: '25',
          },
          animation: {
            duration: 2000,
          },
        }
      });
    },
    editItem(date, evaluation_result_id) {
      this.visible = true;
      this.examDate = date
      this.examId = evaluation_result_id
    },
    async submit(evaluationResult_id) {
      console.log(evaluationResult_id)
      const {valid} = await this.$refs.form.validate()
      if (!valid)
        return
      axios.post(`/api/evaluations/${this.examId}`, {date: this.examDate}).then(res => {
        this.alert_text = "evaluation edited successfully  "
        this.visible = false
        this.type = "success"
        this.getResults()
      }).catch((error) => {
        this.alert_text = error.response.data.message
        this.type = "error"
        this.visible = false
      })
    },
    goBack() {
      this.$router.go(-1)
    },
  },
  components: {
    Dialog,
    Button,

  },
  components: {
    Dialog,
    Button,
    Calendar
  },
  mounted() {
    this.getResults()
    this.getSideprofile()
  },
  computed: {
    locale() {
      return this.$i18n.locale;
    },
    header() {
      return this.headers = [
        {title: 'id'},
        {key: 'therapist_name', title: this.$t('therapist_name')},
        {key: 'child_age', title: this.$t('child_age')},
        {key: 'grow_age', title: this.$t('grow_age')},
        {key: 'diff_age', title: this.$t('diff_age')},
        {key: 'basal_age', title: this.$t('basal_age')},
        {key: 'late_percentage', title: this.$t('late_percentage')},
        {key: 'result_created_at', title: this.$t('created_at')},
        {title: this.$t('operation')}
      ];
    },
    firstSelectBoxComputed() {
      let title = [
        {title: this.$t('grow_age'), value: 0},
        {title: this.$t('diff_age'), value: 1},
        {title: this.$t('late_percentage'), value: 2},
      ]
      let result = title.filter((elem) => {
        return elem.value != this.selectY
      })
      return result;
    },
    secondSelectBoxComputed() {
      let title = [
        {title: this.$t('grow_age', this.locale), value: 0},
        {title: this.$t('diff_age'), value: 1},
        {title: this.$t('late_percentage'), value: 2},
      ]
      let result = title.filter((elem) => {
        return elem.value != this.selectX
      })
      return result;
    },
  }, watch: {
    selectX(value) {
      if (this.selectX != null && this.selectY != null) {
        this.editChart()
      }
    },
    selectY(value) {
      if (this.selectX != null && this.selectY != null) {
        this.editChart()
      }
    }
  }
}
</script>
<template>
  <div>
    <div class="my-5" v-if="result[0] && side_profileName && locale == 'en'">
      {{result[0].child_name}}/{{side_profileName}}/{{result[0].evaluation_title}}
    </div>
    <div class="my-5" v-if="result[0] && side_profileName && locale == 'ar'">
      {{result[0].evaluation_title}} \{{side_profileName}}\{{result[0].child_name}}
    </div>
    <div>
      <v-btn height="45" class="mb-5 text-white" color="#135C65" @click="goBack">
        <v-icon
            start
            icon="mdi-arrow-left"
        ></v-icon>
        {{ $t('back') }}
      </v-btn>
      <v-alert
          type="success"
          variant="tonal"
          border="start"
          elevation="2"
          closable
          :close-label="$t('close')"
          :text="alert_text"
          v-if="alert_text!= null "
          class="mb-8"
      >
      </v-alert>
      <!--  <div class="v-row mb-5 mt-5  ">-->
      <!--    <v-text-field-->
      <!--        class="v-col-6"-->
      <!--        v-model="date1"-->
      <!--        :label="$t('start_date')"-->
      <!--        type="date"-->
      <!--        @change="filter"-->
      <!--    ></v-text-field>-->
      <!--    <v-text-field-->
      <!--        class="v-col-6"-->
      <!--        v-model="date2"-->
      <!--        :label="$t('end_date')"-->
      <!--        type="date"-->
      <!--        @change="filter"-->
      <!--    ></v-text-field>-->
      <!--  </div>-->
      <div class="v-row mb-5 mt-5  ">
        <v-select
            class="mx-9"
            :label="$t('xAxis')"
            v-model="selectX"
            :items="firstSelectBoxComputed"
        ></v-select>
        <v-select
            class="mx-9"
            :label="$t('yAxis')"
            v-model="selectY"
            :items="secondSelectBoxComputed"
        ></v-select>
      </div>
      <canvas id="myChart" style="max-height:400px; !important;"></canvas>
      <v-card>
        <v-card-title>
          Results
          <v-spacer></v-spacer>
          <v-text-field
              v-model="search"
              append-icon="mdi-magnify"
              label="Search"
              single-line
              hide-details
          ></v-text-field>
        </v-card-title>
  
        <v-btn style="color: rgb(255, 255, 255);" text="print" color="#ACAE84" height="45" class="mb-5 mt-5" @click="print">
          {{$t('print')}}
        </v-btn>
        <v-data-table
            :headers="header"
            :items="result"
            :search="search"
        >
          <template #top>
            <v-progress-linear v-if="loading" slot="progress" style="color:#135c65" indeterminate></v-progress-linear>
          </template>
          <template #item="{ item ,index}">
            <tr>
              <td>{{ index + 1 }}</td>
              <td>{{ item.columns.therapist_name }}</td>
              <td>{{ item.columns.child_age }} months</td>
              <td>{{ item.columns.grow_age }}</td>
              <td>{{ item.columns.diff_age }}</td>
              <td>{{ item.columns.basal_age }} months</td>
              <td>{{ Math.round(item.columns.late_percentage) }} %</td>
              <td>{{ formateDate(item.columns.result_created_at) }}</td>
              <!--          <td>{{ moment(item.raw.result_created_at).format('DD-MM-YYYY') }}</td>-->
              <!--          <td>-->
              <td class="text-center">
                <v-icon small color="primary" class="mr-2" @click="editItem(item.raw.result_created_at,item.raw.id)">
                  mdi-pencil
                </v-icon>
                <Dialog v-model:visible="visible" modal header=" " :style="{ width: '50vw' }">
                  <v-form fast-fail @submit.prevent ref="form">
                    <!-- <v-text-field
                        v-model="examDate"
                        :rules="NameRules"
                        :label="$t('examDate')"
                        type="datetime-local"
  
                    ></v-text-field> -->
                    <div class="card flex justify-content-center">
                      <Calendar style="width: 100%; margin: 10px;"  v-model="examDate"  :rules="NameRules" placeholder="dd/mm/yy" dateFormat="dd/mm/yy" />
                  </div>
                    <button class="bg-blue pa-3 rounded" @click="submit">{{ $t('submit') }}</button>
                  </v-form>
                </Dialog>
              </td>
            </tr>
          </template>
        </v-data-table>
      </v-card>
      <v-data-table
          class="hidden-table"
          :headers="header"
          :items="result"
          :search="search"
          id="print"
          hide-default-footer
          disable-pagination
      >
        <template #top>
          <v-progress-linear v-if="loading" slot="progress" style="color:#135c65" indeterminate></v-progress-linear>
        </template>
        <template #item="{ item ,index}">
          <tr>
            <td>{{ index + 1 }}</td>
            <td>{{ item.columns.therapist_name }}</td>
            <td>{{ item.columns.grow_age }}</td>
            <td>{{ item.columns.diff_age }}</td>
            <td>{{ Math.round(item.columns.late_percentage) }} %</td>
            <td>{{ item.columns.basal_age }} months</td>
            <td>{{ item.columns.child_age }} months</td>
            <td>{{ formateDate(item.columns.result_created_at) }}</td>
            <!--          <td>{{ moment(item.raw.result_created_at).format('DD-MM-YYYY') }}</td>-->
            <!--          <td>-->
            <td class="text-center">
              <v-icon small color="primary" class="mr-2" @click="editItem(item.raw.result_created_at,item.raw.id)">
                mdi-pencil
              </v-icon>
              <Dialog :visible="visible" modal header=" " :style="{ width: '50vw' }">
                <v-form fast-fail @submit.prevent ref="form">
                  <v-text-field
                      v-model="examDate"
                      :rules="NameRules"
                      :label="$t('examDate')"
                      type="datetime-local"
                  ></v-text-field>
                  <button class="bg-blue pa-3 rounded" @click="submit">{{ $t('submit') }}</button>
                </v-form>
              </Dialog>
            </td>
          </tr>
        </template>
        <template #bottom>
        </template>
      </v-data-table>
    </div>
  </div>
</template>
<style scoped>
.hidden-table {
  border: 1px solid black;
  display: none;
  margin-top: 200px
}
.hidden-table th {
  border: 1px solid black;
}
.hidden-table td {
  border: 1px solid black;
}
</style>