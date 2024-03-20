<!-- Pagination.vue -->
<template>
    <ul class="pagination">
        <li v-for="page in totalPages" :key="page" class="page-item">
            <a href="#" @click.prevent="selectPage(page)" class="page-link">{{ page }}</a>
        </li>
    </ul>
</template>

<script>
export default {
    props: {
        totalPages: {
            type: Number,
            required: true
        }
    },
    methods: {
        selectPage(page) {
            this.$emit('page-selected', page);
        }
    }
}
</script>

<style>
/* Add your CSS styling here */
.pagination {
    list-style: none;
    display: flex;
    justify-content: center;
}

.page-item {
    margin: 0 5px;
    cursor: pointer;
}

.page-link {
    text-decoration: none;
}
</style>
