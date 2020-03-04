<template>
    <div class="container-md">
        <el-card class="box-card">
            <div slot="header" >
                <span>Catálogos de Proveedores</span>
            </div>
            <el-form ref="form" :model="form" >
                <el-row :gutter="20">
                    <el-col :xs="25" :sm="12" :md="12" :lg="12" :xl="12">
                        <el-form-item label="Nombre Empresa:" >
                            <el-input v-model="form.company"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="25" :sm="12" :md="12" :lg="12" :xl="12">
                        <el-form-item label="Dirección:">
                            <el-input v-model="form.address"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row :gutter="20">
                    <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="8">
                        <el-form-item label="Nit:">
                            <el-input v-model="form.nit"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="4">
                        <el-form-item label="Días Credito:">
                            <el-input v-model="form.credit_days"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="25" :sm="8" :md="8" :lg="8" :xl="4">
                        <el-form-item label="Teléfono Principal:">
                            <el-input v-model="form.phone_p"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="25" :sm="8" :md="8" :lg="8" :xl="4">
                        <el-form-item label="Teléfono Secundario:">
                            <el-input v-model="form.phone_s"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="25" :sm="8" :md="8" :lg="8" :xl="4">
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
                    company: '',
                    address: '',
                    nit: '',
                    credit_days:0,
                    phone_p: '',
                    phone_s: '',
                    phone_c: ''
                }
            }
        },
        mounted() {

        },
        methods: {
            onSubmit (){
                let url = '/addProvider';
                  axios.post(url, {
                      company_data: this.form.company,
                      address_data: this.form.address,
                      nit_data: this.form.nit,
                      credit_days_data: this.form.credit_days,
                      phone_p_data: this.form.phone_p,
                      phone_s_data: this.form.phone_s,
                      phone_c_data: this.form.phone_c
                  }).then(response => {
                      console.log(response.data);
                  })
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
