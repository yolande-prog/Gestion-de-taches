<template>
    <section class="content">
      <div class="container-fluid">
          <div class="row">

            <div class="col-12">

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Liste des contrats</h3>

                  <div class="card-tools">

                    <button type="button" class="btn btn-sm btn-primary" @click="newModal">
                        <i class="fa fa-plus-square"></i>
                        Ajouter Nouveau
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>NOM</th>
                        <th>RECONDUCTION</th>
                        <th>CONTRAT</th>
                        <th>FONCTION</th>
                        <th>VILLE</th>
                        <th>DUREE</th>
                        <th>ALARM 1</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                       <tr v-for="contrat in socials.data" :key="contrat.id">

                        <td>{{contrat.id}}</td>
                        <td>{{contrat.name}}</td>
                        <td>{{contrat.reconduction_name | truncate(30, '...')}}</td>
                        <td>{{contrat.contract_name}}</td>
                        <td>{{contrat.function}}</td>
                        <td>{{contrat.city}}</td>
                        <td>{{contrat.duration}} MOIS</td>
                        <td><span class="badge badge-success p-1">{{contrat.alarm1_date}}</span></td>
                        <td>

                          <a href="#" @click="editModal(contrat)">
                              <i class="fa fa-edit blue"></i>
                          </a>
                          /
                          <a href="#" @click="deleteContract(contrat.id)">
                              <i class="fa fa-trash red"></i>
                          </a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <pagination :data="socials" @pagination-change-page="getResults"></pagination>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>

          <!-- Modal -->
          <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true" >
              <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" v-show="!editmode">Creer un nouveau contract</h5>
                      <h5 class="modal-title" v-show="editmode">Modifier le contract</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>

                  <form @submit.prevent="editmode ? updateContract() : createContract()">
                      <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                          <div class="form-group">
                              <label>Nom</label>
                              <input v-model="form.name" type="text" name="name"
                                  class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                              <has-error :form="form" field="name"></has-error>
                          </div>
                          <div class="form-group" :class="{ 'is-invalid': form.errors.has('contract_name') }" name="contract_name">
                              <label>Nom du contract</label>
                              <select class="form-control" v-model="form.contract_name">
                              <option value="CDI">CDI</option>
                              <option value="CDD">CDD</option>
                              <option value="Stage Professionelle">Stage Professionelle</option>
                            </select>
                            <has-error :form="form" field="contract_name"></has-error>
                          </div>
                          <div class="form-group">
                              <label>Nom du reconduction</label>
                              <input v-model="form.reconduction_name" type="text" name="reconduction_name"
                                  class="form-control" :class="{ 'is-invalid': form.errors.has('contract_name') }">
                              <has-error :form="form" field="reconduction_name"></has-error>
                          </div>
                          <div class="form-group">
                              <label>Fonction</label>
                              <input v-model="form.function" type="text" name="function"
                                  class="form-control" :class="{ 'is-invalid': form.errors.has('function') }">
                              <has-error :form="form" field="function"></has-error>
                          </div>
                              {{ form.name }}
                          <div class="form-group">
                              <label>Durée</label>
                              <input v-model="form.duration" type="text" name="duration"
                                  class="form-control" :class="{ 'is-invalid': form.errors.has('duration') }">
                              <has-error :form="form" field="duration"></has-error>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                              <label>Ville</label>
                              <input v-model="form.city" type="text" name="city"
                                  class="form-control" :class="{ 'is-invalid': form.errors.has('city') }">
                              <has-error :form="form" field="city"></has-error>
                          </div>
                              {{ form.price }}
                          <!-- <div class="form-group">

                              <label>Category</label>
                              <select class="form-control" v-model="form.category_id">
                                <option
                                    v-for="(cat,index) in categories" :key="index"
                                    :value="index"
                                    :selected="index == form.category_id">{{ cat }}</option>
                              </select>
                              <has-error :form="form" field="category_id"></has-error>
                          </div> -->
                          <div class="form-group">
                              <label>Preavis reconduction</label>
                              <input v-model="form.advance_notice_reconduction" type="text" name="advance_notice_reconduction"
                                  class="form-control" :class="{ 'is-invalid': form.errors.has('advance_notice_reconduction') }">
                              <has-error :form="form" field="advance_notice_reconduction"></has-error>
                          </div>
{{ form.advance_notice_reconduction }}
                          <div class="form-group">
                            <label>Date debut contrat</label>
                            <datepicker placeholder="Choissisez une Date" v-model="form.start_contract_date" format="yyyy-MM-dd"></datepicker>
                            <has-error :form="form" field="start_contract_date"></has-error>
                          </div>
                          <div class="form-group">
                              <label>Date fin contrat</label>
                              <datepicker placeholder="Choissisez une Date" v-model="form.end_contract_date" format="yyyy-MM-dd"></datepicker>

                              <has-error :form="form" field="end_contract_date"></has-error>
                          </div>
                          <div class="form-group">
                              <label>Observation</label>
                              <input v-model="form.observation" type="text" name="observation"
                                  class="form-control" :class="{ 'is-invalid': form.errors.has('observation') }">
                              <has-error :form="form" field="observation"></has-error>
                          </div>
                        </div>
                    </div>
                          <!-- <div class="form-group">
                              <label>Tags</label>
                              <vue-tags-input
                                v-model="form.tag"
                                :tags="form.tags"
                                :autocomplete-items="filteredItems"
                                @tags-changed="newTags => form.tags = newTags"
                              />
                              <has-error :form="form" field="tags"></has-error>
                          </div> -->
                          <div class="row w-100">
                            <div class="col-md-4 w-100">
                                <div class="form-group w-100">
                                    <label>Alarm 1</label>
                                    <datepicker class="w-100" placeholder="Choissisez une Date" v-model="form.alarm1_date"></datepicker>
                                    <has-error :form="form" field="alarm1_date"></has-error>
                                </div>{{ moment(date1, 'DD/MM/YYYY').format("DD MMM YYYY") }}
                                <!-- {{ form.alarm1 }}
                                {{ date1 }} -->
                            </div>

                            <div class="col-md-4 w-100">
                                <div class="form-group w-100">
                                    <label>Alarm 2</label>
                                    <datepicker class="w-100" placeholder="Choissisez une Date" v-model="form.alarm2_date" :min="minDate2" range></datepicker>
                                    <has-error :form="form" field="alarm2_date"></has-error>
                                </div>
                                {{ form.alarm2 }}
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Alarm 3</label>
                                    <datepicker placeholder="Choissisez une Date"  v-model="form.alarm3_date" format="yyyy-MM-dd"></datepicker>
                                    <has-error :form="form" field="alarm3_date"></has-error>
                                </div>
                            </div>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                          <button v-show="editmode" type="submit" class="btn btn-success">Modifier</button>
                          <button v-show="!editmode" type="submit" class="btn btn-primary">Créer</button>
                      </div>
                    </form>
                  </div>
              </div>
          </div>
      </div>
    </section>
  </template>

  <script>
      import VueTagsInput from '@johmun/vue-tags-input';
      import moment from 'moment';
      export default {
        components: {
            VueTagsInput,
          },
          data () {
              return {
                moment: moment,
                date: "20-02-2023",
                  minDate2: new Date(2023, 2, 16),
                  date1 : new Date().toISOString().slice(0,10),
                  minDate: new Date("20/02/2023"),
                  minDate1: "20-02-2023",
                  editmode: false,
                  socials : {},
                  form: new Form({
                      id : '',
                      contract_name : '',
                      observation: '',
                      name: '',
                      reconduction_name: '',
                      function: '',
                      city: '',
                      end_contract_date: '',
                      start_contract_date: '',
                      alarm1_date : '',
                      alarm2_date: null,
                      alarm3_date: '',
                      duration: '',
                      advance_notice_reconduction: '',
                  }),
                //   categories: [],this.formatDates(this.date1)

                //   tag:  '',
                //   autocompleteItems: [],
              }
          },
          methods: {
            getResults(page = 1) {

                this.$Progress.start();

                axios.get('api/social?page=' + page).then(({ data }) => (this.socials = data.data));

                this.$Progress.finish();
            },
            loadContracts(){

              // if(this.$gate.isAdmin()){
                axios.get("api/social").then(({ data }) => (this.socials = data.data));
              // }
            },
            loadCategories(){
                axios.get("/api/category/list").then(({ data }) => (this.categories = data.data));
            },
            loadTags(){
                axios.get("/api/tag/list").then(response => {
                    this.autocompleteItems = response.data.data.map(a => {
                        return { text: a.name, id: a.id };
                    });
                }).catch(() => console.warn('Oh. Something went wrong'));
            },
            editModal(social){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(social);
            },

formatDates: function(val){
    console.log(val, "date")
    return moment(val, 'DD/MM/YYYY').format("DD MMM YYYY")
},
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            createContract(){
                this.$Progress.start();

                this.form.post('api/social')
                .then((data)=>{
                  if(data.data.success){
                    $('#addNew').modal('hide');

                    Toast.fire({
                          icon: 'success',
                          title: data.data.message
                      });
                    this.$Progress.finish();
                    this.loadContracts();

                  } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Some error occured! Please try again'
                    });

                    this.$Progress.failed();
                  }
                })
                .catch(()=>{

                    Toast.fire({
                        icon: 'error',
                        title: 'Some error occured! Please try again'
                    });
                })
            },
            updateContract(){
                this.$Progress.start();
                this.form.put('api/social/'+this.form.id)
                .then((response) => {
                    $('#addNew').modal('hide');
                    Toast.fire({
                      icon: 'success',
                      title: response.data.message
                    });
                    this.$Progress.finish();

                    this.loadSocials();
                })
                .catch(() => {
                    this.$Progress.fail();
                });

            },
            deleteContract(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {

                        // Send request to the server
                          if (result.value) {
                                this.form.delete('api/social/'+id).then(()=>{
                                        Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                        );
                                    // Fire.$emit('AfterCreate');
                                    this.loadContracts();
                                }).catch((data)=> {
                                    Swal.fire("Failed!", data.message, "warning");
                                });
                          }
                    })
            },

          },
          mounted() {

          },
          created() {
              this.$Progress.start();

              this.loadContracts();
              this.loadCategories();
              this.loadTags();

              this.$Progress.finish();
          },
          filters: {
              truncate: function (text, length, suffix) {
                  return text.substring(0, length) + suffix;
              },
          },
          computed: {
            filteredItems() {
              return this.autocompleteItems.filter(i => {
                return i.text.toLowerCase().indexOf(this.tag.toLowerCase()) !== -1;
              });
            },
          },
      }
  </script>
