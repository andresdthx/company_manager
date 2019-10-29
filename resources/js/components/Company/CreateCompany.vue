<template>
    <div>

        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
            Create new company
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create new company</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="saveCompany" enctype="multipart/form-data">
                    <div class="form-group">
                        <label >Name</label>
                        <input type="text" v-model="name" class="form-control" placeholder="Enter name">
                        <span v-if="errors.name">{{errors.name}}</span>
                    </div>
                    <div class="form-group">
                        <label >Addres</label>
                        <input type="text" v-model="address" class="form-control" placeholder="Enter address">
                        <span v-if="errors.address">{{errors.address}}</span>
                    </div>
                    <div class="form-group">
                        <label >Website</label>
                        <input type="text" v-model="website" class="form-control" placeholder="Enter website">
                        <span v-if="errors.website">{{errors.website}}</span>
                    </div>
                    <div class="form-group">
                        <label >Email</label>
                        <input type="email" v-model="email" class="form-control" placeholder="Enter email">
                        <span v-if="errors.email">{{errors.email}}</span>
                    </div>
                    <div class="form-group">
                        <label>Logo</label>
                        <input type="file" @change="catchImage" class="form-contro-file">
                        <span v-if="errors.logo">{{errors.logo}}</span>
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

    data(){
        return{
            name:null,
            address: null,
            email: null,
            website: null,
            logo: null,
            errors: [],
        }
    },
    methods:{
        catchImage(e){
            this.logo = e.target.files[0];
            console.log(this.logo)
        },
        saveCompany(){

            let formData = new FormData();
            formData.append('name', this.name)
            formData.append('address', this.address)
            formData.append('logo', this.logo)
            formData.append('email', this.email)
            formData.append('website', this.website)

            axios.post('/company',formData)
            .then((res)=>{
                let name = res.data;
                Swal.fire({
                text: `Company ${name} created successfully`,
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
