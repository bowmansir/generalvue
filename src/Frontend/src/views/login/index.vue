<template>
    <div class="login-container">
        <h2>登录</h2>
        <el-form :model="form" ref="form" label-width="80px" :inline="false" size="normal">
            <el-form-item>
                <el-input v-model="form.username" placeholder="用户名"></el-input>
            </el-form-item>
            <el-form-item>
                <el-input v-model="form.password" placeholder="密码"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onSubmit">登录</el-button>
            </el-form-item>
        </el-form>
        
    </div>
</template>
<script>
import {Login} from '@/api/index'    
export default {
    data(){
        return {
            ip: "222",
            form: {
                username:"",
                password:""
            }
        }

    },
    methods:{
        onSubmit(){
            Login("/login", {}).then(res => {
                console.log(res)
            })
        }
    }
}
</script>
<style>
    .login-container{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
</style>