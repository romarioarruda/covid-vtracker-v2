<template>
    <q-page padding class="row justify-center" id="scrollTargetRef">
        <div class="col-md-10 col-xs-12">
          <div class="text-h5 q-mt-md q-mb-xl">Últimas Notí­cias</div>
          <q-infinite-scroll :offset="250" @load="onLoad">
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
            <template v-if="loading">
              <div class="row justify-center q-my-md">
                <q-spinner-dots color="primary" size="40px" />
              </div>
          </template>
          </q-infinite-scroll>
        </div>
        <ScrollTopReturn/>
    </q-page>
</template>
<script>
import axios from 'axios'
import ScrollTopReturn from '../components/ScrollTopReturn'
export default {
  name: 'CoronaNews',
  components: { ScrollTopReturn },
  data () {
    return {
      ultimasNoticias: [],
      loading: true
    }
  },

  mounted () {
    this.getUltimasNoticias()
  },

  methods: {
    onLoad (index, done) {
      setInterval(() => {
        this.loading = false
      }, 4000)
    },

    getUltimasNoticias () {
      axios.get('/ultimas-noticias')
        .then((res) => {
          this.ultimasNoticias = res.data.news
        })
    }
  }
}
</script>
