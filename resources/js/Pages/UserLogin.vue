<template>
    <v-container>
        <v-form @submit.prevent="handleLogin">
            <v-text-field label="Email" v-model="email" required></v-text-field>
            <v-text-field label="Password" type="password" v-model="password" required></v-text-field>
            <v-btn type="submit">Login</v-btn>
        </v-form>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            email: '',
            password: ''
        }
    },
    methods: {
        handleLogin() {
            this.$inertia.post('/auth/login', {
                email: this.email,
                password: this.password
            });
        }
    }
}
</script>
