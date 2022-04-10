<template>
<nav v-if="links.length > 3">
    <ul class="pagination">
        <template v-for="(link, key) in links">
            <li v-if="link.url === null" :key="key" class="page-item disabled">
                <a class="page-link" v-html="link.label"></a>
            </li>
            <li v-else class="page-item" :class="{'active': link.active}" :aria-current="link.active ? 'page' : null">
                <Link :key="`link-${key}`" class="page-link" :href="createUrl(link)" v-html="link.label" />
            </li>
        </template>
    </ul>
</nav>    
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
  components: {
    Link,
  },
  props: {
    links: Array,
  },
  methods: {
      createUrl(link) {
          if (this.$attrs && this.$attrs.sort_data) {
              if (this.$attrs.sort_data.sort && this.$attrs.sort_data.sort != "") {
                  if (this.$attrs.sort_data.direction && this.$attrs.sort_data.direction == "") {
                      return link.url
                          + "&sort=" + this.$attrs.sort_data.sort
                          + "&direction=asc";
                  } else {
                      return link.url
                          + "&sort=" + this.$attrs.sort_data.sort
                          + "&direction=" + this.$attrs.sort_data.direction;
                  }
              }
          }
          
          return link.url;
      }
  }
}
</script>
