<template>
  <section class="section-container">
    <v-row class="signin">
      <v-col cols="8" class="left">
        <h1>Welcome to Dolphiq CRM</h1>
      </v-col>
      <v-col cols="4" class="right">
        <h2>LOGIN</h2>
        <validation-observer ref="observer">
          <v-form @submit.prevent="submit">
            <validation-provider v-slot="{ errors }" name="email" rules="required|email">
              <v-text-field
                  v-model="email"
                  :error-messages="errors"
                  label="Email"
                  required
                  outlined
                  dark
                  filled
                  dense
              ></v-text-field>
            </validation-provider>
            <validation-provider v-slot="{ errors }" name="password" rules="required">
              <v-text-field
                  v-model="password"
                  :error-messages="errors"
                  label="Password"
                  :append-icon="showPass ? 'mdi-eye' : 'mdi-eye-off'"
                  @click:append="showPass = !showPass"
                  required
                  outlined
                  dense
                  dark
                  filled
                  :type="showPass ? 'text' : 'password'"
              ></v-text-field>
            </validation-provider>
            <div class="text-center">
              <v-btn class="signin-btn" type="submit" rounded color="white" dark>
                Sign In
              </v-btn>
            </div>
          </v-form>
        </validation-observer>
      </v-col>
    </v-row>
  </section>
</template>

<script>
import { mapActions } from 'vuex';
import { createHelpers } from 'vuex-map-fields';
import { required, email } from 'vee-validate/dist/rules';
import { extend, ValidationProvider, setInteractionMode, ValidationObserver } from 'vee-validate';

setInteractionMode('eager')

extend('required', {
  ...required,
  message: '{_field_} can not be empty'
})

extend('email', {
  ...email,
  message: 'Email must be valid'
})

const { mapFields } = createHelpers({
  getterType: 'Auth/getField',
  mutationType: 'Auth/updateField',
});

export default {
  name:'Login',
  components: {
    ValidationProvider,
    ValidationObserver
  },
  data: () => ({
    email:'',
    password:null,
    showPass: false
  }),
  computed: {
    ...mapFields(["formData", "isAuthenticated"]),
    params() {
      return {
        username: this.email,
        password: this.password
      }
    }
  },
  methods: {
    ...mapActions({
      loginRequest: 'Auth/loginRequest'
    }),
    async submit() {
      const valid = await this.$refs.observer.validate()
      if (valid) {
        this.loginRequest(this.params);
      }
    },
    clear() {
      // you can use this method to clear login form
      this.email = ''
      this.password = null
      this.$refs.observer.reset()
    }
  },
  mounted() {
    this.clear();
  }
}
</script>

<style scoped>

.section-container {
  padding: 20px;
  margin: 20px;
  background: #fff;
  width: 100%;
}
.section-container .signin {
  padding: 0;
  max-width: 1000px;
  margin: 0 auto;
  min-height: 600px;
  box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.1);
}
.section-container .signin .left {
  padding: 30px;
  justify-content: center;
  align-items: center;
  box-sizing: border-box;
  display: flex;
  color: #30ac7c;
  background-color: #f9f9f9;
}
.section-container .signin .right {
  padding: 30px;
  box-sizing: border-box;
  background: #30ac7c;
  color: #fff;
}
.section-container .signin .right h2 {
  text-align: center;
  margin: 30px 0;
}
.section-container .signin .right .signin-btn {
  width: 100%;
  color: #30ac7c;
}

</style>