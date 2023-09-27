<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <UserCard :user="currentUser" />
            </v-col>
            <v-col cols="12">
                <PostList :latestPosts="latestPosts" />
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
};
</script>
