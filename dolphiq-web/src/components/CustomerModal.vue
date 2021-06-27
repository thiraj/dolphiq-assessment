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
        New Customer
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
                      sm="6"
                      md="4"
                  >
                    <validation-provider v-slot="{ errors }" name="First name" rules="required">
                      <v-text-field
                          v-model="editedItem.first_name"
                          label="First name"
                          :error-messages="errors"
                          required
                      ></v-text-field>
                    </validation-provider>
                  </v-col>
                  <v-col
                      cols="12"
                      sm="6"
                      md="4"
                  >
                    <validation-provider v-slot="{ errors }" name="Last name" rules="required">
                      <v-text-field
                          v-model="editedItem.last_name"
                          :error-messages="errors"
                          label="Last Name"
                          required
                      ></v-text-field>
                    </validation-provider>
                  </v-col>
                  <v-col
                      cols="12"
                      sm="6"
                      md="4"
                  >
                    <validation-provider v-slot="{ errors }" name="Email" rules="required|email">
                      <v-text-field
                          v-model="editedItem.email"
                          :error-messages="errors"
                          label="Email"
                      ></v-text-field>
                    </validation-provider>
                  </v-col>
                  <v-col
                      cols="12"
                      sm="6"
                      md="3"
                      v-for="(phone, index) in editedItem.phone_numbers"
                      :key="index"
                  >
                    <validation-provider v-slot="{ errors }" name="Phone number" :rules="{
                            required: true,
                            digits: 10
                          }">
                      <v-text-field
                          v-model="phone.phone_number"
                          :error-messages="errors"
                          label="Phone Number"
                          :counter="10"
                          required
                      >
                        <v-icon
                            slot="prepend"
                            color="red"
                            @click="removePhone(index)"
                            v-if="(editedItem.phone_numbers.length > 1)"
                        >
                          mdi-minus
                        </v-icon>
                      </v-text-field>
                    </validation-provider>
                  </v-col>

                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-btn
                  color="green darken-2"
                  text
                  @click="addPhone"
                  left
              >
                Add Phone
              </v-btn>
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
                Save
              </v-btn>
            </v-card-actions>
          </v-form>
      </validation-observer>
    </v-card>
    <v-dialog v-model="submitConfirm" max-width="500px">
      <v-card>
        <v-card-title class="text-h5">Are you sure you want to save the changes?</v-card-title>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="closeSubmit">Cancel</v-btn>
          <v-btn color="blue darken-1" text @click="submitCustomerConfirm">OK</v-btn>
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-dialog>
</template>

<script>
import { mapActions } from 'vuex';
import { required, email, digits, regex } from 'vee-validate/dist/rules';
import { extend, ValidationProvider, setInteractionMode, ValidationObserver } from 'vee-validate';

setInteractionMode('eager')

extend('digits', {
  ...digits,
  message: '{_field_} needs to be {length} digits. ({_value_})',
})

extend('regex', {
  ...regex,
  message: '{_field_} {_value_} does not match {regex}',
})

extend('required', {
  ...required,
  message: '{_field_} can not be empty'
})

extend('email', {
  ...email,
  message: 'Email must be valid'
})

export default {
  name: "CustomerModal",
  props:['dialog', 'editedItem', 'formTitle'],
  components: {
    ValidationProvider,
    ValidationObserver
  },
  data: () => ({
    submitConfirm:false
  }),
  computed:{
    showModal: {
      get() {
        return this.dialog;
      },
      set(show) {
        this.$emit('update:dialog', show);
      },
    },
  },
  methods:{
    ...mapActions({
      addCustomers: 'Customer/addCustomer',
      updateCustomer: 'Customer/updateCustomer'
    }),
    async save(){
      const valid = await this.$refs.observer.validate()
      if (valid) {
        this.submitConfirm = true;
      }
    },
    submitCustomerConfirm(){
      this.submitCustomer();
    },
    submitCustomer(){

      if(this.editedItem.id){
        this.updateCustomer(this.editedItem).then(() => {
          this.closeModal();
        });
      }else{
        this.addCustomers(this.editedItem).then(() => {
          this.closeModal();
        });
      }

    },
    closeSubmit () {
      this.submitConfirm = false
    },
    closeModal(){
      this.showModal = false;
    },
    addPhone(){
      this.editedItem.phone_numbers.push({
        id:'',
        phone_number:''
      })
      console.log('this.editedItem.phone_numbers', this.editedItem.phone_numbers);
    },
    removePhone(index){
      this.editedItem.phone_numbers.splice(index, 1)
    }
  }
}
</script>

<style scoped>

</style>