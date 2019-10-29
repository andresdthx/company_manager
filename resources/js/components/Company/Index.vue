<template>
    <div>

        <edit-company
            v-if="openModal"
            :company=company
            @cerrar="openModal = false"
        ></edit-company>

        <create-company></create-company>
        <br>

        <table class="table">
        <thead>
            <tr>
            <th scope="col">Name</th>
            <th scope="col">Address</th>
            <th scope="col">Website</th>
            <th scope="col">Email</th>
            <th scope="col">Edit</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="company in companies" :key="company.id">
                <td><a :href="`company/${company.id}`"> {{company.name}}</a></td>
                <td>{{company.address}}</td>
                <td>{{company.website}}</td>
                <td>{{company.email}}</td>
                <td>
                    <i style="cursor:pointer" title="Edit" @click="editCompany(company)" data-toggle="modal" data-target="#editModalCompany" class="material-icons">edit</i>
                    <i style="cursor:pointer" title="Delete" @click="deleteCompany(company.id)" class="material-icons">delete</i>
                </td>
            </tr>
        </tbody>
        </table>
    </div>
</template>

<script>
import Swal from 'sweetalert2'

    export default {
        props:['companies'],

        data(){
            return{
                openModal: false,
                company: '',
            }
        },

        methods:{
            editCompany(company){
                this.openModal = true;
                this.company = company;
            },
            deleteCompany(id){
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
                    axios.delete(`/company/${id}`)
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
