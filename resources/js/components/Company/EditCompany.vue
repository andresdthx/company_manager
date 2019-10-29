<template>
    <div>
        <!-- Modal -->
        <div class="modal fade" id="editModalCompany" data-backdrop="static" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit company: {{company.name}}</h5>
                <button type="button" class="close" data-dismiss="modal" @click="closeModal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form @submit.prevent="updateCompany" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" v-model="name" class="form-control" placeholder="Enter name">
                        <span v-if="errors.name">{{errors.name}}</span>
                    </div>
                    <div class="form-group">
                        <label>Addres</label>
                        <input type="text" v-model="address" class="form-control" placeholder="Enter address">
                        <span v-if="errors.address">{{errors.address}}</span>
                    </div>
                    <div class="form-group">
                        <label>Website</label>
                        <input type="text" v-model="website" class="form-control" placeholder="Enter website">
                        <span v-if="errors.website">{{errors.website}}</span>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" v-model="email" class="form-control" placeholder="Enter email">
                        <span v-if="errors.email">{{errors.email}}</span>
                    </div>

                    <button type="submit" class="btn btn-success btn-block">Update</button>
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
    props:['company'],
    data(){
        return{
            name: this.company.name,
            address: this.company.address,
            email: this.company.email,
            website: this.company.website,
            errors: [],
        }
    },
    methods:{
        closeModal(){
            this.$emit('cerrar')
        },
        updateCompany(){

            axios.put(`/company/{${this.company.id}}`, {
                name: this.name,
                address: this.address,
                email: this.email,
                website: this.website,
            })
            .then((res)=>{
                let name = res.data;
                Swal.fire({
                text: `Company ${name} updated successfully`,
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
