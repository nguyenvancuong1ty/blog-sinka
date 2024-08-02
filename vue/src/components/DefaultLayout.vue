<script setup lang="ts">
import { useStore } from '../store/home';
import { onBeforeMount, ref } from 'vue';
import { useAuth } from '@/composables/useAuth';
import { useSidebar } from '@/composables/useSidebar';
import Cookies from 'js-cookie';
import { useRouter } from 'vue-router';

const store = useStore();

const { me, getMe } = useAuth();

const searchText = ref(store.currentTextSearch);
function updateSearchText(event: KeyboardEvent) {
  if (event.key === 'Enter') {
    store.change(searchText.value);
  }
}

onBeforeMount(async () => {
  await getMe();
});

const route = useRouter();
const dropdownOpen = ref(false);
const handleLogout = async () => {
  Cookies.set('access_token', '');
  route.push({ name: 'login' }).then(() => {
    window.location.reload();
  });
};
</script>

<template>
  <div class="wrap w-screen h-screen flex justify-center items-center">
    <div class="web w-full h-full overflow-y-auto">
      <header
        class="flex justify-between min-h-20 px-6 items-center sticky top-0 bg-[#F5F5F5] z-30"
      >
        <div class="flex items-center">
          <font-awesome-icon icon="bars" />
          <p class="m-0 font-bold ml-4">/Homepage</p>
        </div>
        <div class="relative flex items-center">
          <input
            type="text"
            class="search-input w-96 bg-[#F5F5F5] border-[#fff] px-0"
            placeholder="Search topic"
            v-model="searchText"
            @keyup="updateSearchText"
          />
          <font-awesome-icon
            icon="magnifying-glass"
            :class="'absolute right-0 hover:cursor-pointer'"
          />
        </div>
        <div class="relative">
          <button
            class="relative z-10 overflow-hidden shadow focus:outline-none block items-center"
            @click="dropdownOpen = !dropdownOpen"
            v-if="me.value"
          >
            <font-awesome-icon icon="user" />
            <p class="m-0 font-bold ml-4">{{ me.value.email }}</p>
          </button>

          <div
            v-show="dropdownOpen"
            class="fixed inset-0 z-10 w-full h-full"
            @click="dropdownOpen = false"
          />

          <transition
            enter-active-class="transition duration-150 ease-out transform"
            enter-from-class="scale-95 opacity-0"
            enter-to-class="scale-100 opacity-100"
            leave-active-class="transition duration-150 ease-in transform"
            leave-from-class="scale-100 opacity-100"
            leave-to-class="scale-95 opacity-0"
          >
            <div
              v-show="dropdownOpen"
              class="absolute right-0 z-20 w-48 py-2 mt-2 bg-white rounded-md shadow-xl"
            >
              <a
                href="#"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white"
                >Profile</a
              >
              <a
                href="#"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white"
                >Products</a
              >
              <button
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white w-full text-left"
                @click="handleLogout"
              >
                Log out
              </button>
            </div>
          </transition>
        </div>
        <div class="flex items-center" v-if="!me.value">
          <router-link to="/login"><button>Login</button></router-link>
        </div>
      </header>

      <div class="content px-4">
        <router-view />
      </div>
    </div>
  </div>
</template>

<style>
.search-input {
  border: none;
  border-bottom: 1px solid;
}
.search-input:focus {
  outline: none;
  border: none;
  border-bottom: 1px solid;
  box-shadow: none; /* Loại bỏ box-shadow khi focus */
}

.ant-menu-title-content {
  font-weight: bold;
}
</style>
