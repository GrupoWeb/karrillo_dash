<template>
    <div class="container-md">
        <el-card class="box-card">
            <div slot="header" >
                <span>Catálogos de Proveedores</span>
            </div>
            <el-form ref="form" :model="form" >
                <el-row :gutter="20">
                    <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="12">
                        <el-form-item label="Nombre:" >
                            <el-input v-model="form.first_name"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="12">
                        <el-form-item label="Apellido:">
                            <el-input v-model="form.last_name"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row :gutter="20">
                    <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="16">
                        <el-form-item label="Dirección:">
                            <el-input v-model="form.address"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="4">
                        <el-form-item label="Nit:">
                            <el-input v-model="form.nit"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="4">
                        <el-form-item label="Días Credito:">
                            <el-input v-model="form.nit"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row :gutter="20">
                    <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="8">
                        <el-form-item label="Teléfono Principal:">
                            <el-input v-model="form.phone_p"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="8">
                        <el-form-item label="Teléfono Secundario:">
                            <el-input v-model="form.phone_s"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="8">
                        <el-form-item label="Teléfono Contacto:">
                            <el-input v-model="form.phone_c"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-form-item>
                    <el-button type="primary" @click="onSubmit">Guardar</el-button>
                    <el-button>Cancelar</el-button>
                </el-form-item>
            </el-form>
        </el-card>
    </div>
</template>

<script>
    export default {
        name: "provider",
        data() {
            return{
                form: {
                    first_name: '',
                    last_name: '',
                    address: '',
                    nit: '',
                    phone_p: '',
                    phone_s: '',
                    phone_c: ''
                }
            }
        },
        methods: {
            onSubmit() {
                console.log('submit!');
            }
        }
    }
</script>

<style >
    .el-card__header {
        background-color: #007bff !important;
        color: #fff !important;
        /*padding: 10px 20px;*/
    }

    .el-form-item__label{
        font-weight:bold;
    }
</style>
