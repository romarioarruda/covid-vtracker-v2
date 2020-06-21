<template>
  <div class="area-graficos row justify-center">
    <div class="col-md-12 col-xs-12 q-mt-md" id="tituloSecaoObitos">
      <div class="row justify-start" :class="this.$q.screen.xs ? 'text-h5': 'text-h4'">Óbitos confirmados</div>
    </div>
    <div id="graficoNovosCasos" class="shadow-6 col-md-12 col-xs-12 q-mt-md">
      <FiltroData @filterDate="filterDate" class="row justify-end" />
      <q-card class="my-card">
        <q-card-section class="row justify-center">
          <q-skeleton v-if="!obitos.length"  style="width: 50%" animation="pulse" />
          <highcharts
            v-else
            :options="this.graficoObitos('novos', 'Óbitos de COVID-19 por data de notificação')">
          </highcharts>
        </q-card-section>
      </q-card>
    </div>
  </div>
</template>
<script>
import { Chart } from 'highcharts-vue'
import moment from 'moment'
import FiltroData from './FiltroData'

export default {
  name: 'GraficoObitos',
  components: {
    highcharts: Chart,
    FiltroData
  },

  props: {
    obitos: {
      type: Array,
      required: true
    }
  },

  methods: {
    filterDate (date) {
      this.$emit('filterDateObitos', { date: date.date })
    },

    graficoObitos (tipo, titulo) {
      /* eslint-disable */
      let dados = {
        'data' : []
      }

      this.obitos.forEach((item, index) => {
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
            text: 'Fonte: Secretarias Estaduais de Saúde'
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
              text: 'Óbitos por dia'
            }
          },
          legend: {
            enabled: false
          },
          tooltip: {
            pointFormat: 'Óbitos: <b>{point.y:1f}</b>'
          },
          series: [
            {
              name: 'Óbitos',
              color: '#f4433666',
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
  #tituloSecaoObitos {
    border-left: 5px solid #f4433666;
    border-radius: 2px;
    color:#1e2023;
  }
</style>
