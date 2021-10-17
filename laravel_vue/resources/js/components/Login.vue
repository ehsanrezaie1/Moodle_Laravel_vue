<template>

<div class="row">
    <div class="col-3"></div>
    <div class="col-6">
       <div class="p-2"><h3>Login</h3></div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input class="form-control" placeholder="Email" type="email" v-model="form.email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"  v-model="form.password" name="password">
        </div>
        
       
        <button @click.prevent="loginUser" type="submit" class="btn btn-primary">Login</button>
       
    </div>
     <div class="col-3"></div>
</div>


</template>
<script>
export default {
    data(){
        return{
            form:{
                email: '',
                password: ''
            },
            errors: []
        }
    },
    methods:{
         loginUser(){
             axios.post('/api/login', this.form).then(() =>{
                 this.$router.push({ name: "Dashboard"}); 
             }).catch((error) =>{
         this.errors = error.response.data.errors;
            })
         }
    }
}
</script>