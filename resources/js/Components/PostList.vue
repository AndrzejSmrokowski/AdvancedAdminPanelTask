<template>
    <v-card>
        <v-card-title>
            Posts
        </v-card-title>
        <v-card-text>
            <v-list>
                <v-list-item v-for="post in latestPosts" :key="post.id">
                    <div class="d-flex w-100 justify-space-between">
                        <div>
                            <v-list-item-title>
                                {{ post.title }}
                            </v-list-item-title>
                            <v-list-item-subtitle>
                                {{ post.content }}
                            </v-list-item-subtitle>
                        </div>
                        <div>
                            <v-list-item-action>
                                <v-btn @click="goToPost(post.id)">Read</v-btn>
                            </v-list-item-action>
                        </div>
                    </div>
                </v-list-item>
            </v-list>
        </v-card-text>
    </v-card>
</template>

<script>
export default {
    props: {
        latestPosts: Array,
    },
    methods: {
        goToPost(id) {
            this.$inertia.visit(`/posts/${id}`);
        },
    },
};
</script>

<style scoped>
.d-flex {
    display: flex;
}
.w-100 {
    width: 100%;
}
.justify-space-between {
    justify-content: space-between;
}
</style>
