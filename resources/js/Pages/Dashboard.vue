<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <UserCard :user="currentUser" />
                <v-btn @click="goToProfile">Profile</v-btn>
                <v-btn @click="logout">Logout</v-btn>
            </v-col>
            <v-col cols="12">
                <PostList :latestPosts="latestPosts" />
                <v-btn @click="goToPosts">View All Posts</v-btn>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import UserCard from '@/Components/UserCard.vue';
import PostList from '@/Components/PostList.vue';

export default {
    components: {
        UserCard,
        PostList,
    },
    props: {
        currentUser: Object,
        latestPosts: Array,
    },
    methods: {
        goToPosts() {
            this.$inertia.visit('/posts');
        },
        goToProfile() {
            this.$inertia.visit('/profile');
        },
        logout() {
            this.$inertia.post('/auth/logout');
        },
    }
};
</script>
