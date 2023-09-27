<template>
    <v-card>
        <v-card-title>
            Quick Post
        </v-card-title>
        <v-card-text>
            <v-form ref="form" @submit.prevent="createPost">
                <v-text-field
                    v-model="title"
                    label="Title"
                    required
                ></v-text-field>
                <v-textarea
                    v-model="content"
                    label="Content"
                    required
                ></v-textarea>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn type="submit" color="primary">Create Post</v-btn>
                </v-card-actions>
            </v-form>
        </v-card-text>
    </v-card>
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
        createPost() {
            if (this.$refs.form.validate()) {
                this.$inertia.post('/posts/quick', {
                    title: this.title,
                    content: this.content
                });
                this.title = '';
                this.content = '';
                this.$refs.form.reset();
            }
        }
    }
};
</script>
