<template>
    <div class="container-md">
        <el-card class="box-card">
            <div slot="header" >
                <span>Catálogos de Proveedores</span>
            </div>
            <el-form ref="form" :model="form" :rules="rules">
                <el-row :gutter="20">
                    <el-col :xs="25" :sm="12" :md="12" :lg="12" :xl="12">
                        <el-form-item label="Nombre Empresa:" prop="company" >
                            <!-- <input type="text" class="form-control" v-model="form.company" :ref="'company_name'" @change="handleInputl('company_name')" placeholder="Nombre de la Empresa"> -->
                            <el-input  v-model="form.company" :ref="'company_name'"  @change="handleInputl('company_name')" placeholder="Nombre de la Empresa"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="25" :sm="12" :md="12" :lg="12" :xl="12">
                        <el-form-item label="Dirección:" prop="address">
                            <!-- <input type="text" class="form-control" v-model="form.address" placeholder="Dirección de la Empresa"> -->
                            <el-input v-model="form.address" placeholder="Dirección de la Empresa"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row :gutter="20">
                    <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="6">
                        <el-form-item label="Nit:" prop="nit">
                            <!-- <input type="text" class="form-control" v-model="form.nit" placeholder="Nit de la Empresa"> -->
                            <el-input v-model="form.nit" placeholder="Nit de la Empresa"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="25" :sm="6" :md="8" :lg="6" :xl="6">
                        <el-form-item label="Días Credito:" prop="credit_days">
                            <!-- <input type="text" class="form-control" v-model="form.credit_days" placeholder="0 días de Credito"> -->
                            <el-input v-model="form.credit_days"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="25" :sm="8" :md="8" :lg="6" :xl="6">
                        <el-form-item label="Teléfono Principal:" prop="phone_p">
                            <!-- <input type="text" class="form-control" v-model="form.phone_p" placeholder="Teléfono Principal"> -->
                            <el-input v-model="form.phone_p" placeholder="Teléfono Principal"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="25" :sm="8" :md="8" :lg="6" :xl="6">
                        <el-form-item label="Teléfono Secundario:" prop="phone_s">
                            <!-- <input type="text" class="form-control" v-model="form.phone_s" placeholder="Teléfono Secundario"> -->
                            <el-input v-model="form.phone_s" placeholder="Teléfono Secundario"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row :gutter="20">
                    <el-col :xs="25" :sm="8" :md="8" :lg="12" :xl="12">
                        <el-form-item label="Nombre Contacto:" prop="contact_name">
                            <!-- <input type="text" class="form-control" v-model="form.contact_name" @change="handleInputl('contact_name')" placeholder="Nombre de Contacto"> -->
                            <el-input v-model="form.contact_name" :ref="'contact_name'"  @change="handleInputl('contact_name')" placeholder="Nombre de Contacto"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="25" :sm="8" :md="8" :lg="12" :xl="12">
                        <el-form-item label="Teléfono Contacto:" prop="phone_c">
                            <!-- <input type="text" class="form-control" v-model="form.phone_c" placeholder="Teléfono de Contacto"> -->
                            <el-input v-model="form.phone_c" placeholder="Teléfono de Contacto"></el-input>
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
                    company: '',
                    address: '',
                    nit: '',
                    credit_days:0,
                    phone_p: '',
                    phone_s: '',
                    phone_c: '',
                    contact_name:''

                },
                fullscreenLoading: false,
                handle_provider:[],
                rules: {
                    company: [
                        { required: true, message: 'Ingrese el nombre de la empresa', trigger: 'blur' },
                        { min: 1, message: 'Ingrese un valor valido', trigger: 'blur' }
                    ],
                    address: [
                        { required: true, message: 'Ingrese la dirección de la empresa', trigger: 'blur' },
                        { min: 1, message: 'Ingrese un valor valido', trigger: 'blur' }
                    ],
                    nit: [
                        { required: true, message: 'Ingrese el nit de la empresa', trigger: 'blur' },
                        { min: 1, message: 'Ingrese un valor valido', trigger: 'blur' }
                    ],
                    credit_days: [
                        { required: true, message: 'Ingrese cuanto días de credito', trigger: 'blur' },
                        { min: 1, message: 'Ingrese un valor valido', trigger: 'blur' }
                    ],
                    phone_p: [
                        { required: true, message: 'Ingrese el teléfono principal de la empresa', trigger: 'blur' },
                        { min: 1, message: 'Ingrese un valor valido', trigger: 'blur' }
                    ],
                    phone_s: [
                        { required: true, message: 'Ingrese el teléfono secundario de la empresa', trigger: 'blur' },
                        { min: 1, message: 'Ingrese un valor valido', trigger: 'blur' }
                    ],
                    phone_c: [
                        { required: true, message: 'Ingrese el telefono de contacto', trigger: 'blur' },
                        { min: 1, message: 'Ingrese un valor valido', trigger: 'blur' }
                    ],
                    contact_name: [
                        { required: true, message: 'Ingrese el nombre de contacto', trigger: 'blur' },
                        { min: 1, message: 'Ingrese un valor valido', trigger: 'blur' }
                    ],
                }
            }
        },
        mounted() {

        },
        methods: {
            onSubmit (form){
                this.$refs[form].validate((valid) => {
                    if (valid) {
                        const config = { headers: {'Content-Type': 'application/json'} };
                        const h = this.$createElement;
                        this.fullscreenLoading = true;
                        let url = '/addProvider';
                          axios.post(url, {
                              company_data: this.form.company,
                              address_data: this.form.address,
                              nit_data: this.form.nit,
                              credit_days_data: this.form.credit_days,
                              phone_p_data: this.form.phone_p,
                              phone_s_data: this.form.phone_s,
                              phone_c_data: this.form.phone_c,
                              contact_name: this.form.contact_name
                          },config).then(response => {
                              const status = JSON.parse(response.status);
                              if (status == "200") {
                                  this.form.company = '';
                                  this.form.address = '';
                                  this.form.nit = '';
                                  this.form.credit_days = 0;
                                  this.form.phone_c = '';
                                  this.form.phone_s = '';
                                  this.form.phone_p = '';
                                  this.form.contact_name = '';
                                  this.$message({
                                      message: h("p", null, [
                                          h("i", { style: "color: teal" }, "Proveedor Almacenado!")
                                      ]),
                                      type: 'success'
                                  });
                                  this.fullscreenLoading = false;
        
                              }
        
                          })
                    }
                })
            },
            handleInputl(referencia){
                const ext = this.$refs[referencia].$el;
                this.$refs[referencia].$el.children[0].classList.add('upperCase_text');
                console.log(ext);
            },
            resetForm(form) {
                this.$refs[form].resetFields();
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
