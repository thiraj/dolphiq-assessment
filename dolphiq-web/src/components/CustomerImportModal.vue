<template>
  <v-dialog
      v-model="showModal"
      max-width="800px"
  >
    <template v-slot:activator="{ on, attrs }">
      <v-btn
          color="primary"
          dark
          class="mb-2"
          v-bind="attrs"
          v-on="on"
      >
        Import Customer
      </v-btn>
    </template>
    <v-card>
      <v-card-title>
        <span class="text-h5">{{ formTitle }}</span>
      </v-card-title>
      <validation-observer ref="observer">
        <v-form @submit.prevent="save">
            <v-card-text>
              <v-container>
                <v-row>
                  <v-col
                      cols="12"
                      sm="8"
                      md="8"
                  >
                    <validation-provider v-slot="{ errors }" name="CSV File" :rules="{
                      required:true,
                      size:10000,
                      mimes:'text/csv',
                      ext:'csv'
                    }">
                      <template>
                        <v-file-input
                            v-model="csvFile"
                            :error-messages="errors"
                            label="CSV Import"
                            outlined
                            dense
                        ></v-file-input>
                      </template>
                    </validation-provider>
                  </v-col>

                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                  color="red darken-1"
                  text
                  @click="closeModal"
              >
                Cancel
              </v-btn>

              <v-btn
                  color="blue darken-1"
                  text
                  type="submit"
              >
                Import
              </v-btn>
            </v-card-actions>
          </v-form>
      </validation-observer>
    </v-card>
    <v-dialog v-model="submitConfirm" max-width="500px">
      <v-card>
        <v-card-title class="text-h5">Are you sure you want to import from this file?</v-card-title>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="closeSubmit">Cancel</v-btn>
          <v-btn color="blue darken-1" text @click="submitImportConfirm">OK</v-btn>
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-dialog>
</template>

<script>
import { mapActions } from 'vuex';
import { required, size, mimes, ext } from 'vee-validate/dist/rules';
import { extend, ValidationProvider, setInteractionMode, ValidationObserver } from 'vee-validate';

setInteractionMode('eager')

extend('required', {
  ...required,
  message: '{_field_} can not be empty'
})

extend('size', {
  ...size,
  message: '{_field_} can not be exceed 10MB'
})

extend('mimes', {
  ...mimes,
  message: '{_field_} should be a valid CSV file type'
})

extend('ext', {
  ...ext,
  message: '{_field_} should be a valid CSV file'
})

export default {
  name: "CustomerImportModal",
  props:['importDialog','formTitle'],
  components: {
    ValidationProvider,
    ValidationObserver
  },
  data: () => ({
    submitConfirm:false,
    csvFile:[]
  }),
  computed:{
    showModal: {
      get() {
        return this.importDialog;
      },
      set(show) {
        this.$emit('update:import-dialog', show);
      },
    },
  },
  methods:{
    ...mapActions({
      importCsv: 'Customer/importCustomers'
    }),
    async save(){
      const valid = await this.$refs.observer.validate()
      if (valid) {
        this.submitConfirm = true;
      }
    },
    submitImportConfirm(){
      this.importCustomers();
    },
    importCustomers(){
      this.importCsv(this.csvFile).then(() => {
        this.closeModal();
      });

    },
    closeSubmit () {
      this.submitConfirm = false
    },
    closeModal(){
      this.showModal = false;
    }
  }
}
</script>

<style scoped>

</style>