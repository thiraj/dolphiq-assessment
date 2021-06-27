<template>

  <v-content style="margin-top: 15px">
    <CustomerFilter/>
    <v-divider></v-divider>
    <CustomerTable/>
  </v-content>

</template>

<script>
import CustomerFilter from "../components/CustomerFilter";
import CustomerTable from "../components/CustomerTable";
export default {
  name: "HelloWorld",
  components: {CustomerTable, CustomerFilter},
  data: () => ({}),
};
</script>
