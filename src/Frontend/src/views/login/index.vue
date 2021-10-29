<template>
    <div class="login-container">
        <p>登录</p>
        <el-form :model="form" :rules="rules" ref="form" :inline="false" size="normal">
            <el-form-item prop="username">
                <el-input v-model="form.username" placeholder="用户名"></el-input>
            </el-form-item>
            <el-form-item prop="password">
                <el-input v-model="form.password" placeholder="密码"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onSubmit('form')">登录</el-button>
            </el-form-item>
        </el-form>
        
    </div>
</template>
<script>
import {fetchLogin} from '@/api/index'    
export default {
    data(){
        return {
            form: {
                username:"",
                password:""
            },
            rules: {
                username: [
                    {required: true, message: '用户名必填', trigger: 'blur'}
                ],
                password: [
                    {required: true, message: '密码必填', trigger: 'blur'}     
                ]
            }
        }

    },
    methods:{
        async onSubmit(form){
            this.$refs[form].validate(async (valid) => {
                if(!valid) {
                    return false;
                }
                const loginReq = await fetchLogin("/login", {...this.form});
                if(loginReq.code != 200) {
                    this.$refs.form.fields[0].error = "用户名或密码错误";
                    this.$refs.form.fields[1].error = "用户名或密码错误";
                }
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