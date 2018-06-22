<template>
    <div class="m-portlet" >
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class="flaticon-lock-1"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        Artista/Creativo/Emprendedor
                    </h3>
                </div>
            </div>
        </div>
        
        
        <form class="form" role="form">
            
            <div  id="wizard-b" class="m-portlet__body">
                    <div class="m-form__heading text-center">
                        <h3 class="m-form__heading-title">
                            Tu información básica
                        </h3>
                    </div>                    
                    
                    <div class="form-group m-form__group row">
                            <div class="col-md-6">
                                <label for="">
                                    Nombres *
                                </label>
                                <input type="text" v-model="first_name" class="form-control m-input m--margin-bottom-20 "  value="" title="Campo requerido" >
                            </div>
                            <div class="col-md-6">
                                <label for="">
                                    Apellidos *
                                </label>
                                <input type="text" v-model="last_name" class="form-control m-input m--margin-bottom-20 "  value="" >
                            </div>
                    </div>
                    
            </div>
            

            <div class="container">
                <div class="row">
                    <div class="col-md-6 m--margin-top-20 text-right">
                    <a class="btn btn-info btn-step" href="">
                        Cancelar
                    </a>
                    </div>
                    <div class="col-md-6 m--margin-top-20 text-left">                        
                        
                        <button type="button" class="btn btn-brand btn-step m-btn m-btn--custom m-btn--icon m--margin-bottom-20" @click="update">Guardar</button>
                        
                    </div>
                </div>
            </div>
        
        
        </form>

    </div>
</template>

<script>
    
    export default {
        data(){
            return {
            'first_name': '',
            'last_name': '',
            'slcdocType': '',
            'document': '',
            'email': '',
            'phone': '',
            'birth': '',
            'gender': '',
            'otherGender': '',
            'state': '',
            'city': '',
            }
        },
        /* ready: function() {
            this.loadSellers();
            this.loadPlaces();
        }, */
        methods: {
            update() {
                console.log(this.first_name);
            }
        }
    }
</script>