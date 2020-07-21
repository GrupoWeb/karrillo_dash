<template>
    <div class="container-md"> 
        <el-card class="box-card">
            <div slot="header" >
                <span>Catálogos de Clientes</span>
            </div>
            <el-form ref="form" :model="form"  >
                <el-row :gutter="20">
                    <el-col :xs="25" :sm="12" :md="12" :lg="5" :xl="5">
                        <el-form-item label="Nombres:" >
                            <el-input v-model="form.first_name" :ref="'first_name'"  @change="handleInputl('first_name')"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="25" :sm="12" :md="12" :lg="5" :xl="5">
                        <el-form-item label="Apellidos:" >
                            <el-input v-model="form.last_name" :ref="'last_name'"  @change="handleInputl('last_name')"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="25" :sm="12" :md="12" :lg="8" :xl="8">
                        <el-form-item label="Nombre Comercial:" prop="tradename" :rules ="[{ required: true, message: 'Campo no puede ser vacio' , trigger: 'blur'}]">
                            <el-input v-model="form.tradename" :ref="'tradename'"  @change="handleInputl('tradename')"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="25" :sm="12" :md="12" :lg="6" :xl="6">
                        <el-form-item label="Dirección:" prop="address" :rules ="[{ required: true, message: 'Campo no puede ser vacio' , trigger: 'blur'}]">
                            <el-input v-model="form.address"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row :gutter="20">
                    <el-col :xs="25" :sm="6" :md="8" :lg="4" :xl="4"> 
                        <el-form-item label="Nit:" prop="nit" :rules ="[{ required: true, message: 'Campo no puede ser vacio' , trigger: 'blur'}]">
                            <el-input v-model="form.nit"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="25" :sm="6" :md="8" :lg="4" :xl="4">
                        <el-form-item label="Limite de Credito:" prop="credit_limit" :rules ="[{ required: true, message: 'Campo no puede ser vacio' , trigger: 'blur'}]">
                            <el-input v-model="form.credit_limit"></el-input>
                        </el-form-item>
                    </el-col>

                    <el-col :xs="25" :sm="8" :md="8" :lg="7" :xl="8">
                        <el-form-item label="Teléfono Principal:" prop="phone_p" :rules ="[{ required: true, message: 'Campo no puede ser vacio' , trigger: 'blur'}]">
                            <el-input v-model="form.phone_p"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="25" :sm="8" :md="8" :lg="7" :xl="8">
                        <el-form-item label="Teléfono Secundario:" prop="phone_s" :rules ="[{ required: true, message: 'Campo no puede ser vacio' , trigger: 'blur'}]">
                            <el-input v-model="form.phone_s"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row :gutter="20">
                    <el-col :xs="25" :sm="8" :md="8" :lg="12" :xl="16">
                        <el-form-item label="Nombre Contacto:" prop="contact_name" :rules ="[{ required: true, message: 'Campo no puede ser vacio' , trigger: 'blur'}]">
                            <el-input v-model="form.contact_name" :ref="'contact_name'"  @change="handleInputl('contact_name')"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="25" :sm="8" :md="8" :lg="8" :xl="8">
                        <el-form-item label="Teléfono Contacto:" prop="phone_c" :rules ="[{ required: true, message: 'Campo no puede ser vacio' , trigger: 'blur'}]">
                            <el-input v-model="form.phone_c"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-form-item>
                    <el-button type="primary" @click="onSubmit('form')" v-loading.fullscreen.lock="fullscreenLoading" element-loading-text="Loading..."
                               element-loading-spinner="el-icon-loading"
                               element-loading-background="rgba(0, 0, 0, 0.8)">Guardar</el-button>
                    <el-button @click="resetForm('form')">Cancelar</el-button>
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
                    tradename: '',
                    first_name: '',
                    last_name: '',
                    address: '',
                    nit: '',
                    credit_limit:0,
                    phone_p: '',
                    phone_s: '',
                    phone_c: '',
                    contact_name:''

                },
                fullscreenLoading: false,
                handle_provider:[]
            }
        },
        mounted() {

        },
        methods: {
            onSubmit (form){
                this.$refs[form].validate((valid) => {
                    if(valid){
                        const config = { headers: {'Content-Type': 'application/json'} };
                        const h = this.$createElement;
                        this.fullscreenLoading = true;
                        let url = '/addClient';
                          axios.post(url, {
                              tradename: this.form.tradename,
                              first_name: this.form.first_name,
                              last_name: this.form.last_name,
                              address_data: this.form.address,
                              nit_data: this.form.nit,
                              credit_limit_data: this.form.credit_limit,
                              phone_p_data: this.form.phone_p,
                              phone_s_data: this.form.phone_s,
                              phone_c_data: this.form.phone_c,
                              contact_name: this.form.contact_name
                          },config).then(response => {
                              const status = JSON.parse(response.status);
                              if (status === 200) {
                                  this.form.tradename = "",
                                  this.form.first_name = '';
                                  this.form.last_name = '';
                                  this.form.address = '';
                                  this.form.nit = '';
                                  this.form.credit_limit = 0;
                                  this.form.phone_c = '';
                                  this.form.phone_s = '';
                                  this.form.phone_p = '';
                                  this.form.contact_name = '';
                                  this.$message({
                                      message: h("p", null, [
                                          h("i", { style: "color: teal" }, "Cliente Almacenado!")
                                      ]),
                                      type: 'success'
                                  });
                                  this.fullscreenLoading = false;
        
                              }
        
                          })
                    }
                });
            },
            handleInputl(referencia){
                const ext = this.$refs[referencia].$el;
                this.$refs[referencia].$el.children[0].classList.add('upperCase_text');

            },
            resetForm(form){
                // this.$refs[form].resetFields();
                this.form.tradename = "",
                this.form.first_name = '';
                this.form.last_name = '';
                this.form.address = '';
                this.form.nit = '';
                this.form.credit_limit = 0;
                this.form.phone_c = '';
                this.form.phone_s = '';
                this.form.phone_p = '';
                this.form.contact_name = '';
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

    .upperCase_text{
        text-transform: uppercase;
    }

    .text-center th{
        text-align: center !important;
        font-size: 12px !important;
        text-transform: uppercase;
    }

    .bordered td{
        border:1px solid #000 !important;
    }

    .el-table--enable-row-hover .el-table__body tr:hover>td{
        color: #212529 !important;
        background-color: rgba(0, 0, 0, 0.075) !important;
    }

</style>
