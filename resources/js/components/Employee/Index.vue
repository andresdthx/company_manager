<template>
    <div>

        <edit-employee
            v-if="openModal"
            :employee=employee
            :companies=companies
            @cerrar="openModal = false"
        ></edit-employee>

        <create-employee
            :companies=companies
        ></create-employee>
        <br>

        <table class="table">
        <thead>
            <tr>
            <th scope="col">First name</th>
            <th scope="col">Last name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Company</th>
            <th scope="col">Edit</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="employee in employees" :key="employee.id">
                <td><a :href="`employee/${employee.id}`"> {{employee.first_name}}</a></td>
                <td>{{employee.last_name}}</td>
                <td>{{employee.email}}</td>
                <td>{{employee.phone}}</td>
                <td>{{employee.company_id}}</td>
                <td>
                    <i style="cursor:pointer" title="Edit" @click="editEmployee(employee)" data-toggle="modal" data-target="#editModalEmployee" class="material-icons">edit</i>
                    <i style="cursor:pointer" title="Delete" @click="deleteEmployee(employee.id)" class="material-icons">delete</i>
                </td>
            </tr>
        </tbody>
        </table>
    </div>
</template>

<script>
import Swal from 'sweetalert2'

    export default {
        props:['employees', 'companies'],

        data(){
            return{
                openModal: false,
                employee: '',
            }
        },

        methods:{
            editEmployee(employee){
                this.employee = employee;
                this.openModal = true;
            },
            closeModal(){
                console.log("melo")
            },
            deleteEmployee(id){
                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.value) {
                    axios.delete(`/employee/${id}`)
                    .then((res)=>{
                        Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    ).then((res)=>{
                        location.reload();
                        })
                    })
                }
                })
            }
        }
    }
</script>
