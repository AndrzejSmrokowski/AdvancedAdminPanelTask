<template>
    <div>
        <h1>Strona logowania</h1>

        <form @submit.prevent="handleLogin">
            <div>
                <label for="email">E-mail:</label>
                <input type="email" v-model="email" required>
            </div>
            <div>
                <label for="password">Hasło:</label>
                <input type="password" v-model="password" required>
            </div>
            <div>
                <button type="submit">Zaloguj się</button>
            </div>
        </form>
    </div>
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
        }
    }
}
</script>
