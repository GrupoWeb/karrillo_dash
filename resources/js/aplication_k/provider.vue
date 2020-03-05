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
                            <el-input v-model="form.company" :ref="'company_name'"  @change="handleInputl('company_name')"></el-input>
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
                    <el-col :xs="25" :sm="8" :md="8" :lg="8" :xl="8">
                        <el-form-item label="Teléfono Secundario:">
                            <el-input v-model="form.phone_s"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="25" :sm="8" :md="8" :lg="8" :xl="12">
                        <el-form-item label="Nombre Contacto:" >
                            <el-input v-model="form.contact_name" :ref="'contact_name'"  @change="handleInputl('contact_name')"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :xs="25" :sm="8" :md="8" :lg="8" :xl="4">
                        <el-form-item label="Teléfono Contacto:">
                            <el-input v-model="form.phone_c"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-form-item>
                    <el-button type="primary" @click="onSubmit" v-loading.fullscreen.lock="fullscreenLoading" element-loading-text="Loading..."
                               element-loading-spinner="el-icon-loading"
                               element-loading-background="rgba(0, 0, 0, 0.8)">Guardar</el-button>
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
                    phone_c: '',
                    contact_name:''

                },
                fullscreenLoading: false,
                handle_provider:[]
            }
        },
        mounted() {
            this.handle_data_provider();
        },
        methods: {
            onSubmit (){
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
                          this.handle_data_provider();
                      }

                  })
            },
            handleInputl(referencia){
                const ext = this.$refs[referencia].$el;
                this.$refs[referencia].$el.children[0].classList.add('upperCase_text');
                console.log(ext);
            },
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
