<template>
  <v-app-bar
      v-if="isAuthenticated"
      color="deep-purple"
      dark
      flat
      style="max-height: 70px"
  >

    <div class="d-flex align-center">
      <v-img
          alt="Dolphiq"
          class="shrink mr-5"
          contain
          :src="require('../assets/images/logo.png')"
          transition="scale-transition"
          width="40"
      />
    </div>

    <v-toolbar-title style="font-weight: bold; font-size: x-large">DLP CRM</v-toolbar-title>

    <v-spacer></v-spacer>


    <v-tooltip bottom>
      <template v-slot:activator="{ on, attrs }">
        <span
            v-bind="attrs"
            v-on="on"
            @click="logOut"
        >
          <v-btn icon>
            <v-icon>mdi-power</v-icon>
          </v-btn>
        </span>
      </template>
      <span>Sign Out</span>
    </v-tooltip>

  </v-app-bar>
</template>

<script>
import { mapActions } from 'vuex';
import { createHelpers } from 'vuex-map-fields';

const { mapFields } = createHelpers({
  getterType: 'Auth/getField',
  mutationType: 'Auth/updateField',
});

export default {
  name: "NavBar",
  data: () => {
    return {
      drawer: false,
      group: null,
    }
  },
  computed: {
    ...mapFields(["isAuthenticated", "authUser"])
  },
  methods:{
    ...mapActions({
      logOut: 'Auth/logout'
    }),

  }
}
</script>

<style scoped>

</style>