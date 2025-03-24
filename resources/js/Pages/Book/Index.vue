<!-- resources/js/Pages/Book/Index.vue -->
<template>
    <div class="game__background">
        <img :src="book.img_url" :alt="book.title">
    </div>
    <div class="game__wrapper">
        <div class="game__info">
            <div class="game__img">
                <img :src="book.img_url" :alt="book.title">
            </div>
            <div class="game__column">
                <h1 class="game__title">
                    {{book.title}}
                </h1>
                <div class="game__info-item">
                    <div class="game__info-type">
                        Developer:
                    </div>
                    <div class="game__info-value">
                        {{book.developer}}
                    </div>
                </div>
                <div class="game__info-item">
                    <div class="game__info-type">
                        Genres:
                    </div>
                    <div class="game__info-value">
                        {{book.genre}}
                    </div>
                </div>
                <div class="game__info-item">
                    <div class="game__info-type">
                        Release date:
                    </div>
                    <div class="game__info-value">
                        {{book.release_date}}
                    </div>
                </div>
                <div class="game__info-item">
                    <div class="game__info-type">
                        Platforms:
                    </div>
                    <div class="game__info-value">
                        {{book.platform}}
                    </div>
                </div>
                <div class="game__info-item">
                    <div class="game__info-type">
                        Price:
                    </div>
                    <div class="game__info-value price">
                        {{book.price}}
                    </div>
                </div>
            </div>
        </div>
        <div class="game__actions">
            <button @click="back()">Back</button>
            <button @click="deleteGame(book.id)" :disabled="!book.id">Delete</button>
            <button @click="editGame(book.id)" :disabled="!book.id">Edit</button>
        </div>
    </div>
</template>
<script>

export default {
    props: {
        book: Object,
    },
    methods: {
        back(){
            this.$inertia.get(`/`);
        },
        deleteGame(id){
            if (!id) return;
            if (confirm('Are you sure you want to delete this game?')) {
                this.$inertia.delete(`/delete/${id}`);
            }
        },
        editGame(id){
            if (!id) return;
            if (confirm('Are you sure you want to edit this game?')) {
                this.$inertia.get(`/edit/${id}`);
            }
        }
    }
};
</script>

<style scoped>
    .game__actions{
        display: flex;
        flex-direction: row;
        align-items: center;
        align-content: center;
        justify-content: center;
        padding-top: 20px;
        gap: 20px;
    }
    .game__info-value{
        color: #f4f4f4;
        font-weight: bold;
        text-align: right;
    }
    .game__info-value:is(.price)::before{
        content: "$";
    }
    .game__info-type{
        color: #f4f4f4;
        font-weight: bold;
        text-align: left;
    }
    .game__info-item{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        gap: 15px;
        border-top: 1px solid #000000;
    }
    .game__title{
        color: #f4f4f4;
        font-weight: bold;
        text-align: left;
    }
    .game__column{
        display: flex;
        flex-direction: column;
        width: 100%;
    }
    .game__wrapper{
        max-width: 1300px;
        width: calc(100% - 40px);
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .game__info{
        display: flex;
        flex-direction: row;
        gap: 15px;
        padding: 20px;
        border-radius: 15px;
        background-color: #666666;
    }
    .game__img{
        height: 320px;
        min-height: 320px;
        width: 220px;
        min-width: 220px;
        overflow: hidden;
        border-radius: 5px;
    }

    .game__background{
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
    }

    .game__img img,
    .game__background img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }
    @media (max-width: 700px) {
        .game__img{
            display: none;
        }
        .game__title{
            text-align: center;
        }
    }
</style>
