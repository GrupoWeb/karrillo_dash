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
                    <el-button type="primary" @click="onSubmit" v-loading.fullscreen.lock="fullscreenLoading" element-loading-text="Loading..."
                               element-loading-spinner="el-icon-loading"
                               element-loading-background="rgba(0, 0, 0, 0.8)">Guardar</el-button>
                    <el-button>Cancelar</el-button>
                </el-form-item>
            </el-form>
        </el-card>
        <el-card class="box-card mt-3">
            <div slot="header" >
                <span>Proveedores</span>
            </div>
            <el-table :data="handle_provider" style="width: 100%">
                <el-table-column label="Empresa" prop="company_name"></el-table-column>
                <el-table-column label="Dirección" prop="address"></el-table-column>
                <el-table-column label="Nit" prop="nit"></el-table-column>
                <el-table-column label="Días de Credito" prop="credit_days"></el-table-column>
                <el-table-column label="Teléfono Principal" ></el-table-column>
                <el-table-column label="Teléfono Secundario"></el-table-column>
                <el-table-column label="Teléfono Contacto"></el-table-column>
            </el-table>
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
                      phone_c_data: this.form.phone_c
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
            handle_data_provider (){
                let url ='/get_provider';
                axios.get(url).then(response => {
                    this.handle_provider = response.data;
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
