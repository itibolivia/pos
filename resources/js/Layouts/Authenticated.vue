<template>
  <div>
    <nav class="navbar navbar-expand-md navbar-light bg-white border-bottom sticky-top">
      <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="/">
          <Link :href="route('dashboard')">
            <breeze-application-logo width="36" />
          </Link>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav me-auto">
            <!--breeze-nav-link :href="route('dashboard')" :active="route().current('dashboard')">
              Bienvenida
            </breeze-nav-link-->
            <breeze-nav-link :href="route('admins.index')" :active="route().current('admins.index')"
                v-if="$page.props.auth.user.roles[0].name === 'superadmin'">
                  Admin
                </breeze-nav-link>
                <breeze-nav-link :href="route('usuarios.index')" :active="route().current('usuarios.index')"
                v-if="$page.props.auth.user.roles[0].name === 'superadmin' ||
                $page.props.auth.user.roles[0].name === 'admin'">
                  Usuario
                </breeze-nav-link>
            <breeze-nav-link :href="route('categorias.index')" :active="route().current('categorias.index')"
            v-if="$page.props.auth.user.roles[0].name === 'superadmin' ||
            $page.props.auth.user.roles[0].name === 'admin'">
              Categorias
            </breeze-nav-link>
            <breeze-nav-link :href="route('productos.index')" :active="route().current('productos.index')"
            v-if="$page.props.auth.user.roles[0].name === 'superadmin' ||
            $page.props.auth.user.roles[0].name === 'admin'">
              Productos
            </breeze-nav-link>
            <breeze-nav-link :href="route('compras.index')" :active="route().current('compras.index')"
            v-if="$page.props.auth.user.roles[0].name === 'superadmin' ||
            $page.props.auth.user.roles[0].name === 'admin'">
              Compras
            </breeze-nav-link>
            <breeze-nav-link :href="route('notas.index')" :active="route().current('notas.index')">
              POS
            </breeze-nav-link>
          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav align-items-baseline">
            <!-- Authentication Links -->
            <breeze-dropdown id="settingsDropdown">
              <template #trigger>
                {{ $page.props.auth.user.name }}

                <svg class="ms-2" width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
              </template>

              <template #content>
                <!-- Authentication -->
                <breeze-dropdown-link @click="logout" as="button">
                  Log Out
                </breeze-dropdown-link>
              </template>
            </breeze-dropdown>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Heading -->
    <header class="d-flex py-3 bg-white shadow-sm border-bottom">
      <div class="container">
        <slot name="header" />
      </div>
    </header>

    <div id="wrap">
      <!-- Page Content -->
      <div id="main" class="container clear-top">
          <slot />
      </div>
      <!-- Page Footer -->
      <footer class="footer bg-4 text-center">
        <p>Sistema desarrollado por <a href="http://itibolivia.com" target="_blank">ITI SRL</a></p>
      </footer>  
    </div>
  </div>
</template>

<script>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue'
import BreezeDropdown from '@/Components/Dropdown.vue'
import BreezeDropdownLink from '@/Components/DropdownLink.vue'
import BreezeNavLink from '@/Components/NavLink.vue'
import { Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'

export default {
  components: {
    BreezeApplicationLogo,
    BreezeDropdown,
    BreezeDropdownLink,
    BreezeNavLink,
    Link,
  },

  data() {
    return {
      showingNavigationDropdown: false
    }
  },

  methods: {
    logout() {
      Inertia.post(route("logout"));
    }
  },
}
</script>

<style>

#wrap {
  min-height: 100%;
}

#main {
  overflow:auto;
  padding-bottom:150px; /* this needs to be bigger than footer height*/
}

.bg-4 {
    background-color: #2f2f2f;
    color: #ffffff;
  }

.footer {
  position: relative;
  margin-top: -50px; /* negative value of footer height */
  height: 50px;
  clear:both;
  padding-top:20px;
} 
</style>
