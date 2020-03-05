<template>
    <div class="container-md">
        <!-- <el-card class="box-card">
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
        </el-card> -->
        <el-card class="box-card mt-3">
            <div slot="header" >
                <span>Proveedores</span>
            </div>
            <el-row :gutter="20" class="mb-2 ml-3">
                <el-col :xs="25" :sm="8" :md="8" :lg="8" :xl="4">
                    <el-input class="input-with-select" placeholder="Buscar" v-model="search" ><el-button slot="append" icon="el-icon-search" @click="search_data()" v-loading.fullscreen.lock="fullscreenLoadingSearch" element-loading-text="Loading..."
                               element-loading-spinner="el-icon-loading"
                               element-loading-background="rgba(0, 0, 0, 0.8)"></el-button></el-input>
                </el-col>
            </el-row>
            <el-table :data="handle_provider" style="width: 100%"  :ref="'tables_data'">
                <el-table-column label="Empresa" prop="company_name"></el-table-column>
                <el-table-column label="Dirección" prop="address"></el-table-column>
                <el-table-column label="Nit" prop="nit"></el-table-column>
                <el-table-column label="Días de Credito" prop="credit_days"></el-table-column>
                <el-table-column label="Teléfono Principal" prop="principal"></el-table-column>
                <el-table-column label="Teléfono Secundario" prop="secundario"></el-table-column>
                <el-table-column label="Nombre contacto" prop="contact_name"></el-table-column>
                <el-table-column label="Teléfono Contacto" prop="contacto"></el-table-column>
                <el-table-column
                    align="right">
                    
                    <template slot-scope="scope">
                        <el-button
                        size="mini"
                        @click="handleEdit(scope.$index, scope.row)">Editar</el-button>
                        <el-button
                        size="mini"
                        type="danger"
                        @click="handleDell(scope.$index, scope.row)">Eliminar</el-button>
                    </template>
                </el-table-column>
            </el-table>
        </el-card>
        <el-dialog
            title="Eliminar Proveedor"
            :visible.sync="dialogVisible_delete"
            width="30%"
            top="2vh"
            destroy-on-close>
            <span>¿Desea eliminar este proveedor?</span>
            <span slot="footer" class="dialog-footer">
                <el-button @click="dialogVisible_delete = false">Cancelar</el-button>
                <el-button type="primary" @click="handleDelete()" v-loading.fullscreen.lock="fullscreenLoadingDelete" element-loading-text="Loading..."
                               element-loading-spinner="el-icon-loading"
                               element-loading-background="rgba(0, 0, 0, 0.8)">Confirmar</el-button>
            </span>
        </el-dialog>
        <el-dialog
                    title="Editar Proveedor"
                    :visible.sync="dialogTableVisible"
                    width="70%"
                    top="2vh"
                    destroy-on-close
                    >
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
        </el-dialog>
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
                fullscreenLoadingDelete: false,
                handle_provider:[],
                dialogTableVisible: false,
                user_update_id:0,
                search: '',
                dialogVisible_delete: false,
                id_delete:0,
                fullscreenLoadingSearch: false,
            }
        },
        mounted() {
            this.handle_data_provider();
        },
        methods: {
            search_data (){
                this.fullscreenLoadingSearch = true;
                if(this.search === ''){
                    this.handle_style_table_bootstrap('tables_data');

                    let url ='/get_provider';
                    axios.get(url).then(response => {
                        this.handle_provider = response.data;
                        this.fullscreenLoadingSearch = false;
                    })
                }else{
                    this.handle_style_table_bootstrap('tables_data');
    
                    let url ='/get_provider_filter';
                    axios.post(url,{dato: this.search}).then(response => {
                        this.handle_provider = response.data;
                        this.fullscreenLoadingSearch = false;
                    })
                }
            },
            onSubmit (){
                const config = { headers: {'Content-Type': 'application/json'} };
                const h = this.$createElement;
                this.fullscreenLoading = true;
                let url = '/update_provider_data';
                  axios.post(url, {
                      company_data: this.form.company,
                      address_data: this.form.address,
                      nit_data: this.form.nit,
                      credit_days_data: this.form.credit_days,
                      phone_p_data: this.form.phone_p,
                      phone_s_data: this.form.phone_s,
                      phone_c_data: this.form.phone_c,
                      contact_name: this.form.contact_name,
                      id: this.user_update_id
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
                          this.user_update_id = 0
                          this.$message({
                              message: h("p", null, [
                                  h("i", { style: "color: teal" }, "Proveedor Almacenado!")
                              ]),
                              type: 'success'
                          });
                          this.fullscreenLoading = false;
                          this.handle_data_provider();
                          this.dialogTableVisible = false;
                      }

                  })
            },
            handle_style_table_bootstrap(table_info){                               
                const table = this.$refs[table_info].$el.children[1].children[0].classList;
                const header = this.$refs[table_info].$el.children[1].children[0].children[1].classList;
                const body = this.$refs[table_info].$el.children[2].children[0].classList;
                
                
                table.add('table');
                table.add('table-striped');
                table.add('table-bordered');
                table.add('table-hover');
                header.add('thead-dark');
                header.add('text-center');
                body.add('table');
                body.add('table-bordered');
                body.add('bordered');
                
                
          

            },
            handle_data_provider (){
                this.handle_style_table_bootstrap('tables_data');

                let url ='/get_provider';
                axios.get(url).then(response => {
                    this.handle_provider = response.data;
                })
            },
            handleInputl(referencia){
                const ext = this.$refs[referencia].$el;
                this.$refs[referencia].$el.children[0].classList.add('upperCase_text');
                
            },
            handleEdit(index, row){
                this.dialogTableVisible = true;
                this.form.company = row.company_name;
                this.form.address = row.address;
                this.form.nit = row.nit;
                this.form.credit_days = row.credit_days;
                this.form.phone_c = row.contacto;
                this.form.phone_s = row.secundario;
                this.form.phone_p = row.principal;
                this.form.contact_name = row.contact_name;
                this.user_update_id = row.user_data_id;
            },
            handleDell(index,row){
                
                this.dialogVisible_delete = true;
                this.id_delete = row.user_data_id;
            },
            handleDelete(){
              
                let url ='/delete_provider_data';
                const config = { headers: {'Content-Type': 'application/json'} };
                const h = this.$createElement;
                this.fullscreenLoadingDelete = true;
                axios.post(url,{id: this.id_delete},config).then(response => {
                    const status = JSON.parse(response.status);
                      if (status == "200") {
                          this.$message({
                              message: h("p", null, [
                                  h("i", { style: "color: teal" }, "Proveedor Eliminado!")
                              ]),
                              type: 'error'
                          });
                          this.handle_data_provider();
                          this.fullscreenLoadingDelete = false;
                          this.dialogVisible_delete = false;
                      }
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
