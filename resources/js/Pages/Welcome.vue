<template>
  <Head title="Welcome" />

  <div>
    <div class="container fixed-top p-4">
      <div class="col-12">
        <div v-if="canLogin" class="d-flex justify-content-end">
          <div>
            <Link
              v-if="$page.props.auth.user"
              href="/dashboard"
              class="text-muted"
            >
              Dashboard
            </Link>

            <template v-else>
              <Link :href="route('login')" class="btn btn-secondary btn-lg">
                <i class="fa fa-user"></i>
                Ingresar
              </Link>

              <!--Link
                v-if="canRegister"
                :href="route('register')"
                class="ms-4 text-muted"
              >
                Register
              </Link-->
            </template>
          </div>
        </div>
      </div>
    </div>


      <div class="container-fluid bg-1 text-center">
        <h3>Sistema de Clientes</h3>
        <breeze-application-logo width="82" />
        <h3>Empezemos a manejar tus prospectos!</h3>
      </div>

      <div class="container-fluid bg-2 text-center">
        <h3>¿Qué vamos a hacer?</h3>
        <p>Vamos a manejar tus propspectos, definiendo un origen que denominamos fuente, creas las personas y cada persona puede ser un prospecto, a partir del prospecto realizar una gestión comercial para realizar la venta.</p>
      </div>

      <!--div class="container-fluid bg-3 text-center">
        <h3>Where To Find Me?</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
      </div-->
    </div>

    <footer class="container-fluid bg-4 text-center">
      <p>Sistema desarrollado por <a href="http://itibolivia.com" target="_blank">ITI SRL</a></p>
    </footer>
</template>

<script>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue'
import { Head, Link } from "@inertiajs/inertia-vue3";

export default {
  components: {
    BreezeApplicationLogo,
    Head,
    Link
  },
  props: {
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String
  }
};
</script>

<style>
.container-fluid {
  padding-top: 70px;
  padding-bottom: 70px;
}
.bg-1 {
    background-color: #1abc9c; /* Green */
    color: #ffffff;
  }
  .bg-2 {
    background-color: #474e5d; /* Dark Blue */
    color: #ffffff;
  }
  .bg-3 {
    background-color: #ffffff; /* White */
    color: #555555;
  }
  .bg-4 {
    background-color: #2f2f2f;
    color: #ffffff;
  }
</style>
