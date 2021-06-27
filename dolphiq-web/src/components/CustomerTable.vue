<template>
  <v-data-table
      :headers="headers"
      :items="customers"
      sort-by="firstName"
      class="elevation-1"
      :search="search"
  >
    <template v-slot:top>
      <v-toolbar
          flat
      >
        <v-toolbar-title>Customers</v-toolbar-title>
        <v-divider
            class="mx-4"
            inset
            vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Search"
            single-line
            hide-details
        ></v-text-field>
        <v-spacer></v-spacer>

        <CustomerModal :dialog.sync="dialog" :editedItem="editedItem" :closeModal="closeFormModal" :formTitle="formTitle"/>
        <v-spacer></v-spacer>
        <CustomerImportModal :import-dialog.sync="importDialog" :closeModal="closeFormModal" :formTitle="'Import Customers'"/>

        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.phone_numbers="{ item }">
      {{ formattedPhones(item.phone_numbers) }}
    </template>
    <template v-slot:item.actions="{ item }">
      <v-icon
          small
          class="mr-2"
          @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
          small
          @click="deleteItem(item)"
      >
        mdi-delete
      </v-icon>
    </template>
    <template v-slot:no-data>
      <v-btn
          color="primary"
          @click="initialize"
      >
        Reset
      </v-btn>
    </template>
  </v-data-table>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
// import { createHelpers } from 'vuex-map-fields';
import CustomerModal from "./CustomerModal";
import CustomerImportModal from "./CustomerImportModal";

// const { mapFields } = createHelpers({
//   getterType: 'Customer/getField',
//   mutationType: 'Customer/updateField',
// });

export default {
  name: "CustomerTable",
  components: {CustomerImportModal, CustomerModal },
  data: () => ({
    search:'',
    dialog: false,
    importDialog: false,
    dialogDelete: false,
    headers: [
      {
        text: 'First Name',
        align: 'start',
        value: 'first_name',
      },
      { text: 'Last Name', value: 'last_name' },
      { text: 'Email', value: 'email' },
      { text: 'Phone Numbers', value: 'phone_numbers', sortable: false },
      { text: 'Actions', value: 'actions', sortable: false },
    ],
    customers: [],
    editedIndex: -1,
    editedItem: {
      id: '',
      first_name: '',
      last_name: '',
      email: '',
      phone_numbers: [{
        id:'',
        phone_number:''
      }]
    },
    defaultItem: {
      first_name: '',
      last_name: '',
      email: '',
      phone_numbers: []
    },
  }),

  computed: {
    ...mapGetters({
        customer: "Customer/getCustomer",
        customersList: "Customer/getCustomersList"
    }),
    formTitle () {
      return this.editedIndex === -1 ? 'New Customer' : 'Edit Customer'
    },
  },

  watch: {
    dialog (val) {
      val || this.closeFormModal()
    },
    dialogDelete (val) {
      val || this.closeDelete()
    },
    customersList (list){
      this.customers = list;
      console.log('this.customers', list)
    },
  },
  created () {
    this.initialize()
  },

  methods: {
    ...mapActions({
      fetchCustomers: 'Customer/fetchCustomers',
      deleteCustomers: 'Customer/deleteCustomer',
    }),
    initialize () {
      this.fetchCustomers().then(customerList => {
        this.customers = customerList;
      });
    },

    editItem (item) {
      this.editedIndex = this.customers.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialog = true
    },

    deleteItem (item) {
      this.editedIndex = this.customers.indexOf(item)
      this.editedItem = Object.assign({}, item)
      this.dialogDelete = true
    },

    deleteItemConfirm () {

      this.deleteCustomers(this.customers[this.editedIndex]).then(() => {
        this.customers.splice(this.editedIndex, 1)
        this.closeDelete()
      })
    },

    closeFormModal () {
      this.dialog = false
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      })
    },

    closeImportModal () {
      this.dialog = false
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      })
    },

    closeDelete () {
      this.dialogDelete = false
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem)
        this.editedIndex = -1
      })
    },

    customerAdded () {
      if (this.editedIndex > -1) {
        Object.assign(this.desserts[this.editedIndex], this.editedItem)
      } else {
        this.customers.push(this.editedItem)
      }
      this.closeFormModal()
    },

    formattedPhones(phoneNumbers) {
      if (phoneNumbers?.length){
        let formatted = '';
        phoneNumbers.forEach((phone, index) => {
          formatted += ''+ phone.phone_number.toString();
          if (++index < phoneNumbers.length)
            formatted +=  ', ';
        })
        return formatted.toString();
      }else{
        return '';
      }

    }
  },
}
</script>

<style scoped>

</style>