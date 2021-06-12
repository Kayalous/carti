<template>
  <nav class="fixed top-0 z-50 w-full bg-white border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
        <div class="flex justify-between flex-grow">
          <!-- Logo -->
          <div class="flex items-center flex-shrink-0">
            <inertia-link :href="route('landing')">
              <jet-application-mark class="block w-auto h-9" />
            </inertia-link>
          </div>

          <!-- Navigation Links -->
          <div class="hidden space-x-8 sm:-my-px sm:flex sm:items-center">
            <jet-nav-link
              :href="route('dashboard')"
              :active="route().current('dashboard')"
            >
              Dashboard
            </jet-nav-link>
          </div>
        </div>

        <div class="hidden sm:flex sm:items-center sm:ml-6">
          <!-- Settings Dropdown -->
          <div class="relative ml-3" v-if="$page.props.user">
            <jet-dropdown align="right" width="48">
              <template #trigger>
                <button
                  v-if="$page.props.jetstream.managesProfilePhotos"
                  class="flex text-sm transition duration-150 ease-in-out border-2 border-transparent rounded-full  focus:outline-none focus:border-gray-300"
                >
                  <img
                    class="object-cover w-8 h-8 rounded-full"
                    :src="$page.props.user.profile_photo_url"
                    :alt="$page.props.user.name"
                  />
                </button>

                <span v-else class="inline-flex rounded-md">
                  <button
                    type="button"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md  hover:text-gray-700 focus:outline-none"
                  >
                    {{ $page.props.user.name }}

                    <svg
                      class="ml-2 -mr-0.5 h-4 w-4"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                      fill="currentColor"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                      />
                    </svg>
                  </button>
                </span>
              </template>

              <template #content>
                <!-- Account Management -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                  Manage Account
                </div>

                <jet-dropdown-link :href="route('profile.show')">
                  Profile
                </jet-dropdown-link>

                <jet-dropdown-link
                  :href="route('api-tokens.index')"
                  v-if="$page.props.jetstream.hasApiFeatures"
                >
                  API Tokens
                </jet-dropdown-link>

                <div class="border-t border-gray-100"></div>

                <!-- Authentication -->
                <form @submit.prevent="logout">
                  <jet-dropdown-link as="button"> Logout </jet-dropdown-link>
                </form>
              </template>
            </jet-dropdown>
          </div>
          <template v-else>
            <inertia-link
              :href="route('login')"
              class="text-sm text-gray-700 underline"
            >
              Login
            </inertia-link>

            <inertia-link
              :href="route('register')"
              class="ml-4 text-sm text-gray-700 underline"
            >
              Register
            </inertia-link>
          </template>
        </div>

        <!-- Hamburger -->
        <div class="flex items-center -mr-2 sm:hidden">
          <button
            @click="showingNavigationDropdown = !showingNavigationDropdown"
            class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md  hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500"
          >
            <svg
              class="w-6 h-6"
              stroke="currentColor"
              fill="none"
              viewBox="0 0 24 24"
            >
              <path
                :class="{
                  hidden: showingNavigationDropdown,
                  'inline-flex': !showingNavigationDropdown,
                }"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"
              />
              <path
                :class="{
                  hidden: !showingNavigationDropdown,
                  'inline-flex': showingNavigationDropdown,
                }"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12"
              />
            </svg>
          </button>
        </div>
      </div>
    </div>
    <!-- Responsive Navigation Menu -->
    <div
      :class="{
        block: showingNavigationDropdown,
        hidden: !showingNavigationDropdown,
      }"
      class="sm:hidden"
    >
      <div v-if="$page.props.user" class="flex items-center px-4 py-4 border-t">
        <div
          v-if="$page.props.jetstream.managesProfilePhotos"
          class="flex-shrink-0 mr-3"
        >
          <img
            class="object-cover w-10 h-10 rounded-full"
            :src="$page.props.user.profile_photo_url"
            :alt="$page.props.user.name"
          />
        </div>

        <div>
          <div class="text-base font-medium text-gray-800">
            {{ $page.props.user.name }}
          </div>
          <div class="text-sm font-medium text-gray-500">
            {{ $page.props.user.email }}
          </div>
        </div>
      </div>

      <!-- Responsive Settings Options -->
      <div class="pt-4 pb-1 border-t border-gray-200">
        <div v-if="$page.props.user" class="space-y-1">
          <jet-responsive-nav-link
            :href="route('dashboard')"
            :active="route().current('dashboard')"
          >
            Dashboard
          </jet-responsive-nav-link>

          <jet-responsive-nav-link
            :href="route('profile.show')"
            :active="route().current('profile.show')"
          >
            Profile
          </jet-responsive-nav-link>

          <!-- Authentication -->
          <form method="POST" @submit.prevent="logout">
            <jet-responsive-nav-link as="button">
              Logout
            </jet-responsive-nav-link>
          </form>
        </div>
        <div v-else class="space-y-1">
          <jet-responsive-nav-link
            :href="route('login')"
            :active="route().current('login')"
          >
            Login
          </jet-responsive-nav-link>

          <jet-responsive-nav-link
            :href="route('register')"
            :active="route().current('register')"
          >
            Register
          </jet-responsive-nav-link>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
import JetApplicationMark from "@/Jetstream/ApplicationMark";
import JetBanner from "@/Jetstream/Banner";
import JetDropdown from "@/Jetstream/Dropdown";
import JetDropdownLink from "@/Jetstream/DropdownLink";
import JetNavLink from "@/Jetstream/NavLink";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";

export default {
  components: {
    JetApplicationMark,
    JetBanner,
    JetDropdown,
    JetDropdownLink,
    JetNavLink,
    JetResponsiveNavLink,
  },

  data() {
    return {
      showingNavigationDropdown: false,
      isScrolled: false,
    };
  },

  methods: {
    switchToTeam(team) {
      this.$inertia.put(
        route("current-team.update"),
        {
          team_id: team.id,
        },
        {
          preserveState: false,
        }
      );
    },

    logout() {
      this.$inertia.post(route("logout"));
    },
    handleScroll() {
      // if(  )
    },
  },
  mounted: function () {
    window.addEventListener("scroll", this.handleScroll);
  },
};
</script>

<style scoped>
</style>
