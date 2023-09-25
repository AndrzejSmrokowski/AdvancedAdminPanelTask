<template>
    <div>
        <h1>Create New Post</h1>
        <v-form @submit.prevent="createPost">
            <v-text-field label="Title" v-model="title" required></v-text-field>
            <v-textarea label="Content" v-model="content" required></v-textarea>
            <v-btn type="submit">Create</v-btn>
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
                await this.$inertia.post('/api/posts', {
                    title: this.title,
                    content: this.content
                });
                console.log("Post successfully created");
            } catch (error) {
                console.error("An error occurred while creating the post:", error);
            }
        }
    }
};
</script>
