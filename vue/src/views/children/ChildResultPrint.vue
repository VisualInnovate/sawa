<script>
import axios from 'axios'
import Chart from 'chart.js/auto';
import moment from "moment";
import Dialog from 'primevue/dialog';
import Button from 'primevue/button';


export default {

  data() {
    return {
      search: '',
      headers: [],
      result: [],
      print_results: [],
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


    }
  },
  methods: {
    goBack() {
      this.$router.go(-1)
    },
    async print() {
      // await axios.post("/api/child/results",{
      //     sideprofile_id:this.$route.params.sideProfile_id,child_id:this.$route.params.child_id
      //   }).then(res => {
          
      //  this.print_results=res.data.evaluation_results
      //  this.title=res.data.evaluation_results[0].side_profile_title
      //  console.log(res)
      
      // })
      // setTimeout(() => {
      //   window.print();
      // }, 500)
      
      await axios.post(`/api/evaluations/${this.$route.params.child_id}/${this.$route.params.sideProfile_id}/${this.$route.params.evaluation_id}/result`, {}).then(res => {
        console.log(res)
        this.print_results = res.data.resultEvaluation

      })
      setTimeout(() => {
        window.print();
      }, 500)

    },
    getResults() {
      axios.post(`/api/evaluations/${this.$route.params.child_id}/${this.$route.params.sideProfile_id}/${this.$route.params.evaluation_id}/result`, {
        'date1': this.date1,
        'date2': this.date2
      }).then(res => {
        this.result = res.data.resultEvaluation
        this.loading = false
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
    formateDate(date) {
      return moment(date).format('DD-MM-YYYY HH:mm')
    },


  },
  components: {
    Dialog,
    Button
  },

  beforeMount() {
    this.getResults()
    this.print()

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

      ];
    },

  },
  computedResult() {
    return this.result
  }


}
</script>

<template>
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
  <div class="back-back">
    <div class="back">
      <div class="text-center"><img src="../../assets/img/sawa_logo.svg" style="width:130px; "></div>
      <div><p class="w-[100%] text-h4 text-center ma-4">{{ print_results[0]?.evaluation_title }}</p></div>
      <div>
        <p class="w-[100%] text-right ma-4">{{ print_results[0]?.child_name }}</p>
        <p class="w-[100%] text-right ma-4">{{ print_results[0]?.birth_date }}</p>


      </div>
      <canvas id="myChart" style="height: 70vh !important; margin-bottom : 30px"></canvas>

      <v-card>
        <v-data-table
            class="hidden-table"
            :headers="header"
            :items="print_results"
            :search="search"
        >


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
            </tr>

          </template>
          <template #bottom>

          </template>

        </v-data-table>
      </v-card>


    </div>
  </div>


</template>
<style scoped>
.back-back {
  background: #999;
  cursor: default;
}

.back {
  box-sizing: border-box;
  margin: 0 auto;
  overflow: hidden;
  padding: 0.5in;
  width: 8.5in;
}

.back {
  background: #FFF;
  border-radius: 1px;
  box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
}

.hidden-table {
  width: 100%;
  font-size: 12px;
}

.hidden-table {
  border-collapse: separate;
  border-spacing: 2px;
}

th, td {
  border-width: 1px;
  padding: 0.5em;
  position: relative;
  text-align: right;
  border-style: solid;
}

th, td {
  border-radius: 0.25em;
  border-style: solid;
}

th {
  border: 1px solid;
}

td {
  border-color: #DDD;
}


</style>