<script setup lang="ts">
import { useStore } from '../store/home';
import { ref } from 'vue';

const store = useStore();
const searchText = ref(store.currentTextSearch);

function updateSearchText(event: KeyboardEvent) {
  if (event.key === 'Enter') {
    store.change(searchText.value);
  }
}
</script>

<template>
  <div class="wrap w-screen h-screen flex justify-center items-center">
    <div class="web w-full h-full overflow-y-auto">
      <header
        class="flex justify-between min-h-20 px-6 items-center sticky top-0 bg-[#F5F5F5]"
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
        <div class="flex items-center">
          <font-awesome-icon icon="user" />
          <p class="m-0 font-bold ml-4">Me</p>
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
