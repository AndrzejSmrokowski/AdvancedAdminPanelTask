<template>
    <div>
        <h1>Strona rejestracji</h1>

        <form @submit.prevent="handleRegister">
            <div>
                <label for="name">Imię i nazwisko:</label>
                <input type="text" v-model="name" required>
            </div>
            <div>
                <label for="email">E-mail:</label>
                <input type="email" v-model="email" required>
            </div>
            <div>
                <label for="password">Hasło:</label>
                <input type="password" v-model="password" required>
            </div>
            <div>
                <label for="password_confirmation">Potwierdź hasło:</label>
                <input type="password" v-model="password_confirmation" required>
            </div>
            <div>
                <button type="submit">Zarejestruj się</button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation: ''
        };
    },
    methods: {
        handleRegister() {
            axios.post('/api/register', {
                name: this.name,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation
            })
                .then(response => {
                    if (response.status === 201) {
                        this.$inertia.visit('/userlogin')
                    }
                })
                .catch(error => {
                    if (error.response) {
                        console.error("Wystąpił błąd podczas rejestracji:", error.response.data);
                    } else {
                        console.error("Wystąpił błąd, ale nie można odczytać odpowiedzi:", error);
                    }
                });
        }
    }
};
</script>
