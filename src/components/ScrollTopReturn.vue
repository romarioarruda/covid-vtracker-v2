<template>
    <div>
        <q-page-sticky position="bottom-right" :offset="[18, 18]">
            <q-btn fab-mini icon="keyboard_arrow_up" color="primary" @click="scrollTopReturn"/>
        </q-page-sticky>
    </div>
</template>
<script>
export default {
  methods: {
    scrollTopReturn () {
      const element = document.querySelector('body')
      element.scrollIntoView({
        behavior: 'smooth'
      })
    }
  }
}
</script>
