<template>
    <div>
        <div class="logo">
            <h2>Tulip</h2>
        </div>
        <div class="menu">
            <router-link active-class="active" to="/">Home</router-link>
            <router-link active-class="active" to="test">Test</router-link>
        </div>
        <hr>
    </div>
</template>

<script>

export default{
     name : 'headers'
}
</script>

<style scoped>
    .logo{
        width: 20%;
        float:left;
    }

    .menu{
        width:80%;
        float:left;
    }
</style>