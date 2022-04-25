<template>
    <div>
        <h1>Assalamu Alaikum</h1>
        <p>The number {{ getCount }} will be {{increase}} if it's increased by 20</p>

        <div>
            <input type="text" v-model="num">
            <p>{{ result }}</p>
        </div>
        <p>current page url : {{url}}</p>
    </div>
</template>

<script>
import { test } from './test.vue';
import { mapGetters } from 'vuex';

export default{
     name : 'app', 
     components : {
         test
     },

     props : ['username'],
     data() {
         return{
             getCount : this.$store.getters.getCount,
             num : '',
             result : 0,
             url : this.$route.query.page

         }
     },

     computed : {
         increase : function(){
             return this.getCount + 20
         }
     },

     watch : {
        num: function (val) {
            this.num = val;
            this.result = 2 * val;
        },
        
        result: function (val) {
            this.result = val;
        }
     }
}
</script>