<script setup>
fetch("http://localhost/noteApp/appnote/api/test_connexion.php")
  .then(res => res.text())
  .then(console.log)
</script>

<template>
hello world

</template>

<style scoped>

</style>
