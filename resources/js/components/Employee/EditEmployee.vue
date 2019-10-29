<template>
    <div>

        <!-- Modal -->
        <div class="modal fade" id="editModalEmployee" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit employee: {{employee.first_name}} {{employee.last_name}}</h5>
                <button type="button" class="close" data-dismiss="modal" @click="closeModal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="updateEmployee" enctype="multipart/form-data">
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

                    <button type="submit" class="btn btn-success btn-block">Update employee</button>
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
    props:['employee', 'companies'],
    data(){
        return{
            first_name:this.employee.first_name,
            last_name: this.employee.last_name,
            password: null,
            phone: this.employee.phone,
            email: this.employee.email,
            company: this.companies[0].id,
            errors: [],
        }
    },
    methods:{
        closeModal(){
            this.$emit('cerrar')
            console.log("cerrar")
        },
        updateEmployee(){

            axios.put(`/employee/{${this.employee.id}}`,{
                first_name: this.first_name,
                last_name: this.last_name,
                email: this.email,
                password: this.password,
                phone: this.phone,
                company_id: this.company
            })
            .then((res)=>{
                let name = res.data;
                Swal.fire({
                text: `Employee ${name} updated successfully`,
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
