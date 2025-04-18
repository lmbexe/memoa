<script setup>
import { ref } from 'vue';
import { isLoggedIn, userId } from '../stores/auth';

const login = ref('');
const password = ref('');
const erreur = ref('');
const success = ref(false);

const handleLogin = async () => {
  const res = await fetch('http://localhost/noteApp/api/login.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ login: login.value, password: password.value }),
  });

  const data = await res.json();

  if (data.success) {
    isLoggedIn.value = true;
    userId.value = data.userId;
    erreur.value = ''; 
    success.value = true; 
  } else {
    erreur.value = data.message;
    success.value = false;
  }
};
</script>

<template>
  <form @submit.prevent="handleLogin">
    <input v-model="login" placeholder="Login" />
    <br /><br />
    <input v-model="password" type="password" placeholder="Mot de passe" />
    <br /><br />
    <button type="submit">Se connecter</button>
    <p v-if="erreur" style="color: red;">{{ erreur }}</p>
    <p v-else-if="success" style="color: green;">Connexion réussie !</p>
  </form>
</template>

<style scoped>
</style>
