<template>
  <q-item
    clickable
    tag="a"
    target="_blank"
    rel="noopener noreferrer"
    :href="link"
    v-if="blank"
  >
    <q-item-section
      v-if="icon"
      avatar
    >
      <i class="fab fa-linkedin"
        style="font-size: 1.3rem;margin-left: 2px;"
        v-if="icon === 'linkedin'">
      </i>
      <q-icon :name="icon" v-else />
    </q-item-section>
    <q-item-section>
      <q-item-label>{{ title }}</q-item-label>
      <q-item-label caption>
        {{ caption }}
      </q-item-label>
    </q-item-section>
  </q-item>
  <q-item clickable v-else>
    <q-item-section
      v-if="icon"
      avatar
    >
      <q-icon :name="icon" />
    </q-item-section>

    <q-item-section>
      <router-link :to="link">
        <q-item-label>{{ title }}</q-item-label>
        <q-item-label caption>
          {{ caption }}
        </q-item-label>
      </router-link>
    </q-item-section>
  </q-item>
</template>

<script>
export default {
  name: 'EssentialLink',
  props: {
    title: {
      type: String,
      required: true
    },

    caption: {
      type: String,
      default: ''
    },

    link: {
      type: String,
      default: '#'
    },

    icon: {
      type: String,
      default: ''
    },
    blank: {
      type: Boolean,
      default: false
    }
  }
}
</script>
<style>
  a {
    text-decoration: none;
    color: #333;
  }
</style>
