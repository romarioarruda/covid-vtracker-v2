<template>
  <div class="area-graficos row justify-center q-mt-xl">
    <div class="col-md-10 col-xs-12 q-mt-md" id="tituloSecao">
      <div class="text-h4 row justify-start">Casos confirmados</div>
    </div>
    <div id="graficoNovosCasos" class="shadow-6 col-md-10 col-xs-12 q-mt-md">
      <q-card class="my-card">
        <q-card-section class="row justify-center">
          <highcharts
          :options="this.graficoCasosConfirmados('novos', 'Casos de COVID-19 por data de notificação')">
          </highcharts>
        </q-card-section>
      </q-card>
    </div>

    <div id="casosRecuperados" class="shadow-6 col-md-10 col-xs-12 q-mt-xl">
      <q-card class="shadow-6">
        <q-card-section class="row justify-center">
          <highcharts
          :options="this.graficoCasosConfirmados('recuperados', 'Casos de recuperação por data de notificação')">
          </highcharts>
        </q-card-section>
      </q-card>
    </div>
    <div id="casosAcompanhados" class="shadow-6 col-md-10 col-xs-12 q-mt-xl">
      <q-card class="shadow-6">
        <q-card-section class="row justify-center">
          <highcharts
          :options="this.graficoCasosConfirmados('acompanhamento', 'Casos em acompanhamento por data de notificação')">
          </highcharts>
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

  data () {
    return {
      link: '<a href="https://covid.saude.gov.br/">Ministério da Saúde</a>'
    }
  },

  methods: {
    graficoCasosConfirmados (tipo, titulo) {
      /* eslint-disable */
      let dados = {
        'data' : []
      }

      this.casos.forEach((item, index) => {
          dados.data.push({
            'date': moment(item.last_updated).format('DD/MM/YYYY'),
            'new': parseInt(item[tipo])
          })
      })

      return {
          chart: {
            type: 'column'
          },
          title: {
            text: titulo
          },
          subtitle: {
            text: `Fonte: ${this.link}`
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
                format: '{point.y:1f}',
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
<style>
  #tituloSecao {
    border-left: 5px solid #1976D2;
    border-radius: 6px;
    color:#1e2023;
  }
</style>
