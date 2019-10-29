<template>
    <div>

        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
            Create new Employee
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create new employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="saveEmployee" enctype="multipart/form-data">
                    <div class="form-group">
                        <label >First name</label>
                        <input type="text" v-model="first_name" class="form-control" placeholder="Enter last name">
                        <span v-if="errors.first_name">{{errors.first_name}}</span>
                    </div>

                    <div class="form-group">
                        <label >Last name</label>
                        <input type="text" v-model="last_name" class="form-control" placeholder="Enter last name">
                        <span v-if="errors.last_name">{{errors.last_name}}</span>
                    </div>

                    <div class="form-group">
                        <label >Email</label>
                        <input type="email" v-model="email" class="form-control" placeholder="Enter email">
                        <span v-if="errors.email">{{errors.email}}</span>
                    </div>

                    <div class="form-group">
                        <label >Password</label>
                        <input type="password" v-model="password" class="form-control" placeholder="Enter password">
                        <span v-if="errors.password">{{errors.password}}</span>
                    </div>

                    <div class="form-group">
                        <label >Phone</label>
                        <input type="text" v-model="phone" class="form-control" placeholder="Enter phone">
                        <span v-if="errors.phone">{{errors.phone}}</span>
                    </div>

                    <div class="form-group">
                        <label>Company</label>
                        <select class="form-control" v-model="company">
                            <option v-for="company in companies" :value="company.id" :key="company.id">
                                {{company.name}}
                            </option>
                        </select>
                        <span v-if="errors.company">{{errors.company}}</span>
                    </div>

                    <div class="form-group">
                        <label>Roles</label>
                        <select class="form-control" v-model="role">
                            <option v-for="company in roles" :value="company.id" :key="company.id">
                                {{company.name}}
                            </option>
                        </select>
                        <span v-if="errors.company">{{errors.company}}</span>
                    </div>

                    <button type="submit" class="btn btn-success btn-block">Create</button>
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
</template>
<script>
import Swal from 'sweetalert2'

export default {
    props:['companies', 'roles'],
    data(){
        return{
            first_name:null,
            last_name: null,
            password: '',
            phone: null,
            email: null,
            company: this.companies[0].id,
            role: this.roles[0].id,
            errors: [],
        }
    },
    methods:{
        saveEmployee(){

            let formData = new FormData();
            formData.append('first_name', this.first_name)
            formData.append('last_name', this.last_name)
            formData.append('email', this.email)
            formData.append('password', this.password)
            formData.append('phone', this.phone)
            formData.append('role', this.role)
            formData.append('company_id', this.company)

            axios.post('/employee',formData)
            .then((res)=>{
                let name = res.data;
                Swal.fire({
                text: `Employee ${name} created successfully`,
                type: 'success',
                confirmButtonText: 'Cool'
                }).then((res)=>{
                    location.reload();
                })
            })
            .catch((error)=>{
                console.log(error)
                this.errors = error.response.data.errors;
            })
        }
    }
}
</script>
