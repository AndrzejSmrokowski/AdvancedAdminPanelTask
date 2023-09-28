<template>
    <v-dialog v-model="internalDialog" max-width="500px">
        <v-card>
            <v-card-title>
                <span class="text-h5">Manage User</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <v-select
                                :items="roles"
                                label="Assign Role"
                                v-model="selectedRole"
                            ></v-select>
                        </v-col>
                    </v-row>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="close">Close</v-btn>
                <v-btn color="blue darken-1" text @click="save">Save</v-btn>
                <v-btn color="orange darken-1" text @click="editUser">Edit</v-btn>
                <v-btn color="red darken-1" text @click="deleteUser">Delete</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: {
        roles: Array,
        dialog: Boolean,
    },
    data() {
        return {
            selectedRole: null,
        };
    },
    computed: {
        internalDialog: {
            get() {
                return this.dialog;
            },
            set(value) {
                this.$emit('update:dialog', value);
            },
        },
    },
    methods: {
        close() {
            this.internalDialog = false;
        },
        save() {
            this.internalDialog = false;
        },
        editUser() {
            console.log("Edit User");
        },
        deleteUser() {
            console.log("Delete User");
        },
    },
};
</script>
