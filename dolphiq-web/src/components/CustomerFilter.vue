<template>
  <v-container>
    <v-row>
      <v-col
          cols="12"
          md="2"
      >
        <v-text-field
            v-model="filters.first_name"
            label="First name"
        ></v-text-field>
      </v-col>

      <v-col
          cols="12"
          md="2"
      >
        <v-text-field
            v-model="filters.last_name"
            label="Last name"
        ></v-text-field>
      </v-col>

      <v-col
          cols="12"
          md="2"
      >
        <v-text-field
            v-model="filters.email"
            label="E-mail"
        ></v-text-field>
      </v-col>

      <v-col
          cols="12"
          md="2"
      >
        <v-text-field
            v-model="filters.phone_number"
            label="Phone Number"
        ></v-text-field>
      </v-col>

      <v-col
          cols="12"
          md="4"
      >
        <v-btn @click="filterCustomers">
          Filter Customers
        </v-btn>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { mapActions } from 'vuex';

export default {
  name: "CustomerFilter",
  data: () => ({
    filters:{
      first_name: '',
      last_name: '',
      email: '',
      phone_number: '',
    }
  }),
  methods:{
    ...mapActions({
      fetchCustomers: 'Customer/fetchCustomers'
    }),
    filterCustomers(){
      this.fetchCustomers(this.filters);
    }
  }
}
</script>

<style scoped>

</style>