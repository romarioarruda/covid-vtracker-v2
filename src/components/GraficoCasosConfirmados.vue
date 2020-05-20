<template>
    <div>
      <highchartsTemplate />
    </div>
</template>
<script>
import highcharts from 'highcharts'
import highchartsTemplate from '../components/HighCharts'
export default {
  name: 'GraficoCasosConfirmados',
  components: { highchartsTemplate },
  mounted () {
    this.graficoNovosCasos()
  },

  methods: {
    graficoNovosCasos () {
      highcharts.chart('container-grafico', {
        chart: {
          type: 'column'
        },
        title: {
          text: 'Casos novos de COVID-19 por dia'
        },
        subtitle: {
          text: 'Fonte: <a href="https://covid.saude.gov.br/" target="_blank" rel="noopener noreferrer">Ministério da Saúde</a>'
        },
        xAxis: {
          type: 'category',
          labels: {
            rotation: -45,
            style: {
              fontSize: '13px',
              fontFamily: 'Verdana, sans-serif'
            }
          }
        },
        yAxis: {
          min: 0,
          title: {
            text: 'Casos novos'
          }
        },
        legend: {
          enabled: false
        },
        tooltip: {
          pointFormat: 'Casos: <b>{point.y:1f}</b>'
        },
        series: [{
          name: 'Casos',
          data: [
            ['10/05', 11],
            ['11/05', 11],
            ['12/05', 11],
            ['13/05', 11],
            ['14/05', 100],
            ['15/05', 120],
            ['16/05', 125],
            ['17/05', 130],
            ['18/05', 135],
            ['19/05', 150],
            ['20/05', 200]
          ],
          dataLabels: {
            enabled: true,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            format: '{point.y:1f}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
              fontSize: '13px',
              fontFamily: 'Verdana, sans-serif'
            }
          }
        }]
      })
    }
  }
}
</script>
