<template>
  <q-page padding class="row justify-center">
    <div class="col-md-10 col-xs-12">
        <div class="text-h4 q-mb-xl q-mt-md">{{titulo}}</div>
        <template>
            <div class="justify-between row justify-wrap">
                <q-chip square>
                    <q-avatar color="red" text-color="white" class="largura-80">{{totalConfirmadoBR | formatNumber}}</q-avatar>
                    casos no Brasil
                </q-chip>
                <!-- <q-chip square>
                    <q-avatar color="blue" text-color="white" class="largura-80">0</q-avatar>
                    curados
                </q-chip> -->
                <q-chip square>
                    <q-avatar color="red" text-color="white" class="largura-80">{{totalMortesPais | formatNumber}}</q-avatar>
                    mortes no país
                </q-chip>
            </div>
            <hr/>
            <q-table
                title="Brasil"
                :columns="columnsBR"
                :data="dadosCovidBR"
                :filter="filterBR"
                row-key="name"
                color="red-6"
            >
                <template v-slot:top-left v-if="dadosCovidBR.length">
                    <q-btn
                      color="primary"
                      icon-right="archive"
                      label="Arquivo CSV"
                      no-caps
                      @click="exportTable"
                    />
                </template>
                <template v-slot:top-right>
                    <q-input outlined dense v-model="filterBR"
                        placeholder="Filtrar por Estado">
                        <template v-slot:append>
                            <q-icon name="search"></q-icon>
                        </template>
                    </q-input>
                </template>
            </q-table>
        </template>
    </div>
  </q-page>
</template>

<script>
import axios from 'axios'
import moment from 'moment'
import { exportFile } from 'quasar'

export default {
  name: 'PageIndex',
  data () {
    return {
      titulo: 'Covid-19 no Brasil',
      filterBR: '',
      columnsBR: [
        {
          name: 'uf',
          sortable: true,
          label: 'Estado',
          align: 'left',
          field: 'uf',
          format: val => `${val}`
        },
        { name: 'obitos_acumulado', align: 'center', label: 'Total de mortes', field: 'obitos_acumulado', sortable: true },
        { name: 'casos_acumulado', label: 'Total de casos', field: 'casos_acumulado', sortable: true },
        { name: 'last_updated', label: 'Última atualização', field: 'last_updated', sortable: true }
      ],
      dadosCovidBR: [],
      totalConfirmadoBR: 0,
      totalRecuperados: 0,
      totalEstadosAfetados: 0,
      totalMortesPais: 0,
      ultimasNoticias: []
    }
  },

  mounted () {
    this.getdadosCovidBR()
  },

  methods: {
    getdadosCovidBR () {
      moment.locale('pt-br')
      axios.get('http://localhost:8081/dados-covid-br')
        .then((res) => {
          this.dadosCovidBR = res.data.dados.map((item) => {
            const dados = []
            dados.uf = item.uf
            dados.obitos_acumulado = this.formatValue(parseInt(item.obitos_acumulado)) || 0
            dados.casos_acumulado = this.formatValue(parseInt(item.casos_acumulado)) || 0
            dados.last_updated = moment(item.last_updated).format('LLL')
            this.totalConfirmadoBR += parseInt(item.casos_acumulado)
            this.totalMortesPais += parseInt(item.obitos_acumulado)
            return dados
          })
        })
    },

    formatValue (value) {
      if (value !== null) {
        const val = value.toFixed(0).replace('.', ',')
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')
      }
    },

    exportTable () {
      const content = [this.columnsBR.map(col => this.wrapCsvValue(col.label))].concat(
        this.dadosCovidBR.map(row => this.columnsBR.map(col => this.wrapCsvValue(
          typeof col.field === 'function'
            ? col.field(row)
            : row[col.field === undefined ? col.name : col.field],
          col.format
        )).join(','))
      ).join('\r\n')

      const status = exportFile(
        'dados-covid.csv',
        content,
        'text/csv'
      )

      if (status !== true) {
        this.$q.notify({
          message: 'O browser impediu o download...',
          color: 'negative',
          icon: 'warning'
        })
      }
    },

    wrapCsvValue (val, formatFn) {
      let formatted = formatFn !== undefined
        ? formatFn(val)
        : val

      formatted = formatted === undefined || formatted === null
        ? ''
        : String(formatted)

      formatted = formatted.split('"').join('""')

      return `"${formatted}"`
    }
  },

  filters: {
    formatNumber (value) {
      if (value !== null) {
        const val = (value).toFixed(0).replace('.', ',')
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')
      }
    }
  }
}
</script>
<style>
  .largura-80 {
    width: 80px;
  }

  .largura-50 {
      width: 50px;
  }
</style>
