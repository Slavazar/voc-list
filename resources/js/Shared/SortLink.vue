<template>
<a :href="getUrl()" @click.prevent="sort">
<slot />
</a>
</template>

<script>
export default {
    components: {
    },
    props: {
        field: String,
    },
    methods: {
        getUrl() {
            var direction = "asc";
            var sort_data = this.$page.props.sort_data;
            
            if (sort_data.direction == "asc") {
                direction = "desc";
            }
            
            var page = null;
            
            if (sort_data.page !== "") {
                page = sort_data.page;
            }
            
            var data = {
                'page': page,
                'sort': this.field,
                'direction': direction
            };
            
            return route(sort_data.route_name, data);
        },
        
        sort(event) {
            var href = event.target.href;
            this.$inertia.get(href);
        },
    },
          
}
</script>
