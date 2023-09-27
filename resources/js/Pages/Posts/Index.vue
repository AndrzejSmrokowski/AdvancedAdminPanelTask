<template>
    <v-data-table
        v-model:items-per-page="itemsPerPage"
        :headers="headers"
        :items="posts"
        :loading="loading"
        :search="search"
        class="elevation-1"
    >
        <template v-slot:item.action="{ item }">
            <v-btn @click="viewPostDetail(item)" color="primary">Szczegóły</v-btn>
        </template>
    </v-data-table>
</template>

<script>
export default {
    props: {
        posts: Array,
    },
    data: () => ({
        itemsPerPage: 5,
        headers: [
            { title: 'ID', key: 'id', align: 'end' },
            { title: 'Tytuł', key: 'title', align: 'start' },
            { title: 'Data publikacji', key: 'created_at', align: 'end' },
            { title: 'Akcje', key: 'action', align: 'end', sortable: false },
        ],
        search: '',
        loading: false,
    }),
    methods: {
        viewPostDetail(item) {
            const id = item.value;
            console.log('Item ID:', id);
            this.$inertia.visit(`/posts/${id}`);
        }
    },
};
</script>

