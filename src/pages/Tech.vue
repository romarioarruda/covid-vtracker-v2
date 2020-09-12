<template>
  <div class="q-pa-md">
    <div class="q-ml-lg q-mt-md">
      <p class="text-h6">Principais tecnologias utilizadas no desenvolvimento deste projeto</p>
      <hr>
    </div>
    <q-saparator></q-saparator>
    <div class="q-gutter-md row items-start justify-center">
      <q-img
        v-for="url in urls"
        :key="url.key"
        :src="url.logo"
        style="height: 140px; max-width: 250px"
      >
        <template v-slot:loading>
          <div class="text-subtitle1 text-white">
            Loading...
          </div>
        </template>
      </q-img>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Tech',
  data () {
    return {
      urls: [
        { logo: 'statics/logos/javascript.png', key: 'js' },
        { logo: 'statics/logos/vue.png', key: 'vue' },
        { logo: 'statics/logos/php.png', key: 'php' },
        { logo: 'statics/logos/docker.png', key: 'docker' },
        { logo: 'statics/logos/quasar.png', key: 'quasar' }
      ]
    }
  }
}
</script>
