<template>
    <div>
        <h1>Assalamu Alaikum</h1>
        <h4>This is a test Page</h4>
    
        <table>
            <tr>
                <td>Username</td>
                <td>Age</td>
            </tr>
            <tr v-for="(item, i) in items" :key="i">
                <td>{{item.username}}</td>
                <td>{{item.age}}</td>
                <td><button :id="item.id">Edit</button></td>
            </tr>
        </table>
        <p>current page url : {{url}}</p>
    </div>
</template>

<script>

export default {
    name : "test",

    data() {
        return{
            items : [{
                    id : 1,
                    username : 'azim',
                    age : 32
                },
                {
                    id : 2,
                    username : 'shishir',
                    age : 33
                }
            ],
            url : this.$route.query.page
        }
    }
}
</script>
