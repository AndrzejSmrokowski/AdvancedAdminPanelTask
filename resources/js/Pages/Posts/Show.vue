<template>
    <div>
        <v-card>
            <v-card-title>
                {{ post.title }}
            </v-card-title>
            <v-card-subtitle>
                {{ post.created_at }}
            </v-card-subtitle>
            <v-card-text>
                {{ post.content }}
            </v-card-text>
        </v-card>
    </div>
</template>

<script>
export default {
    props: {
        post: Object
    }
};
</script>
