<template>
    <div class="card" @click="getPage(book.id)">
        <div class="card__img">
            <img :src="book.img_url" :alt="book.title">
        </div>
        <h2 class="card__title">{{book.title}}</h2>
        <span class="card__date">{{book.release_date}}</span>
    </div>
</template>

<script>
export default {
    props: {
        book: Object,
    },
    methods: {
        getPage(id) {
            if (!id) return;
            this.$inertia.get(`/${id}`);
        },
    },
};
</script>

<style scoped>
.card{
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    width: calc(33.3% - 15px);
    overflow: hidden;
    cursor: pointer;
    background-color: #333333;
    padding-bottom: 30px;
}
.card__title{
    color: #f4f4f4;
    text-align: center;
    padding: 5px 10px;
}
.card__date{
    position: absolute;
    bottom: 5px;
    font-size: 14px;
    color: #999999;
}
.card__img{
    width: 100%;
    height: 300px;
    max-height: 300px;
    overflow: hidden;
}
.card__img > img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    transition: all 0.3s;
}
.card:hover img{
    scale: 1.2;
}

@media (max-width: 767px) {
    .card{
        width: calc(50% - 15px);
    }
}
@media (max-width: 450px) {
    .card{
        width: calc(100% - 20px);
    }
}
</style>
