<template>
<nav v-if="links.length > 3">
    <ul class="pagination">
        <template v-for="(link, key) in links">
            <li v-if="link.url === null" :key="key" class="page-item disabled">
                <a class="page-link" v-html="link.label"></a>
            </li>
            <li v-else class="page-item" :class="{'active': link.active}" :aria-current="link.active ? 'page' : null">
                <Link :key="`link-${key}`" class="page-link" :href="link.url" v-html="link.label" />
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
}
</script>
