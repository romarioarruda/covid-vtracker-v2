<template>
  <div class="area-graficos row justify-center">
    <div id="graficoNovosCasos" class="shadow-6 col-md-10 col-xs-12 q-mt-xl">
      <q-card class="my-card">
        <q-card-section class="row justify-center">
          <highcharts :options="graficoNovosCasos"></highcharts>
        </q-card-section>
      </q-card>
    </div>

    <div id="casosRecuperados" class="shadow-6 col-md-10 col-xs-12 q-mt-xl">
      <q-card class="shadow-6">
        <q-card-section class="row justify-center">
          <highcharts :options="graficoCasosRecuperado"></highcharts>
        </q-card-section>
      </q-card>
    </div>
  </div>
</template>
<script>
import { Chart } from 'highcharts-vue'
import moment from 'moment'

export default {
  name: 'GraficoCasosConfirmados',
  components: {
    highcharts: Chart
  },

  props: {
    casos: {
      type: Array,
      required: true
    }
  },

  computed: {
    graficoNovosCasos () {
      /* eslint-disable */
      let dados = {
        'data' : []
      }
      this.casos.forEach((item, index) => {
          dados.data.push({
            'date': moment(item.last_updated).format('DD/MM/YYYY'),
            'new': parseInt(item.novos)
          })
      })

      return {
          chart: {
            type: 'column'
          },
          title: {
            text: 'Casos de COVID-19 por data de notíficação'
          },
          subtitle: {
            text: 'Fonte: <a href="https://covid.saude.gov.br/" target="_blank" rel="noopener noreferrer">Ministério da Saúde</a>'
          },
          xAxis: {
            type: 'category',
            labels: {
              rotation: -10,
              align: 'center',
              style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
              }
            }
          },
          yAxis: {
            min: 0,
            title: {
              text: 'Casos acumulados'
            }
          },
          legend: {
            enabled: false
          },
          tooltip: {
            pointFormat: 'Casos: <b>{point.y:1f}</b>'
          },
          series: [
            {
              name: 'Casos',
              data: dados.data.map((item) => [ item.date, item.new ]),
              dataLabels: {
                enabled: true,
                rotation: -50,
                color: '#FFFFFF',
                align: 'center',
                format: '{point.y:1f}', // one decimal
                y: 60, // 10 pixels down from the top
                style: {
                  fontSize: '13px',
                  fontFamily: 'Verdana, sans-serif'
                }
              }
            }
          ]
        }
    },

    graficoCasosRecuperado () {
      /* eslint-disable */
      let dados = {
        'data' : []
      }
      this.casos.forEach((item, index) => {
          dados.data.push({
            'date': moment(item.last_updated).format('DD/MM/YYYY'),
            'new': parseInt(item.recuperados)
          })
      })

      return {
          chart: {
            type: 'column'
          },
          title: {
            text: 'Casos de recuperação por data de notíficação'
          },
          subtitle: {
            text: 'Fonte: <a href="https://covid.saude.gov.br/" target="_blank" rel="noopener noreferrer">Ministério da Saúde</a>'
          },
          xAxis: {
            type: 'category',
            labels: {
              rotation: -10,
              align: 'center',
              style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
              }
            }
          },
          yAxis: {
            min: 0,
            title: {
              text: 'Casos recuperados'
            }
          },
          legend: {
            enabled: false
          },
          tooltip: {
            pointFormat: 'Casos: <b>{point.y:1f}</b>'
          },
          series: [
            {
              name: 'Casos Recuperados',
              data: dados.data.map((item) => [ item.date, item.new ]),
              dataLabels: {
                enabled: true,
                rotation: -50,
                color: '#FFFFFF',
                align: 'center',
                format: '{point.y:1f}', // one decimal
                y: 60, // 10 pixels down from the top
                style: {
                  fontSize: '13px',
                  fontFamily: 'Verdana, sans-serif'
                }
              }
            }
          ]
        }
    }
  }
}
</script>
