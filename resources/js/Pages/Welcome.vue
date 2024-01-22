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

    <div class="container">
      <div class="d-flex justify-content-center align-items-center" style="height: 100vh">
        <div class="text-center">
          <img
            class="mb-4"
            src="https://mdbootstrap.com/img/logo/mdb-transparent-250px.png"
            style="width: 250px; height: 90px"
          />
          <h5 class="mb-3">Thank you for using our product. We're glad you're with us.</h5>
          <p class="mb-3">MDB Team</p>
          <a
            class="btn btn-primary btn-lg"
            data-mdb-ripple-init
            href="https://mdbootstrap.com/docs/standard/getting-started/"
            target="_blank"
            role="button"
            >Start MDB tutorial</a
          >
        </div>
      </div>
    </div>

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
