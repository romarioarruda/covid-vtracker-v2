<template>
  <q-page padding class="row justify-center" id="scrollTargetRef">
    <div class="col-md-10 col-xs-12">
        <div class="q-mb-xl q-mt-md" :class="this.$q.screen.xs ? 'text-h5': 'text-h4'">{{titulo}}</div>
        <template>
            <div class="row justify-between justify-wrap">
                <q-chip style="height: none;" square :class="squareSM">
                    <q-avatar color="red" text-color="white" class="largura-80">
                      <q-skeleton v-if="!totalConfirmadoBR" type="QBtn" />
                      <template v-else>
                        {{totalConfirmadoBR | formatNumber}}
                      </template>
                    </q-avatar>
                    casos no país
                </q-chip>
                <q-chip square :class="squareSM">
                    <q-avatar color="blue" text-color="white" class="largura-80">
                      <q-skeleton v-if="!totalRecuperados" type="QBtn" />
                      <template v-else>
                        {{totalRecuperados | formatNumber}}
                      </template>
                    </q-avatar>
                    recuperados
                </q-chip>
                <q-chip square :class="squareSM">
                    <q-avatar color="red" text-color="white" class="largura-80">
                      <q-skeleton v-if="!totalMortesPais" type="QBtn" />
                      <template v-else>
                        {{totalMortesPais | formatNumber}}
                      </template>
                    </q-avatar>
                    mortes
                </q-chip>
            </div>
            <hr/>
            <q-table
                class="shadow-6"
                title="Brasil"
                :columns="columnsBR"
                :data="dadosCovidBR"
                :filter="filterBR"
                row-key="name"
                color="red-6"
            >
                <template v-slot:top-left v-if="dadosCovidBR.length">
                    <q-btn
                      class="q-mb-md"
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
            <div class="text-caption text-weight-light q-mt-xs q-ml-xs">Fonte: Secretarias Estaduais de Saúde</div>
        </template>
    </div>
    <div class="col-md-10 col-xs-12 q-mt-xl">
      <GraficoCasosConfirmados @filterDate="filterDateRecuperados" :casos="casosConfirmados" />
    </div>
    <div class="col-md-10 col-xs-12 q-mt-xl">
      <GraficoObitos @filterDateObitos="filterDateObitos" :obitos="obitosConfirmados" />
    </div>
      <ScrollTopReturn/>
    </q-page>
</template>

<script>
import axios from 'axios'
import moment from 'moment'
import { exportFile } from 'quasar'
import GraficoCasosConfirmados from '../components/GraficoCasosConfirmados'
import GraficoObitos from '../components/GraficoObitos'
import ScrollTopReturn from '../components/ScrollTopReturn'

export default {
  name: 'PageIndex',
  components: { GraficoCasosConfirmados, GraficoObitos, ScrollTopReturn },
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
      casosConfirmados: [],
      totalConfirmadoBR: 0,
      totalRecuperados: 0,
      totalEstadosAfetados: 0,
      totalMortesPais: 0,
      obitosConfirmados: [],
      ultimasNoticias: []
    }
  },

  mounted () {
    this.getdadosCovidBR()
    this.getdadosCovidTotais()
    this.getTotalRecuperados()
    this.getObitos()
  },

  methods: {
    getdadosCovidBR () {
      moment.locale('pt-br')
      axios.get('/covid')
        .then((res) => {
          this.dadosCovidBR = res.data.casos.map((item) => {
            const dados = []
            dados.uf = item.uf
            dados.obitos_acumulado = this.formatValue(parseInt(item.obitos_acumulado)) || 0
            dados.casos_acumulado = this.formatValue(parseInt(item.casos_acumulado)) || 0
            dados.last_updated = moment(item.last_updated).format('LLL')
            return dados
          })
        })
    },

    getdadosCovidTotais () {
      axios.get('/covid/totais')
        .then((res) => {
          this.totalConfirmadoBR = parseInt(res.data.totais.casos_acumulado) || 0
          this.totalMortesPais = parseInt(res.data.totais.obitos_acumulado) || 0
        })
    },

    getTotalRecuperados () {
      axios.get('/covid/recuperados')
        .then((res) => {
          if (res.data.recuperados) {
            res.data.recuperados.map((item) => {
              this.totalRecuperados = parseInt(item.recuperados)
              this.casosConfirmados.push(item)
            })
          }
        })
    },

    getObitos () {
      axios.get('/covid/obitos')
        .then((res) => {
          if (res.data.obitos) {
            this.obitosConfirmados = res.data.obitos.map((item) => {
              return item
            })
          }
        })
    },

    filterDateRecuperados (value) {
      const novaData = moment(value.date).format('YYYY-MM-DD')
      axios.get(`/covid/recuperados?data_ini=${novaData}`)
        .then((res) => {
          if (res.data.recuperados) {
            this.casosConfirmados = []
            res.data.recuperados.map((item) => {
              this.casosConfirmados.push(item)
            })
          }
        })
    },

    filterDateObitos (value) {
      const novaData = moment(value.date).format('YYYY-MM-DD')
      axios.get(`/covid/obitos?data_ini=${novaData}`)
        .then((res) => {
          if (res.data.obitos) {
            this.obitosConfirmados = []
            this.obitosConfirmados = res.data.obitos.map((item) => {
              return item
            })
          }
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
  },

  computed: {
    squareSM () {
      return this.$q.screen.xs ? 'squareTotalWidth' : ''
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

  .squareTotalWidth {
    width: 98.6667%;
  }
</style>
