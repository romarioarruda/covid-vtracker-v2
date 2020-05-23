<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="leftDrawerOpen = !leftDrawerOpen"
        />

        <q-toolbar-title>
          Rastreador do Covid-19
        </q-toolbar-title>

        <div>V-tracker v2.0</div>
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      bordered
      content-class="bg-grey-1"
    >
      <q-list>
        <q-item-label
          header
          class="text-grey-8"
        >
          Links Essenciais
        </q-item-label>
        <EssentialLink
          v-for="link in essentialLinks"
          :key="link.title"
          v-bind="link"
        />

        <q-expansion-item
          expand-separator
          icon="perm_identity"
          label="Desenvolvedor"
          caption="Romário Arruda"
          :header-class="menuItensDev ? 'bg-grey-4' : ''"
          @click="menuItensDev = !menuItensDev"
        >
        <EssentialLink
          v-for="link in aboutDeveloper"
          :key="link.title"
          v-bind="link"
        />
      </q-expansion-item>
      </q-list>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import EssentialLink from 'components/EssentialLink'

export default {
  name: 'MainLayout',
  components: {
    EssentialLink
  },

  data () {
    return {
      leftDrawerOpen: false,
      menuItensDev: false,
      backGroundMenuItensDev: '',
      essentialLinks: [
        {
          title: 'Home',
          caption: 'Covid-19 no Brasil',
          icon: 'home',
          link: '/',
          blank: false
        },
        {
          title: 'Úlitimas Notícias',
          caption: 'Coronavirus',
          icon: 'unsubscribe',
          link: '/coronavirus',
          blank: false
        }
      ],
      aboutDeveloper: [
        {
          title: 'LinkedIn',
          caption: '@romarioarruda',
          icon: 'rss_feed',
          link: 'https://www.linkedin.com/in/rom%C3%A1rio-arruda/',
          blank: true
        },
        {
          title: 'Github',
          caption: 'github.com/covid-vtracker-v2',
          icon: 'code',
          link: 'https://github.com/romarioarruda/covid-vtracker-v2',
          blank: true
        }
      ]
    }
  }
}
</script>
