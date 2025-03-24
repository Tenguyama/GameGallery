<template>
    <div class="form__content">
        <h1 class="page__title">
            {{ form.id ? 'Edit game' : 'Add new game' }}
        </h1>

        <form @submit.prevent="saveBook">
            <label class="form__column">
                Title:
                <input v-model="form.title" type="text" required />
            </label>
            <label class="form__column">
                Developer:
                <input v-model="form.developer" type="text" required />
            </label>
            <label class="form__column">
                Genre:
                <input v-model="form.genre" type="text" required />
            </label>
            <label class="form__column">
                Release Date:
                <input v-model="form.release_date" type="date" required />
            </label>
            <label class="form__column">
                Platform:
                <input v-model="form.platform" type="text" required />
            </label>
            <label class="form__column">
                Price:
                <input v-model="form.price" type="number" step="0.01" required />
            </label>

            <!--select upload img or url-->
            <label>
                <input type="radio" v-model="imageSource" value="file" /> Upload Image
            </label>
            <label>
                <input type="radio" v-model="imageSource" value="url" /> Use Image URL
            </label>

            <label class="form__column" v-if="imageSource === 'file'">
                Image FILE:
                <input type="file" @change="handleFileUpload" accept="image/*" />
            </label>
            <label class="form__column" v-else>
                Image URL:
                <input v-model="form.img_url" type="url" />
            </label>

            <div class="form__actions">
                <button @click="back()">Back</button>
                <button type="submit">Save</button>
            </div>
        </form>
    </div>

</template>

<script>
export default {
    props: {
        book: {
            type: Object,
            default: () => ({})
        }
    },
    data() {
        return {
            form: {
                id: this.book.id || null,
                title: this.book.title || '',
                developer: this.book.developer || '',
                genre: this.book.genre || '',
                release_date: this.book.release_date || '',
                platform: this.book.platform || '',
                price: this.book.price || 0,
                img_url: this.book.img_url || '',
                image: null
            },
            imageSource: this.book.img_url ? 'url' : 'file'
        };
    },
    methods: {
        back(){
            this.$inertia.get(`/`);
        },
        handleFileUpload(event) {
            this.form.image = event.target.files[0];
            this.form.img_url = '';
        },
        saveBook() {
            let formData = new FormData();
            formData.append('title', this.form.title);
            formData.append('developer', this.form.developer);
            formData.append('genre', this.form.genre);
            formData.append('release_date', this.form.release_date);
            formData.append('platform', this.form.platform);
            formData.append('price', this.form.price);

            if (this.imageSource === 'file' && this.form.image) {
                formData.append('image', this.form.image);
            } else if (this.imageSource === 'url') {
                formData.append('img_url', this.form.img_url);
            }

            if (this.form.id) {
                this.$inertia.post(`/save/${this.form.id}`, formData);
            } else {
                this.$inertia.post(`/save`, formData);
            }
        }
    },
};
</script>


<style scoped>
form{
    display: flex;
    flex-direction: column;
    align-content: center;
    align-items: center;
    justify-content: center;
    padding: 0 20px;
}
.form__column{
    display: flex;
    flex-direction: column;
    width: 100%;
    max-width: 300px;
    align-items: start;
}
.form__column * {
    width: 100%;
}
.form__actions{
    padding: 20px 0;
    display: flex;
    flex-direction: row;
    align-items: center;
    align-content: center;
    justify-content: center;
    gap: 15px;
}
</style>
