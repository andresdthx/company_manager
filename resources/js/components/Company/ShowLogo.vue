<template>
    <div>

        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#showLogo">
            View
        </button>

        <!-- Modal -->
        <div class="modal fade" id="showLogo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-body">
            </div>
                <img :src="getLogoCompany()"/>
            </div>
        </div>
        </div>
    </div>
</template>
<script>
export default {
    methods:{
        getLogoCompany(){
            return "storage/logos/company.png";
        }
    }
}
</script>
