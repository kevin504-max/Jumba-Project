<template>
    <div class="PaginationChart">
        <button v-if="showPrevious" class="item prev" @click="changePage(current - 1)">&laquo;</button>
        <button v-for="(page, index) in pages" :key="page" class="item" :class="{ current: page === current }" @click="changePage(index)">{{ page }}</button>
        <button v-if="showNext" class="item next" @click="changePage(current + 1)">&raquo;</button>
    </div>
</template>

<script>
export default {
    name: 'PaginationChart',
    props: {
        offset: {
            type: [String, Number],
            default: 0,
        },
        total: {
            type: [String, Number],
            required: true,
        },
        limit: {
            type: [String, Number],
            default: 10,
        },
    },
    computed: {
        showPrevious() {
            return this.current > 1;
        },
        showNext() {
            return this.total > this.limit * this.current;
        },
        current() {
            return this.offset ? this.offset + 1 : 1;
        },
        pages() {
            const quantidade = Math.ceil(this.total / this.limit);
    
            if (quantidade <= 1) return [1];
    
            return Array.from(Array(quantidade).keys(), (i) => i + 1);
        },
    },
    methods: {
        changePage(offset) {
            this.$emit('change-page', offset);
        },
    },
};
</script>

<style scoped>
.paginationChart {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0.5rem 0;
}

.paginationChart .item {
    padding: 0.5rem 0.75rem;
    border: 1px solid #cccccc;
    cursor: pointer;
    background-color: white;
    font-size: 7px;
    color: #333;
    text-decoration: none;
}

.paginationChart .item:first-child {
    border-top-left-radius: 3px;
    border-bottom-left-radius: 3px;
}

.paginationChart .item:last-child {
    border-top-right-radius: 3px;
    border-bottom-right-radius: 3px;
}

.paginationChart .item:hover {
    background-color: #DDD;
    border-color: #E5E5E5;
    z-index: 3;
}

.paginationChart .item.current {
    cursor: default;
    color: white;
    background-color: #FFBB33;
    border-color: #FFBB33;
    z-index: 2;
}

.paginationChart .item.current:hover {
    background-color: #f90;
    border-color: #FFBB33;
}

.paginationChart .item + .item {
    margin-left: -1px;
    margin-right: 0;
    font-size: 7px;
}
</style>
