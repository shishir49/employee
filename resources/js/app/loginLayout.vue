<template>
    <div>
        <!--========= HEADER ==========-->
        <div class="header">
            <div class="logo">
                <h2><router-link to="/" class="logo-content">Tulip</router-link></h2>
            </div>
            <div class="menu">
                <div v-if="currentUser.name" >
                    <p @click="logoutUser" class="menu-item">Logout</p>
                    <p class="menu-item">{{ currentUser.name }}</p>
                </div>
                <div v-else>
                    <router-link active-class="active" to="/login" class="menu-item">Login</router-link>
                </div>
                
            </div>
        </div>
        <!--========= HEADER ==========-->

        <div class="main-content">
            <router-view class="body-content"></router-view>
        </div>

        <!--========= FOOTER ==========-->
        <div class="footer">
            <p class="footer-note">Copyright@K.S. Azim</p>
        </div>
        <!--========= FOOTER ==========-->
    </div>
</template>

<script>
import { headers } from './website/components/header.vue'
import { mapState } from 'vuex'

export default{
     name : 'app', 

     components : {
         headers
     },

     computed : {
     ...mapState(['currentUser'])
     },

     methods : {
         logoutUser() {
             alert('here')
             this.$store.dispatch("logoutUser")
         }
     }
}
</script>

<style scoped>
    .header{
        width : 100%;
        float:left;
        box-shadow: 5px 2px 2px;
        background:rgb(57, 58, 109);
        height: 7vh;
    }

    .main-content{
        width:100%;
        float:left;
        min-height: 86vh;
    }

    .body-content{
        overflow:scroll;
        width:85%;
        float:left;
        height: 86vh;
    }

    .footer{
        width : 100%;
        float:left;
        height: 7vh;
    }

    .logo{
        width: 15%;
        float:left;
    }

    .logo h2 .logo-content{
        color:rgb(235, 231, 231);
        text-decoration:none;
        padding : 0px 0px 0px 10px;
        line-height : 1.5;
    }

    .menu{
        width:85%;
        height: 100%;
        float:left;
    }

    .menu-item{
        text-decoration:none;
        padding : 0px 25px 0px 25px;
        color:rgb(235, 231, 231);
        font-weight:bold;
        height: 100%;
        margin:0;
        transition : 0.3s ease; 
        line-height : 3.5;
        float:right;
    }

    .sidebar-menu{
        width: 100%;
        text-decoration:none;
        display: inline-block;
        padding : 0px 25px 0px 25px;
        color:rgb(235, 231, 231);
        font-weight:bold;
        margin:0;
        transition : 0.3s ease; 
        line-height : 3.5;
    }

    .menu-item:hover{
        color:rgb(235, 231, 231);
        background:rgb(43, 43, 80);
    }

    .active{
        background:rgb(43, 43, 80);
    }

    .active-nav{
        background:rgb(26, 26, 49);
        height: 7vh;
        width: 100%;
    }

    .sidebar{
        width: 15%;
        overflow: hidden;
        float:left;
        height: 86vh;
        background:rgb(43, 43, 80);
    }

    .footer-note{
        text-align: center;
        padding:5px;
    }
</style>
