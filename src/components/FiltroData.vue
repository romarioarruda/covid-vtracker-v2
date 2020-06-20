<template>
  <div class="q-pa-md">
    <div class="q-mb-sm q-mr-md">
      <q-badge color="blue-6">
        Dados a partir de: {{ dateFormated }}
      </q-badge>
    </div>

    <q-btn icon="event" round color="primary">
      <q-tooltip
        anchor="bottom left"
        transition-show="rotate"
        transition-hide="rotate"
      >
        Filtre dados a partir de uma data específica
      </q-tooltip>
      <q-popup-proxy @before-show="updateProxy" transition-show="scale" transition-hide="scale">
        <q-date v-model="proxyDate">
          <div class="row items-center justify-end q-gutter-sm">
            <q-btn label="Cancelar" color="primary" flat v-close-popup />
            <q-btn label="OK" color="primary" flat @click="save" v-close-popup />
          </div>
        </q-date>
      </q-popup-proxy>
    </q-btn>
  </div>
</template>
<script>
import moment from 'moment'

export default {
  data () {
    return {
      date: moment().format('YYYY/MM/01'),
      proxyDate: moment().format('YYYY/MM/DD')
    }
  },

  methods: {
    updateProxy () {
      this.proxyDate = this.date
    },

    save () {
      this.date = this.proxyDate
      this.$emit('filterDate', { date: this.date })
    }
  },

  computed: {
    dateFormated () {
      return moment(this.date).format('DD/MM/YYYY')
    }
  }
}
</script>
