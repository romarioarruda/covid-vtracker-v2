<template>
  <div class="area-graficos row justify-center">
    <div class="col-md-12 col-xs-12 q-mt-md" id="tituloSecaoCasos">
      <div class="row justify-start" :class="this.$q.screen.xs ? 'text-h5': 'text-h4'">Casos confirmados</div>
    </div>
    <div id="graficoNovosCasos" class="shadow-6 col-md-12 col-xs-12 q-mt-md">
      <q-card class="my-card">
        <q-card-section class="row justify-center">
          <highcharts
          :options="this.graficoCasosConfirmados('novos', 'Casos novos de COVID-19 por data de notificação', 'Casos novos por dia')">
          </highcharts>
        </q-card-section>
      </q-card>
    </div>

    <div id="casosRecuperados" class="shadow-6 col-md-12 col-xs-12 q-mt-xl">
      <q-card class="shadow-6">
        <q-card-section class="row justify-center">
          <highcharts
          :options="this.graficoCasosConfirmados('recuperados', 'Total de casos recuperados', 'Total acumulado por dia')">
          </highcharts>
        </q-card-section>
      </q-card>
    </div>
    <div id="casosAcompanhados" class="shadow-6 col-md-12 col-xs-12 q-mt-xl">
      <q-card class="shadow-6">
        <q-card-section class="row justify-center">
          <highcharts
          :options="this.graficoCasosConfirmados('acompanhamento', 'Casos em acompanhamento', 'Total acumulado por dia')">
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
    graficoCasosConfirmados (tipo, titulo, subtitulo) {
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
                fontSize: '10px',
                fontFamily: 'Verdana, sans-serif'
              }
            }
          },
          yAxis: {
            min: 0,
            title: {
              text: subtitulo
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
                rotation: -20,
                color: '#FFFFFF',
                align: 'center',
                format: '{point.y:1f}',
                y: 60, // 60 pixels down from the top
                style: {
                  fontSize: '10px',
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
  #tituloSecaoCasos {
    border-left: 5px solid #64b5f6;
    border-radius: 2px;
    color:#1e2023;
  }
</style>
