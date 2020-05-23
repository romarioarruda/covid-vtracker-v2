<template>
    <q-page padding class="row justify-center">
        <div class="col-md-10 col-xs-12">
          <div class="text-h5 q-mt-md q-mb-xl">Últimas Notí­cias</div>
          <q-spinner-cube
            size="xl"
            color="primary"
            v-if="!statusCarregamento"
          />
          <q-card
              class="my-card shadow-6"
              v-for="(noticias, index) in ultimasNoticias"
              :key="index"
          >
            <q-card-section class="q-mb-md">
                <div class="text-overline text-orange-9" v-html="noticias.fonte + ' - ' + noticias.data"></div>
                <div class="text-h6 text-grey-7 q-mt-sm q-mb-xs" v-html="noticias.titulo"></div>
                <div class="text-h7 text-grey q-mt-sm q-mb-xs" v-html="noticias.soutien"></div>
                <q-card-actions>
                    <a :href="noticias.link" target="_blank" rel="noopener noreferrer">
                        <q-btn dense color="primary" label="Ler notí­cia"></q-btn>
                    </a>
                </q-card-actions>
            </q-card-section>
          </q-card>
        </div>
    </q-page>
</template>
<script>
import axios from 'axios'
export default {
  name: 'CoronaNews',
  data () {
    return {
      ultimasNoticias: [],
      statusCarregamento: false
    }
  },

  mounted () {
    this.getUltimasNoticias()
  },

  methods: {
    getUltimasNoticias () {
      axios.get('http://localhost:8081/ultimas-noticias')
        .then((res) => {
          this.ultimasNoticias = res.data.news
          this.statusCarregamento = true
        })
    }
  }
}
</script>
