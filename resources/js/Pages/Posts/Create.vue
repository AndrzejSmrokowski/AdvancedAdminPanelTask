<template>
    <div>
        <h1>Utwórz nowy post</h1>
        <v-form @submit.prevent="createPost">
            <v-text-field label="Tytuł" v-model="title" required></v-text-field>
            <v-textarea label="Treść" v-model="content" required></v-textarea>
            <v-btn type="submit">Utwórz</v-btn>
        </v-form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            title: '',
            content: ''
        };
    },
    methods: {
        async createPost() {
            try {
                await this.$inertia.post('/posts', {
                    title: this.title,
                    content: this.content
                });
                console.log("Post został pomyślnie utworzony");
            } catch (error) {
                console.error("Wystąpił błąd podczas tworzenia posta:", error);
            }
        }
    }
};
</script>
