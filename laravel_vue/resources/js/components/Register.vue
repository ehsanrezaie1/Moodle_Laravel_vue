<template>
      <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
           
            <div class="p-2"><h3>Register an account</h3></div>
            <div class="form-group">
                <label class="w-full" for="name">Name</label>
                <span class="w-full text-red-500" v-if="errors.name">{{errors.name[0]}}</span>
                <input class="form-control" placeholder="Name" type="text" v-model="form.name" >
            </div>
            <div class="form-group">
                <label for="email">Your e-mail</label>
                <input class="form-control" placeholder="Email" type="email" v-model="form.email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" placeholder="Password" type="password" v-model="form.password" name="password">
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input class="form-control" placeholder="Confirm Password" type="password" v-model="form.password_confirmation" name="password_confirmation">
            </div>
            <div class="form-group mt-4">
                <button @click.prevent="saveForm" type="submit" class="btn btn-primary">Register</button>
            </div>
        </div> 
         <div class="col-3"></div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            form:{
                name: '',
                email: '',
                password:'',
                password_confirmation:''
            },
            errors:[]
        }
    },
    methods:{
        saveForm(){
            axios.post('/api/register', this.form).then(() =>{
                console.log('saved');
            }).catch((error) =>{
                this.errors = error.response.data.errors;
            })
        }
    }
}
</script>