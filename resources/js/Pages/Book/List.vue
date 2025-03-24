<!-- resources/js/Pages/Book/List.vue -->
<template>
        <h1 class="page__title">
            Game gallery
        </h1>
        <div class="gallery__actions">
            <input v-model="search" @input="debouncedSearch" placeholder="Search..." />

            <button @click="createNewGame()">Add new</button>
        </div>

        <div class="gallery__row">
            <Card v-for="book in books.data" :key="book.id" :book="book" />
        </div>

        <div class="pagination">
            <button @click="changePage(books.prev_page_url)" :disabled="!books.prev_page_url">Prev</button>
            <span>Page {{ books.current_page }} in {{ books.last_page }}</span>
            <button @click="changePage(books.next_page_url)" :disabled="!books.next_page_url">Next</button>
        </div>
</template>

<script>
import Card from "@/components/Card.vue";
import { debounce } from "lodash";
export default {
    components: {
        Card,
    },
    props: {
        books: Object,
        query: {
            type: String,
            default: () => ''
        }
    },
    data() {
        return {
            search: this.query
        };
    },
    methods: {
        changePage(url) {
            if (!url) return;
            this.$inertia.get(url);
        },
        searchGame() {
            this.$inertia.get(`/search/${this.search}`);
        },
        debouncedSearch: debounce(function () {
            this.searchGame();
        }, 1000), //1 second timer to last user input
        createNewGame(){
            this.$inertia.get(`/new`);
        }
    },
};
</script>

<style scoped>
    .gallery__actions input{
      width: 100%;
    }
    .gallery__actions{
        padding: 10px 15px;
        display: flex;
        flex-direction: row;
        gap: 20px;
        justify-content: space-between;
    }
    .gallery__row{
        width: 100%;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
    }
    .pagination{
        display: flex;
        justify-content: center;
        align-content: center;
        align-items: center;
        padding: 20px 0;
    }
    .pagination > span {
        padding: 0 10px;
    }
</style>
